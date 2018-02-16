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
     * A DatatableQueryBuilder instance.
     * This class generates a Query by given Columns.
     * Default: null
     *
     * @var null|DatatableQueryBuilder
     */
    private $datatableQueryBuilder;

    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * DatatableResponse constructor.
     *
     * @param Request $request
     * @param DatatableInterface $datatable
     */
    public function __construct(Request $request, DatatableInterface $datatable)
    {
        $this->request = $request;
        $this->datatable = $datatable;
        $this->datatableQueryBuilder = null;
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
        $this->datatableQueryBuilder = $this->createDatatableQueryBuilder();

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
    public function getResponse()
    {
        if (null === $this->datatable) {
            throw new Exception('Set a Datatable class with setDatatable().');
        }

        $this->setDatatable($this->datatable);

        if (null === $this->datatableQueryBuilder) {
            throw new Exception('A DatatableQueryBuilder instance is needed. Call getDatatableQueryBuilder().');
        }

        $paginator = new Paginator($this->datatableQueryBuilder->execute(), true);
        $paginator->setUseOutputWalkers(false);

        $formatter = new DatatableFormatter();
        $formatter->runFormatter($paginator, $this->datatable);

        $outputHeader = [
            'draw' => (int) $this->requestParams['draw'],
            'recordsFiltered' => count($paginator),
            'recordsTotal' => (int) $this->datatableQueryBuilder->getCountAllResults(),
        ];

        return new JsonResponse(array_merge($outputHeader, $formatter->getOutput()));
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
