<?php

/**
 * This file is part of the SgDatatablesBundle package.
 *
 * (c) stwe <https://github.com/stwe/DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sztyup\Datatable;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Exception;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Sztyup\Datatable\Column\ColumnInterface;

/**
 * Class DatatableResponse
 *
 * @package Sztyup\Datatables\Response
 */
class DatatableResponse
{
    /**
     * The current Request.
     *
     * @var Request
     */
    private $request;

    /**
     * $_GET or $_POST parameters.
     *
     * @var array
     */
    private $requestParams;

    /**
     * A DatatableInterface instance.
     * Default: null
     *
     * @var null|DatatableInterface
     */
    private $datatable;

    /**
     * @var Container
     */
    private $container;

    /**
     * A DatatableQueryBuilder instance.
     * This class generates a Query by given Columns.
     * Default: null
     *
     * @var null|DatatableQueryBuilder
     */
    private $datatableQueryBuilder;

    /**
     * @var Factory
     */
    private $viewFactory;

    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    /**
     * @var bool
     */
    private $debug;

    /** @var array */
    protected $modifiers = [];

    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * DatatableResponse constructor.
     *
     * @param Request $request
     * @param Factory $viewFactory
     * @param ResponseFactory $responseFactory
     * @param Repository $config
     * @param Container $container
     */
    public function __construct(
        Request $request,
        Factory $viewFactory,
        ResponseFactory $responseFactory,
        Repository $config,
        Container $container
    ) {
        $this->container = $container;
        $this->request = $request;
        $this->datatableQueryBuilder = null;
        $this->viewFactory = $viewFactory;
        $this->responseFactory = $responseFactory;
        $this->debug = $config->get('app.debug');
    }

    public function addModifier(\Closure $closure)
    {
        $this->datatableQueryBuilder->addModifier($closure);

        return $this;
    }

    /**
     * @param string $datatable
     * @param $view
     * @param $viewData
     * @return \Illuminate\Contracts\View\View|JsonResponse
     * @throws Exception
     */
    public function getResponse($datatable, $view, $viewData = [])
    {
        /** @var AbstractDatatable $datatable */
        $datatable = $this->container->make($datatable);
        $datatable->buildDatatable();

        $this->setDatatable($datatable);

        if ($this->request->method() == 'POST' && $this->request->isXmlHttpRequest()) {
            return $this->responseFactory->json(
                $this->getResponseData()
            );
        } else {
            return $this->viewFactory->make($view, array_merge($viewData, [
                'dataTable' => $this->datatable
            ]));
        }
    }

    //-------------------------------------------------
    // Getters && Setters
    //-------------------------------------------------

    /**
     * Set datatable.
     *
     * @param DatatableInterface $datatable
     *
     * @return $this
     * @throws Exception
     */
    public function setDatatable(DatatableInterface $datatable)
    {
        $val = $this->validateColumnsPositions($datatable);
        if (is_int($val)) {
            throw new Exception("The Column with the index $val is on a not allowed position.");
        };

        $this->datatable = $datatable;

        return $this;
    }

    //-------------------------------------------------
    // Response
    //-------------------------------------------------

    /**
     * Get response.
     *
     * @return JsonResponse
     * @throws Exception
     * @throws \TypeError
     */
    protected function getResponseData()
    {
        if (null === $this->datatable) {
            throw new Exception('Set a Datatable class with setDatatable().');
        }

        $this->setDatatable($this->datatable);

        $this->createDatatableQueryBuilder();

        if (null === $this->datatableQueryBuilder) {
            throw new Exception('A DatatableQueryBuilder instance is needed. Call getDatatableQueryBuilder().');
        }

        foreach ($this->modifiers as $modifier) {
            $this->datatableQueryBuilder->addModifier($modifier);
        }

        $paginator = new Paginator($this->datatableQueryBuilder->execute(), true);
        $paginator->setUseOutputWalkers(true);

        $formatter = new DatatableFormatter();
        $formatter->runFormatter($paginator, $this->datatable);

        $outputHeader = [
            'draw' => (int) $this->requestParams['draw'],
            'recordsFiltered' => count($paginator),
            'recordsTotal' => (int) $this->datatableQueryBuilder->getCountAllResults(),
        ];

        return array_merge($outputHeader, $formatter->getOutput());
    }

    //-------------------------------------------------
    // Private
    //-------------------------------------------------

    /**
     * Create a new DatatableQueryBuilder instance.
     *
     * @return DatatableQueryBuilder
     * @throws Exception
     */
    private function createDatatableQueryBuilder()
    {
        if (null === $this->datatable) {
            throw new Exception('Set a Datatable class with setDatatable().');
        }

        $this->requestParams = $this->getRequestParams();
        $this->datatableQueryBuilder = new DatatableQueryBuilder($this->requestParams, $this->datatable);

        return $this->datatableQueryBuilder;
    }

    /**
     * Get request params.
     *
     * @return array
     */
    private function getRequestParams()
    {
        $parameterBag = null;
        $type = $this->datatable->getAjax()->getType();

        if ('GET' === strtoupper($type)) {
            $parameterBag = $this->request->query;
        }

        if ('POST' === strtoupper($type)) {
            $parameterBag = $this->request->request;
        }

        return $parameterBag->all();
    }

    /**
     * Checks Column positions.
     *
     * @param DatatableInterface $datatable
     *
     * @return int|bool
     */
    private function validateColumnsPositions(DatatableInterface $datatable)
    {
        $columns = $datatable->getColumnBuilder()->getColumns();
        $lastPosition = count($columns);

        /** @var ColumnInterface $column */
        foreach ($columns as $column) {
            $allowedPositions = $column->allowedPositions();
            /** @noinspection PhpUndefinedMethodInspection */
            $index = $column->getIndex();
            if (is_array($allowedPositions)) {
                $allowedPositions = array_flip($allowedPositions);
                if (array_key_exists(ColumnInterface::LAST_POSITION, $allowedPositions)) {
                    $allowedPositions[$lastPosition] = $allowedPositions[ColumnInterface::LAST_POSITION];
                    unset($allowedPositions[ColumnInterface::LAST_POSITION]);
                }

                if (false === array_key_exists($index, $allowedPositions)) {
                    return $index;
                }
            }
        }

        return true;
    }
}
