<?php

namespace Layouts\Page;

use Utils\Util;

/**
 * Class PageModel
 * @package Layouts\Page
 */
class PageModel extends \KT_WP_Post_Base_Model
{
    function __construct(\WP_Post $post)
    {
        parent::__construct($post, PageConfig::FORM_PREFIX);
    }

    //* --- getry ------------------------


    //? --- Nastavení stránky
    //? --- Prefix: Settings

    public function getSettingsAside()
    {
        return $this->getMetaValue(PageConfig::SETTINGS_ASIDE);
    }

    //* --- issety ------------------------


    //? --- Nastavení stránky
    //? --- Prefix: Settings

    public function isSettingsAside()
    {
        return Util::issetAndNotEmpty($this->getSettingsAside());
    }


    //* --- Setters ------------------------


}
