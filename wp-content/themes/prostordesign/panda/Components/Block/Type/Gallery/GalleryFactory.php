<?php

namespace Components\Block\Type\Gallery;


/**
 * Class GalleryFactory
 * @package Components\Type\Gallery
 */
class GalleryFactory
{
    public static function create(): GalleryModel
    {
        global $post;
        return new GalleryModel($post);
    }
}
