<?php

namespace Components\Block\Type\Steps;

use Components\Block\BlockConfig;
use Interfaces\Blockable;

class StepsConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Kroky (principy fungování)", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "Steps";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::ITEMS_DYNAMIC_FIELDSET => self::getItemsDynamicFieldset()
        ];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::ITEMS_FIELDSET => self::getItemsFieldset()
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-steps-settings";
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


    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-steps-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_CONTENT = self::PARAMS_FIELDSET . "-content";
    const PARAMS_BACKGROUND = self::PARAMS_FIELDSET . "-background";
    const PARAMS_BUTTON_TEXT = self::PARAMS_FIELDSET . "-button-text";
    const PARAMS_BUTTON_URL = self::PARAMS_FIELDSET . "-button-url";
    const PARAMS_BUTTON_TARGET = self::PARAMS_FIELDSET . "-button-target";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::PARAMS_CONTENT, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::PARAMS_BACKGROUND, __("Pozadí:", "PD_ADMIN_DOMAIN"), "Tmavé", "Světlé");
        $fieldset->addText(self::PARAMS_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_BUTTON_URL, __("URL tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::PARAMS_BUTTON_TARGET, __("Otevřít odkaz do nového okna:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const ITEMS_FIELDSET = BlockConfig::FORM_PREFIX . "-steps-items";
    const ITEMS_TITLE = self::ITEMS_FIELDSET . "-title";
    const ITEMS_DESCRIPTION = self::ITEMS_FIELDSET . "-description";

    public static function getItemsFieldset()
    {
        $fieldest = new \KT_Form_Fieldset(self::ITEMS_FIELDSET, __("Položky", "PD_ADMIN_DOMAIN"));
        $fieldest->setPostPrefix(self::ITEMS_FIELDSET);

        $fieldest->addText(self::ITEMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldest->addText(self::ITEMS_DESCRIPTION, __("Popisek:", "PD_ADMIN_DOMAIN"));

        return $fieldest;
    }

    const ITEMS_DYNAMIC_FIELDSET = BlockConfig::FORM_PREFIX . "-steps-items-dynamic";
    const ITEMS_DYNAMIC_FIELD = self::ITEMS_DYNAMIC_FIELDSET . "-field";

    public static function getItemsDynamicFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::ITEMS_DYNAMIC_FIELDSET, __("Položky", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::ITEMS_DYNAMIC_FIELDSET);

        $fieldset->addFieldset(self::ITEMS_DYNAMIC_FIELD, __("Položky", "PD_ADMIN_DOMAIN"), [self::class, self::ITEMS_FIELDSET]);

        return $fieldset;
    }
}
