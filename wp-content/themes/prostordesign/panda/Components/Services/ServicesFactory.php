<?php

namespace Components\Services;

/**
 * Class ServicesFactory
 * @package Components\Services
 */
class ServicesFactory
{
    public static function create(): ServicesModel
    {
        global $post;
        return new ServicesModel($post);
    }
}
