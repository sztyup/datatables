<?php

namespace Sztyup\Datatable\Column;

use Symfony\Component\OptionsResolver\Options;
use Sztyup\Datatable\Filter\SelectFilter;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @package Sztyup\Datatable\Column
 */
class EnumColumn extends Column
{
    public function getColumnType()
    {
        return 'enum';
    }

    protected $enums;

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

        $resolver->remove('filter');

        $resolver->setDefaults([
            'editable' => null,
            'enums' => []
        ]);

        $resolver->setAllowedTypes('editable', ['null', 'array']);
        $resolver->setAllowedTypes('enums', ['null', 'array']);

        $resolver->setNormalizer('enums', function (Options $options, $value) {
            $types = [];
            foreach ($value as $key => $item) {
                $types[$key] = 'eq';
            }

            $this->setFilter([SelectFilter::class, [
                'multiple' => true,
                'cancel_button' => true,
                'select_search_types' => $types,
                'select_options' => $value,
            ]]);
            return $value;
        });

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEnums()
    {
        return $this->enums;
    }

    /**
     * @param mixed $enums
     * @return EnumColumn
     */
    public function setEnums($enums)
    {
        $this->enums = $enums;

        return $this;
    }
}
