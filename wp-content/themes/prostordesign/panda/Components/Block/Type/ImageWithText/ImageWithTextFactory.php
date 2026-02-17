<?php

namespace Components\Block\Type\ImageWithText;


/**
 * Class ImageWithTextFactory
 * @package Components\Type\ImageWithText
 */
class ImageWithTextFactory
{
    public static function create(): ImageWithTextModel
    {
        global $post;
        return new ImageWithTextModel($post);
    }
}
