<?php

namespace Components\Block\Type\AboutCompany;


/**
 * Class AboutCompanyFactory
 * @package Components\Type\AboutCompany
 */
class AboutCompanyFactory
{
    public static function create(): AboutCompanyModel
    {
        global $post;
        return new AboutCompanyModel($post);
    }
}