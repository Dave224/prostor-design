<?php

namespace Components\Block\Type\BlockWithCard;

use Components\Block\BlockConfig;
use Components\Person\Person;
use Interfaces\Blockable;
use KT_String_Phone;
use KT_Text_Field;

class BlockWithCardConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Blok s postranní kartou", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "BlockWithCard";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::FIRST_CARD_FIELDSET => self::getFirstCardFieldset(),
            self::SECOND_CARD_FIELDSET => self::getSecondCardFieldset(),
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-block-with-card-settings";
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

    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-block-with-card-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_CONTENT = self::PARAMS_FIELDSET . "-content";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Nastavení bloku", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addWpEditor(self::PARAMS_CONTENT, __("Obsah:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const FIRST_CARD_FIELDSET = BlockConfig::FORM_PREFIX . "-block-with-card-first";
    const FIRST_CARD_TITLE = self::FIRST_CARD_FIELDSET . "-title";
    const FIRST_CARD_DESC = self::FIRST_CARD_FIELDSET . "-desc";
    const FIRST_CARD_IMAGE = self::FIRST_CARD_FIELDSET . "-image";
    const FIRST_CARD_BUTTON_TEXT = self::FIRST_CARD_FIELDSET . "-button-text";
    const FIRST_CARD_BUTTON_URL = self::FIRST_CARD_FIELDSET . "-button-url";

    public static function getFirstCardFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FIRST_CARD_FIELDSET, __("Nastavení první karty", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::FIRST_CARD_FIELDSET);

        $fieldset->addText(self::FIRST_CARD_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(SELF::FIRST_CARD_DESC, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::FIRST_CARD_IMAGE, __("Obrázek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(SELF::FIRST_CARD_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::FIRST_CARD_BUTTON_URL, __("URL tlačítka:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const SECOND_CARD_FIELDSET = BlockConfig::FORM_PREFIX . "-block-with-card-second";
    const SECOND_CARD_TITLE = self::SECOND_CARD_FIELDSET . "-title";
    const SECOND_CARD_DESC = self::SECOND_CARD_FIELDSET . "-desc";
    const SECOND_CARD_IMAGE = self::SECOND_CARD_FIELDSET . "-image";
    const SECOND_CARD_BUTTON_TEXT = self::SECOND_CARD_FIELDSET . "-button-text";
    const SECOND_CARD_BUTTON_URL = self::SECOND_CARD_FIELDSET . "-button-url";
    const SECOND_CARD_BUTTON_ICO = self::SECOND_CARD_FIELDSET . "-button-ico";

    public static function getSecondCardFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SECOND_CARD_FIELDSET, __("Nastavení druhé karty", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SECOND_CARD_FIELDSET);

        $fieldset->addText(self::SECOND_CARD_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(SELF::SECOND_CARD_DESC, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::SECOND_CARD_IMAGE, __("Obrázek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(SELF::SECOND_CARD_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::SECOND_CARD_BUTTON_URL, __("URL tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::SECOND_CARD_BUTTON_ICO, __("Zobrazit ikonu eshopu:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
