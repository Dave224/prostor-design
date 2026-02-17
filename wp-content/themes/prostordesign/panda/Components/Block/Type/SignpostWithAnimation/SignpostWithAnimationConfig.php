<?php

namespace Components\Block\Type\SignpostWithAnimation;

use Components\Block\Block;
use Components\Block\BlockConfig;
use Interfaces\Blockable;
use KT_Text_Field;

class SignpostWithAnimationConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Rozcestník s animací", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "SignpostWithAnimation";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::ITEM_DYNAMIC_FIELDSET => self::getItemDynamicFieldset()
        ];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::ITEM_FIELDSET => self::getItemsFieldset()
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-about-company-settings";
    const SETTINGS_SPACE_TOP = self::SETTINGS_FIELDSET . "-space-top";
    const SETTINGS_SPACE_BOT = self::SETTINGS_FIELDSET . "-space-bot";
    const SETTINGS_DIVIDER = self::SETTINGS_FIELDSET . "-divider";

    public static function getSettingsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SETTINGS_FIELDSET, __("Nastavení bloku", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SETTINGS_FIELDSET);

        $fieldset->addSwitch(self::SETTINGS_SPACE_TOP, __("Mezera nad blokem:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::SETTINGS_SPACE_BOT, __("Mezera pod blokem:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::SETTINGS_DIVIDER, __("Oddělovač pod blokem:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-about-company-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_CONTENT = self::PARAMS_FIELDSET . "-content";
    const PARAMS_BUTTON_TEXT = self::PARAMS_FIELDSET . "button-text";
    const PARAMS_BUTTON_URL = self::PARAMS_FIELDSET . "button-url";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTrumbowygTextarea(self::PARAMS_CONTENT, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_BUTTON_URL, __("URL Tlačítka:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const ITEM_FIELDSET = BlockConfig::FORM_PREFIX . "-item";
    const ITEM_TITLE = self::ITEM_FIELDSET . "-title";
    const ITEM_DESC = self::ITEM_FIELDSET . "-desc";
    const ITEM_BUTTON_TEXT = self::ITEM_FIELDSET . "-button-text";
    const ITEM_BUTTON_URL = self::ITEM_FIELDSET . "-button-url";
    const ITEM_IMAGE_ID = self::ITEM_FIELDSET . "-image-id";

    public static function getItemsFieldset()
    {
        $fieldest = new \KT_Form_Fieldset(self::ITEM_FIELDSET, __("Položky rozcestníku", "PD_ADMIN_DOMAIN"));
        $fieldest->setPostPrefix(self::ITEM_FIELDSET);

        $fieldest->addText(self::ITEM_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldest->addTrumbowygTextarea(self::ITEM_DESC, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldest->addText(self::ITEM_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldest->addText(self::ITEM_BUTTON_URL, __("URL Tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldest->addMedia(self::ITEM_IMAGE_ID, __("Obrázek:", "PD_ADMIN_DOMAIN"));

        return $fieldest;
    }

    const ITEM_DYNAMIC_FIELDSET = BlockConfig::FORM_PREFIX . "-item-dynamic";
    const ITEM_DYNAMIC_FIELD = self::ITEM_DYNAMIC_FIELDSET . "-field";

    public static function getItemDynamicFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::ITEM_DYNAMIC_FIELDSET, __("Položky rozcestníku", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::ITEM_DYNAMIC_FIELDSET);

        $fieldset->addFieldset(self::ITEM_DYNAMIC_FIELD, __("Položky:", "PD_ADMIN_DOMAIN"), [self::class, self::ITEM_FIELDSET]);

        return $fieldset;
    }
}
