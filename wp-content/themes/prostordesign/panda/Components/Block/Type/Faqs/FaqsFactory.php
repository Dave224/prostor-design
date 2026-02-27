<?php

namespace Components\Block\Type\Faqs;


/**
 * Class FaqsFactory
 * @package Components\Type\Faqs
 */
class FaqsFactory
{
    public static function create(): FaqsModel
    {
        global $post;
        return new FaqsModel($post);
    }
}
