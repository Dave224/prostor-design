<?php

namespace Layouts\Page;

use Components\Block\Block;
use Interfaces\Configable;

/**
 * Class PageConfig
 * @package Layouts\Page
 */
class PageConfig implements Configable
{
    const FORM_PREFIX = "panda-page";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    public static function registerMetaboxes()
    {
        if (is_admin()){
            $pageMetaboxes = \KT_MetaBox::createMultiple(self::getAllNormalFieldsets(), KT_WP_PAGE_KEY, \KT_MetaBox_Data_Type_Enum::POST_META, false);
            foreach ($pageMetaboxes as $pageMetabox) {
                $pageMetabox->setPageTemplate("default");
                $pageMetabox->setPriority(\KT_MetaBox::PRIORITY_HIGH);
                $pageMetabox->register();
            }
        }
    }

    // --- Nastevní stránky ------------------------

    const SETTINGS_FIELDSET = self::FORM_PREFIX . "-settings";
    const SETTINGS_ASIDE = self::SETTINGS_FIELDSET . "-aside";

    public static function getSettingsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SETTINGS_FIELDSET, __("Nastavení stránky", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SETTINGS_FIELDSET);

        $fieldset->addSwitch(self::SETTINGS_ASIDE, __("Zobrazit sidebar:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
