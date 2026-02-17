<?php

namespace Components\Block\Type\AboutCompany;

use Components\Block\BlockConfig;
use Interfaces\Blockable;
use KT_Text_Field;

class AboutCompanyConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("O společnosti", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "AboutCompany";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::PERSON_FIELDSET => self::getPersonFieldset(),
            self::DYNAMIC_BENEFITS_FIELDSET => self::getDynamicBenefitsFieldset()

        ];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::BENEFITS_FIELDSET => self::getBenefitsFieldset()
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
    const PARAMS_SUBTITLE = self::PARAMS_FIELDSET . "-subtitle";
    const PARAMS_CONTENT = self::PARAMS_FIELDSET . "-content";
    const PARAMS_BUTTON_TEXT = self::PARAMS_FIELDSET . "-button-text";
    const PARAMS_BUTTON_URL = self::PARAMS_FIELDSET . "-button-url";
    const PARAMS_IMAGE_ID = self::PARAMS_FIELDSET . "-img-id";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_SUBTITLE, __("Podtitulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTrumbowygTextarea(self::PARAMS_CONTENT, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(SELF::PARAMS_BUTTON_URL, __("URL Tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::PARAMS_IMAGE_ID, __("Obrázek:", "PD_ADMIN_DOMAIN"));
        $fieldset->setAfterFieldsetContent("Po zadání \"##\" do titulku se text posune na další řádek.", "P13_ADMIN_DOMAIN");

        return $fieldset;
    }

    const PERSON_FIELDSET = BlockConfig::FORM_PREFIX . "-person";
    const PERSON_NAME = self::PERSON_FIELDSET . "-name";
    const PERSON_POSITION = self::PERSON_FIELDSET . "-position";
    const PERSON_IMAGE_ID = self::PERSON_FIELDSET . "-image-id";
    const PERSON_DESC = self::PERSON_FIELDSET . "-desc";

    public static function getPersonFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PERSON_FIELDSET, __("Osoba", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PERSON_FIELDSET);

        $fieldset->addText(self::PERSON_NAME, __("Jméno:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PERSON_POSITION, __("Pozice:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::PERSON_IMAGE_ID, __("Obrázek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::PERSON_DESC, __("Popisek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const BENEFITS_FIELDSET = BlockConfig::FORM_PREFIX . "-benefits";
    const BENEFITS_TITLE = self::BENEFITS_FIELDSET . "-title";
    const BENEFITS_ICON = self::BENEFITS_FIELDSET . "-icon-image-id";

    public static function getBenefitsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::BENEFITS_FIELDSET, __("Benefity", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::BENEFITS_FIELDSET);

        $fieldset->addText(self::BENEFITS_TITLE, __("Titulek", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::BENEFITS_ICON, __("Ikonka", "PD_ADMIN_DOMAIN"));
        $fieldset->setAfterFieldsetContent("Ikonka musí být ve formátu SVG.");

        return $fieldset;
    }

    const DYNAMIC_BENEFITS_FIELDSET = BlockConfig::FORM_PREFIX . "-dynamic-benefits";
    const DYNAMIC_BENEFITS_FIELD = self::DYNAMIC_BENEFITS_FIELDSET . "-field";

    public static function getDynamicBenefitsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::DYNAMIC_BENEFITS_FIELDSET, __("Benefity", "ADMIN_PROJECT_DOMAIN"));
        $fieldset->setPostPrefix(self::DYNAMIC_BENEFITS_FIELDSET);

        $fieldset->addFieldset(self::DYNAMIC_BENEFITS_FIELD, __("Výhody", "PD_ADMIN_DOMAIN"), [self::class, self::BENEFITS_FIELDSET]);

        return $fieldset;
    }
}
