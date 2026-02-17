<?php

namespace Layouts\Block;

/**
 * Class BlockFactory
 * @package Layouts\Block
 */
class BlockFactory
{

    private static $Post = null;


    public static function create($UsedBefore = true): BlockModel
    {

        // if (isset(self::$Post) && $UsedBefore) {
        //     return self::$Post;
        // }

        global $post;
        return new BlockModel($post);
    }
}
