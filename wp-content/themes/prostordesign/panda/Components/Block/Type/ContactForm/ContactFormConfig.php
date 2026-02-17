<?php

namespace Components\Block\Type\ContactForm;

use Components\Block\BlockConfig;
use Interfaces\Blockable;
use KT_Text_Field;

class ContactFormConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Kontaktní formulář", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "ContactForm";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::FORM_FIELDSET => self::getFormFieldset(),
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-contact-form-settings";
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

    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-contact-form-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_CONTENT = self::PARAMS_FIELDSET . "-content";
    const PARAMS_PHONE = self::PARAMS_FIELDSET . "-phone";
    const PARAMS_EMAIL = self::PARAMS_FIELDSET . "-email";
    const PARAMS_LINK_TEXT = self::PARAMS_FIELDSET . "link-text";
    const PARAMS_LINK_URL = self::PARAMS_FIELDSET . "link-url";
    const PARAMS_IMAGE_ID = self::PARAMS_FIELDSET . "-image-id";


    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTrumbowygTextarea(self::PARAMS_CONTENT, __("Popisek", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_PHONE, __("Telefon:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_EMAIL, __("Email:", "PD_ADMIN_DOMAIN"))
            ->setInputType(KT_Text_Field::INPUT_EMAIL);
        $fieldset->addText(SELF::PARAMS_LINK_TEXT, __("Text odkazu:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_LINK_URL, __("URL odkazu:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::PARAMS_IMAGE_ID, __("Zástupný obrázek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const FORM_FIELDSET = BlockConfig::FORM_PREFIX . "-contact-form-form";
    const FORM_TITLE = self::FORM_FIELDSET . "-title";
    const FORM_DESCRIPTION = self::FORM_FIELDSET . "-description";


    public static function getFormFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FORM_FIELDSET, __("Nastavení formuláře", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::FORM_FIELDSET);

        $fieldset->addText(self::FORM_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::FORM_DESCRIPTION, __("Popisek", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
