<?php

namespace Components\Product\Term;

use Interfaces\Configable;

/**
 * Class ProductCategoryConfig
 * @package Components\Product\Term
 */
class ProductCategoryConfig implements Configable
{

    const FORM_PREFIX = ProductCategory::PREFIX;

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
        if (!taxonomy_exists(ProductCategory::KEY)) {
            return;
        }

        // Looks like its not even registering and using default WooCommerce one
    }

    // --- Nastavení stránky ---------------------------

    const SETTINGS_FIELDSET = self::FORM_PREFIX . "-settings";
    const SETTINGS_THUMBNAIL = self::SETTINGS_FIELDSET . "-thumbnail";
    const SETTINGS_IMAGE_FOR_BLOCK = self::SETTINGS_FIELDSET . "-image-for-block";
    const SETTINGS_ORDER = self::SETTINGS_FIELDSET . "-order";

    public static function getSettingsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SETTINGS_FIELDSET, __("Nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SETTINGS_FIELDSET);

        $fieldset->addMedia(self::SETTINGS_THUMBNAIL, __("Náhledový obrázek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::SETTINGS_IMAGE_FOR_BLOCK, __("Obrázek pro blok:", "PD_ADMIN_DOMAIN"));
        $fieldset->addNumber(self::SETTINGS_ORDER, __("Pořadí:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
