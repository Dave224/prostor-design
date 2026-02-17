<?php

namespace Components\Block\Type\SignpostServices;


/**
 * Class SignpostServicesFactory
 * @package Components\Type\SignpostServices
 */
class SignpostServicesFactory
{
    public static function create(): SignpostServicesModel
    {
        global $post;
        return new SignpostServicesModel($post);
    }
}
