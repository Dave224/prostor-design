<?php

namespace Components\Block\Type\ProductCategories;


/**
 * Class ProductCategoriesFactory
 * @package Components\Type\ProductCategories
 */
class ProductCategoriesFactory
{
    public static function create(): ProductCategoriesModel
    {
        global $post;
        return new ProductCategoriesModel($post);
    }
}
