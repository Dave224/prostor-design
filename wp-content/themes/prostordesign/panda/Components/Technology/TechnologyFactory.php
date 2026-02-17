<?php

namespace Components\Technology;

/**
 * Class TechnologyFactory
 * @package Components\Technology
 */
class TechnologyFactory
{
    public static function create(): TechnologyModel
    {
        global $post;
        return new TechnologyModel($post);
    }

    public static function createById($PostId): TechnologyModel
    {
        $Post = get_post($PostId);
        return new TechnologyModel($Post);
    }
}
