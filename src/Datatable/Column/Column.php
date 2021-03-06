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

use Sztyup\Datatable\Helper;
use Sztyup\Datatable\Filter\TextFilter;
use Sztyup\Datatable\Editable\EditableInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Column
 *
 * @package Sztyup\Datatable\Column
 */
class Column extends AbstractColumn
{
    /**
     * The Column is editable.
     */
    use EditableTrait;

    /**
     * The Column is filterable.
     */
    use FilterableTrait;

    //-------------------------------------------------
    // ColumnInterface
    //-------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function renderSingleField(array &$row)
    {
        if ($this->isEditableContentRequired($row)) {
            $path = Helper::getDataPropertyPath($this->data);

            $content = $this->renderTemplate($this->accessor->getValue($row, $path), $row[$this->editable->getPk()]);

            $this->accessor->setValue($row, $path, $content);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function renderToMany(array &$row)
    {
        if ($this->isEditableContentRequired($row)) {
            // e.g. comments[ ].createdBy.username
            //     => $path = [comments]
            //     => $value = [createdBy][username]
            $value = null;
            $path = Helper::getDataPropertyPath($this->data, $value);

            $entries = $this->accessor->getValue($row, $path);

            if (count($entries) > 0) {
                foreach ($entries as $key => $entry) {
                    $currentPath = $path.'['.$key.']'.$value;
                    $currentObjectPath = Helper::getPropertyPathObjectNotation($path, $key, $value);

                    $content = $this->renderTemplate(
                        $this->accessor->getValue($row, $currentPath),
                        $row[$this->editable->getPk()],
                        $currentObjectPath
                    );

                    $this->accessor->setValue($row, $currentPath, $content);
                }
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCellContentTemplate()
    {
        return 'render.column';
    }

    /**
     * {@inheritdoc}
     */
    public function renderPostCreateDatatableJsContent()
    {
        if ($this->editable instanceof EditableInterface) {
            return $this->viewFactory->make('column.column_post_create_dt.js', [
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
            'filter' => [TextFilter::class, []],
            'editable' => null,
        ]);

        $resolver->setAllowedTypes('filter', 'array');
        $resolver->setAllowedTypes('editable', ['null', 'array']);

        return $this;
    }

    //-------------------------------------------------
    // Helper
    //-------------------------------------------------

    /**
     * Render template.
     *
     * @param string|null $data
     * @param string      $pk
     * @param string|null $path
     *
     * @return mixed|string
     */
    private function renderTemplate($data, $pk, $path = null)
    {
        return $this->viewFactory->make($this->getCellContentTemplate(), [
                'data' => $data,
                'column_class_editable_selector' => $this->getColumnClassEditableSelector(),
                'pk' => $pk,
                'path' => $path,
        ])->render();
    }
}
