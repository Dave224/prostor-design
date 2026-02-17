<?php

namespace Components\Block\Type\Partners;


/**
 * Class PartnersFactory
 * @package Components\Type\Partners
 */
class PartnersFactory
{
    public static function create(): PartnersModel
    {
        global $post;
        return new PartnersModel($post);
    }
}
