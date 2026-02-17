<?php

namespace Components\Block\Type\SmallBannerWithText;


/**
 * Class SmallBannerWithTextFactory
 * @package Components\Type\SmallBannerWithText
 */
class SmallBannerWithTextFactory
{
    public static function create(): SmallBannerWithTextModel
    {
        global $post;
        return new SmallBannerWithTextModel($post);
    }
}