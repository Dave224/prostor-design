<?php

namespace Components\Block\Type\Contact;

use Components\Block\BlockConfig;
use Interfaces\Blockable;
use KT_Text_Field;

class ContactConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Kontakt firma", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "Contact";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::CONTACT_FIELDSET => self::getContactFieldset(),
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-contact-settings";
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

    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-contact-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_SETTINGS = self::PARAMS_FIELDSET . "-settings";
    const PARAMS_IMAGE_ID = self::PARAMS_FIELDSET . "-image-id";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(SELF::PARAMS_SETTINGS, __("Použít obecné nastavení:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::PARAMS_IMAGE_ID, __("Obrázek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const CONTACT_FIELDSET = BlockConfig::FORM_PREFIX . "-contact-contact";
    const CONTACT_PHONE = self::CONTACT_FIELDSET . "-phone";
    const CONTACT_EMAIL = self::CONTACT_FIELDSET . "-email";
    const CONTACT_STREET = self::CONTACT_FIELDSET . "-street";
    const CONTACT_PSC = self::CONTACT_FIELDSET . "-psc";
    const CONTACT_CITY = self::CONTACT_FIELDSET . "-city";
    const CONTACT_ICO = self::CONTACT_FIELDSET . "-ico";
    const CONTACT_DIC = self::CONTACT_FIELDSET . "-dic";
    const CONTACT_SIGN = self::CONTACT_FIELDSET . "-sign";

    public static function getContactFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::CONTACT_FIELDSET, __("Kontakt", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::CONTACT_FIELDSET);

        $fieldset->addText(self::CONTACT_PHONE, __("Telefon:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(SELF::CONTACT_EMAIL, __("E-mail:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_STREET, __("Ulice:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_PSC, __("PSČ:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(SELF::CONTACT_CITY, __("Město:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_ICO, __("IČO:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_DIC, __("DIČ:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::CONTACT_SIGN, __("Spisovná značka:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
