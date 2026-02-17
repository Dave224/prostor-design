<?php

namespace Components\Product\Term;

/**
 * Class ProductCategoryFactory
 * @package Components\Product\Term
 */
class ProductCategoryFactory
{
    public static function create(): ProductCategoryModel
    {
        return new ProductCategoryModel(get_queried_object());
    }

    public static function createById($CategoryId): ProductCategoryModel
    {
        $Category = get_term($CategoryId);
        return new ProductCategoryModel($Category);
    }
}
