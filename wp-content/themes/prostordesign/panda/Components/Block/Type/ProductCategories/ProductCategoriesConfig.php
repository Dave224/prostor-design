<?php

namespace Components\Block\Type\ProductCategories;

use Components\Block\BlockConfig;
use Components\Product\Term\ProductCategory;
use Components\Product\Term\ProductCategoryConfig;
use Interfaces\Blockable;

class ProductCategoriesConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Kategorie produktů", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "ProductCategories";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
        ];
    }

    public static function getAllDynamicFieldsets()
    {
        return [];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-product-categories-settings";
    const SETTINGS_SPACE_TOP = self::SETTINGS_FIELDSET . "-space-top";
    const SETTINGS_SPACE_BOT = self::SETTINGS_FIELDSET . "-space-bot";
    const SETTINGS_DIVIDER = self::SETTINGS_FIELDSET . "-divider";

    public static function getSettingsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SETTINGS_FIELDSET, __("Nastavení bloku", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SETTINGS_FIELDSET);

        $fieldset->addSwitch(self::SETTINGS_SPACE_TOP, __("Mezera nad blokem:", "PD_ADMIN_DOMAIN"))
            ->setDefaultValue(true);
        $fieldset->addSwitch(self::SETTINGS_SPACE_BOT, __("Mezera pod blokem:", "PD_ADMIN_DOMAIN"))
            ->setDefaultValue(true);
        $fieldset->addSwitch(self::SETTINGS_DIVIDER, __("Oddělovač pod blokem:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }


    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-product-categories-params";
    const PARAMS_CATEGORIES = self::PARAMS_FIELDSET . "-categories";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);
        $fieldset->setAfterFieldsetContent("<p>Pokud nevyberete žádné kategorie, zobrazí se všechny.</p>");

        $fieldset->addMultiSelect(self::PARAMS_CATEGORIES, __("Kategorie produktů:", "PD_ADMIN_DOMAIN"))
            ->setDataManager(new \KT_Taxonomy_Data_Manager(ProductCategory::KEY));

        return $fieldset;
    }
}
