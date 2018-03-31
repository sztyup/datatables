<?php

/**
 * This file is part of the SgDatatablesBundle package.
 *
 * (c) stwe <https://github.com/stwe/DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sztyup\Datatable\Column;

use Sztyup\Datatable\Filter\TextFilter;
use Sztyup\Datatable\Editable\EditableInterface;
use Sztyup\Datatable\Helper;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Exception;

/**
 * Class DateTimeColumn
 *
 * @package Sztyup\Datatable\Column
 */
class DateTimeColumn extends AbstractColumn
{
    /**
     * This Column is editable.
     */
    use EditableTrait;

    /**
     * The Column is filterable.
     */
    use FilterableTrait;

    /**
     * Moment.js date format.
     * Default: 'lll'
     *
     * @link http://momentjs.com/
     *
     * @var string
     */
    protected $dateFormat;

    /**
     * Use the time ago format.
     * Default: false
     *
     * @var bool
     */
    protected $timeago;

    //-------------------------------------------------
    // ColumnInterface
    //-------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function renderSingleField(array &$row)
    {
        $path = Helper::getDataPropertyPath($this->data);

        if (true === $this->isEditableContentRequired($row)) {
            $content = $this->renderTemplate($this->accessor->getValue($row, $path), $row[$this->editable->getPk()]);
        } else {
            $content = $this->renderTemplate($this->accessor->getValue($row, $path));
        }

        $this->accessor->setValue($row, $path, $content);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function renderToMany(array &$row)
    {
        $value = null;
        $path = Helper::getDataPropertyPath($this->data, $value);

        $entries = $this->accessor->getValue($row, $path);

        if (count($entries) > 0) {
            foreach ($entries as $key => $entry) {
                $currentPath = $path.'['.$key.']'.$value;
                $currentObjectPath = Helper::getPropertyPathObjectNotation($path, $key, $value);

                if (true === $this->isEditableContentRequired($row)) {
                    $content = $this->renderTemplate(
                        $this->accessor->getValue($row, $currentPath),
                        $row[$this->editable->getPk()],
                        $currentObjectPath
                    );
                } else {
                    $content = $this->renderTemplate($this->accessor->getValue($row, $currentPath));
                }

                $this->accessor->setValue($row, $currentPath, $content);
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCellContentTemplate()
    {
        return 'datatables::render.datetime';
    }

    /**
     * {@inheritdoc}
     */
    public function renderPostCreateDatatableJsContent()
    {
        if ($this->editable instanceof EditableInterface) {
            return $this->viewFactory->make('datatables::column.column_post_create_dt.js', [
                'column_class_editable_selector' => $this->getColumnClassEditableSelector(),
                'editable_options' => $this->editable,
                'entity_class_name' => $this->getEntityClassName(),
                'column_dql' => $this->dql,
                'original_type_of_field' => $this->getOriginalTypeOfField(),
            ])->render();
        }

        return null;
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
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'date_format' => 'Y-m-d H:i:s',
            'timeago' => false,
            'filter' => [TextFilter::class, []],
            'editable' => null,
        ]);

        $resolver->setAllowedTypes('date_format', 'string');
        $resolver->setAllowedTypes('timeago', 'bool');
        $resolver->setAllowedTypes('filter', 'array');
        $resolver->setAllowedTypes('editable', ['null', 'array']);

        return $this;
    }

    //-------------------------------------------------
    // Getters && Setters
    //-------------------------------------------------

    /**
     * Get date format.
     *
     * @return string
     */
    public function getDateFormat()
    {
        return $this->dateFormat;
    }

    /**
     * Set date format.
     *
     * @param string $dateFormat
     *
     * @return $this
     * @throws Exception
     */
    public function setDateFormat($dateFormat)
    {
        if (empty($dateFormat) || !is_string($dateFormat)) {
            throw new Exception('DateTimeColumn::setDateFormat(): A non-empty string is expected.');
        }

        $this->dateFormat = $dateFormat;

        return $this;
    }

    /**
     * Get timeago.
     *
     * @return bool
     */
    public function isTimeago()
    {
        return $this->timeago;
    }

    /**
     * Set timeago.
     *
     * @param bool $timeago
     *
     * @return $this
     */
    public function setTimeago($timeago)
    {
        $this->timeago = $timeago;

        return $this;
    }

    //-------------------------------------------------
    // Helper
    //-------------------------------------------------

    /**
     * Render template.
     *
     * @param string|null $data
     * @param string|null $pk
     * @param string|null $path
     *
     * @return mixed|string
     */
    private function renderTemplate($data, $pk = null, $path = null)
    {
        $renderVars = [
            'data' => $data,
            'default_content' => $this->getDefaultContent(),
            'date_format' => $this->dateFormat,
            'timeago' => $this->timeago,
            'datatable_name' => $this->getDatatableName(),
            'row_id' => Helper::generateUniqueID(),
        ];

        // editable vars
        if (null !== $pk) {
            $renderVars = array_merge($renderVars, [
                'column_class_editable_selector' => $this->getColumnClassEditableSelector(),
                'pk' => $pk,
                'path' => $path,
            ]);
        }

        return $this->viewFactory->make(
            $this->getCellContentTemplate(),
            $renderVars
        )->render();
    }
}
