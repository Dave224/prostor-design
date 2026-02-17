<?php

namespace Components\Block\Type\IntroServices;


/**
 * Class IntroServicesFactory
 * @package Components\Type\IntroServices
 */
class IntroServicesFactory
{
    public static function create(): IntroServicesModel
    {
        global $post;
        return new IntroServicesModel($post);
    }
}
