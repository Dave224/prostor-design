<?php

namespace Components\Block\Type\BlockWithCard;


/**
 * Class BlockWithCardFactory
 * @package Components\Type\BlockWithCard
 */
class BlockWithCardFactory
{
    public static function create(): BlockWithCardModel
    {
        global $post;
        return new BlockWithCardModel($post);
    }
}
