<?php

namespace Components\Block\Type\IntroServices;

use Components\Block\BlockConfig;
use Interfaces\Blockable;
use KT_Text_Field;

class IntroServicesConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Intro", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "IntroServices";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::FORM_FIELDSET => self::getFormFieldset(),
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-intro-services-settings";
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

    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-intro-services-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_CONTENT = self::PARAMS_FIELDSET . "-content";
    const PARAMS_IMAGE_ID = self::PARAMS_FIELDSET . "-image-id";
    const PARAMS_BUTTON_TEXT = self::PARAMS_FIELDSET . "-button-text";
    const PARAMS_BUTTON_URL = self::PARAMS_FIELDSET . "-button-url";
    const PARAMS_BUTTON_TARGET = self::PARAMS_FIELDSET . "-button-target";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::PARAMS_CONTENT, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::PARAMS_IMAGE_ID, __("Obrázek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(SELF::PARAMS_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_BUTTON_URL, __("URL tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(SELF::PARAMS_BUTTON_TARGET, __("Otevřít odkaz na nové kartě:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const FORM_FIELDSET = BlockConfig::FORM_PREFIX . "-intro-services-form";
    const FORM_TITLE = self::FORM_FIELDSET . "-title";
    const FORM_DESC = self::FORM_FIELDSET . "-desc";

    public static function getFormFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FORM_FIELDSET, __("Nastavení formuláře", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::FORM_FIELDSET);

        $fieldset->addText(self::FORM_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::FORM_DESC, __("Popisek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
