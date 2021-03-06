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

use Doctrine\ORM\EntityManager;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Str;
use Sztyup\Datatable\Column\ColumnBuilder;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Exception;

/**
 * Class AbstractDatatable
 *
 * @package Sztyup\Datatable
 */
abstract class AbstractDatatable implements DatatableInterface
{
    /**
     * The Router service.
     *
     * @var Registrar
     */
    protected $router;

    /**
     * The doctrine orm entity manager service.
     *
     * @var EntityManager
     */
    protected $em;

    /**
     * A ColumnBuilder instance.
     *
     * @var ColumnBuilder
     */
    protected $columnBuilder;

    /**
     * An Ajax instance.
     *
     * @var Ajax
     */
    protected $ajax;

    /**
     * An Options instance.
     *
     * @var Options
     */
    protected $options;

    /**
     * A Features instance.
     *
     * @var Features
     */
    protected $features;

    /**
     * A Callbacks instance.
     *
     * @var Callbacks
     */
    protected $callbacks;

    /**
     * A Events instance.
     *
     * @var Events
     */
    protected $events;

    /**
     * An Extensions instance.
     *
     * @var Extensions
     */
    protected $extensions;

    /**
     * A Language instance.
     *
     * @var Language
     */
    protected $language;

    /**
     * The PropertyAccessor.
     *
     * @var PropertyAccessor
     */
    protected $accessor;

    /**
     * @var array
     */
    protected $extraSelect;

    /**
     * @var AuthManager
     */
    protected $authManager;

    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * AbstractDatatable constructor.
     *
     * @param AuthManager $authManager
     * @param Registrar $router
     * @param EntityManager $em
     * @param Container $container
     * @throws Exception
     */
    public function __construct(
        AuthManager $authManager,
        Registrar $router,
        EntityManager $em,
        Container $container
    ) {
        $this->validateName();

        $this->router = $router;
        $this->em = $em;
        $this->authManager = $authManager;

        $metadata = $em->getClassMetadata($this->getEntity());
        $this->columnBuilder = new ColumnBuilder($metadata, $this->getName(), $em, $container);

        // @TOOD resolve these out of the container
        $this->ajax = new Ajax();
        $this->options = new Options();
        $this->features = new Features();
        $this->callbacks = new Callbacks();
        $this->events = new Events();
        $this->extensions = new Extensions();
        $this->language = new Language();

        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    //-------------------------------------------------
    // DatatableInterface
    //-------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function getLineFormatter()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getColumnBuilder()
    {
        return $this->columnBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getAjax()
    {
        return $this->ajax;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * {@inheritdoc}
     */
    public function getCallbacks()
    {
        return $this->callbacks;
    }

    /**
     * {@inheritdoc}
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityManager()
    {
        return $this->em;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptionsArrayFromEntities($entities, $keyFrom = 'id', $valueFrom = 'name')
    {
        $options = [];

        foreach ($entities as $entity) {
            if (true === $this->accessor->isReadable($entity, $keyFrom) &&
                true === $this->accessor->isReadable($entity, $valueFrom)
            ) {
                $options[$this->accessor->getValue($entity, $keyFrom)] = $this->accessor->getValue($entity, $valueFrom);
            }
        }

        return $options;
    }

    public function getGlobalFilters()
    {
        return [];
    }

    public function getExtraSelects()
    {
        return [];
    }

    //-------------------------------------------------
    // Private
    //-------------------------------------------------

    /**
     * Checks the name only contains letters, numbers, underscores or dashes.
     *
     * @throws Exception
     */
    private function validateName()
    {
        if (1 !== preg_match(self::NAME_REGEX, $this->getName())) {
            throw new Exception('The result of the getName method can only contain letters, numbers, _, -');
        }
    }

    public function __get($value)
    {
        if (method_exists($this, $method = 'get' . ucfirst(Str::camel($value)))) {
            return $this->{$method}();
        }

        if (method_exists($this, $method = 'is' . ucfirst(Str::camel($value)))) {
            return $this->{$method}();
        }

        throw new \InvalidArgumentException("$method does not exists");
    }
}
