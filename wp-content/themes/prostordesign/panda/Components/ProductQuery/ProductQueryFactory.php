<?php

namespace Components\ProductQuery;

use Components\ProductQuery\ProductQuery;

/**
 * Class ProductQueryFactory
 * @package Components\ProductQuery
 */
class ProductQueryFactory
{
    public static function create($Count = ProductQuery::DEFAULT_COUNT, $PostIn = [], $CategoryIds = []): ProductQuery
    {
        return new ProductQuery($Count, $PostIn, $CategoryIds);
    }
}
