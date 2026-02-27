<?php

namespace Components\Block\Type\Faqs;

use Components\Block\BlockConfig;
use Interfaces\Blockable;

class FaqsConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Často kladené dotazy (faqs)", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "Faqs";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::FAQS_DYNAMIC_FIELDSET => self::getFaqsDynamicFieldset()
        ];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::FAQS_FIELDSET => self::getFaqsFieldset()
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-faqs-settings";
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


    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-faqs-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_CONTENT = self::PARAMS_FIELDSET . "-content";
    const PARAMS_BACKGROUND = self::PARAMS_FIELDSET . "-background";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::PARAMS_CONTENT, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::PARAMS_BACKGROUND, __("Pozadí:", "PD_ADMIN_DOMAIN"), "Tmavé", "Světlé");

        return $fieldset;
    }

    const FAQS_FIELDSET = BlockConfig::FORM_PREFIX . "-faqs";
    const FAQS_TITLE = self::FAQS_FIELDSET . "-title";
    const FAQS_DESCRIPTION = self::FAQS_FIELDSET . "-description";

    public static function getFaqsFieldset()
    {
        $fieldest = new \KT_Form_Fieldset(self::FAQS_FIELDSET, __("Faqs", "PD_ADMIN_DOMAIN"));
        $fieldest->setPostPrefix(self::FAQS_FIELDSET);

        $fieldest->addText(self::FAQS_TITLE, __("Otázka:", "PD_ADMIN_DOMAIN"));
        $fieldest->addTrumbowygTextarea(self::FAQS_DESCRIPTION, __("Odpověď:", "PD_ADMIN_DOMAIN"));

        return $fieldest;
    }

    const FAQS_DYNAMIC_FIELDSET = BlockConfig::FORM_PREFIX . "-faqs-dynamic";
    const FAQS_DYNAMIC_FIELD = self::FAQS_DYNAMIC_FIELDSET . "-field";

    public static function getFaqsDynamicFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FAQS_DYNAMIC_FIELDSET, __("Faqs", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::FAQS_DYNAMIC_FIELDSET);

        $fieldset->addFieldset(self::FAQS_DYNAMIC_FIELD, __("Faqs", "PD_ADMIN_DOMAIN"), [self::class, self::FAQS_FIELDSET]);

        return $fieldset;
    }
}
