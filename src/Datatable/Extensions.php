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

use Sztyup\Datatable\Extension\Buttons;
use Sztyup\Datatable\Extension\Responsive;
use Sztyup\Datatable\Extension\Select;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Extensions
 *
 * @package Sztyup\Datatable
 */
class Extensions
{
    /**
     * Use the OptionsResolver.
     */
    use OptionsTrait;

    //-------------------------------------------------
    // DataTables - Extensions
    //-------------------------------------------------

    /**
     * The Buttons extension.
     * Default: null
     *
     * @var null|array|bool|Buttons
     */
    protected $buttons;

    /**
     * The Responsive Extension.
     * Automatically optimise the layout for different screen sizes.
     * Default: null
     *
     * @var null|array|bool|Responsive
     */
    protected $responsive;

    /**
     * The Select Extension.
     * Select adds item selection capabilities to a DataTable.
     * Default: null
     *
     * @var null|array|bool|Select
     */
    protected $select;

    //-------------------------------------------------
    // Ctor.
    //-------------------------------------------------

    /**
     * Extensions constructor.
     * @throws \Exception
     * @throws \TypeError
     */
    public function __construct()
    {
        $this->initOptions();
    }

    //-------------------------------------------------
    // Options
    //-------------------------------------------------

    /**
     * Config options.
     *
     * @param OptionsResolver $resolver
     *
     * @return $this
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'buttons' => null,
            'responsive' => null,
            'select' => null,
        ]);

        $resolver->setAllowedTypes('buttons', ['null', 'array', 'bool']);
        $resolver->setAllowedTypes('responsive', ['null', 'array', 'bool']);
        $resolver->setAllowedTypes('select', ['null', 'array', 'bool']);

        return $this;
    }

    //-------------------------------------------------
    // Getters && Setters
    //-------------------------------------------------

    /**
     * Get buttons.
     *
     * @return null|array|bool|Buttons
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Set buttons.
     *
     * @param null|array|bool $buttons
     *
     * @return $this
     * @throws \Exception
     * @throws \TypeError
     */
    public function setButtons($buttons)
    {
        if (is_array($buttons)) {
            $newButton = new Buttons();
            $this->buttons = $newButton->set($buttons);
        } else {
            $this->buttons = $buttons;
        }

        return $this;
    }

    /**
     * Get responsive.
     *
     * @return null|array|bool|Responsive
     */
    public function getResponsive()
    {
        return $this->responsive;
    }

    /**
     * Set responsive.
     *
     * @param null|array|bool $responsive
     *
     * @return $this
     * @throws \Exception
     * @throws \TypeError
     */
    public function setResponsive($responsive)
    {
        if (is_array($responsive)) {
            $newResponsive = new Responsive();
            $this->responsive = $newResponsive->set($responsive);
        } else {
            $this->responsive = $responsive;
        }

        return $this;
    }

    /**
     * Get select.
     *
     * @return null|array|bool|Select
     */
    public function getSelect()
    {
        return $this->select;
    }

    /**
     * Set select.
     *
     * @param null|array|bool $select
     *
     * @return $this
     * @throws \Exception
     * @throws \TypeError
     */
    public function setSelect($select)
    {
        if (is_array($select)) {
            $newSelect = new Select();
            $this->select = $newSelect->set($select);
        } else {
            $this->select = $select;
        }

        return $this;
    }
}
