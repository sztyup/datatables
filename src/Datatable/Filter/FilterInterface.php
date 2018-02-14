<?php

/**
 * This file is part of the SgDatatablesBundle package.
 *
 * (c) stwe <https://github.com/stwe/DatatablesBundle>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sztyup\Datatable\Filter;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Andx;

/**
 * Interface FilterInterface
 *
 * @package Sztyup\Datatable\Filter
 */
interface FilterInterface
{
    /**
     * Get template.
     *
     * @return string
     */
    public function getTemplate();

    /**
     * Add an and condition.
     *
     * @param Andx         $andExpr
     * @param QueryBuilder $qb
     * @param string       $searchField
     * @param mixed        $searchValue
     * @param string       $searchTypeOfField
     * @param int          $parameterCounter
     *
     * @return Andx
     */
    public function addAndExpression(
        Andx $andExpr,
        QueryBuilder $qb,
        $searchField,
        $searchValue,
        $searchTypeOfField,
        &$parameterCounter
    );
}
