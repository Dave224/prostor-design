<?php

namespace Components\Block\Type\TechnologySlider;


/**
 * Class TechnologySliderFactory
 * @package Components\Type\TechnologySlider
 */
class TechnologySliderFactory
{
    public static function create(): TechnologySliderModel
    {
        global $post;
        return new TechnologySliderModel($post);
    }
}
