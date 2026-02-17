<?php

namespace Components\Block\Type\ProductCategorySlider;


/**
 * Class ProductCategorySliderFactory
 * @package Components\Type\ProductCategorySlider
 */
class ProductCategorySliderFactory
{
    public static function create(): ProductCategorySliderModel
    {
        global $post;
        return new ProductCategorySliderModel($post);
    }
}
