<?php

namespace Components\Block\Type\Benefits;

use Components\Block\BlockConfig;
use Interfaces\Blockable;

class BenefitsConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Výhody (usps)", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "Benefits";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::BENEFITS_DYNAMIC_FIELDSET => self::getBenefitsDynamicFieldset()
        ];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::BENEFITS_FIELDSET => self::getBenefitsFieldset()
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-benefits-settings";
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


    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-benefits-params";
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

    const BENEFITS_FIELDSET = BlockConfig::FORM_PREFIX . "-benefits";
    const BENEFITS_TITLE = self::BENEFITS_FIELDSET . "-title";
    const BENEFITS_IMAGE_ID = self::BENEFITS_FIELDSET . "-image-id";
    const BENEFITS_DESCRIPTION = self::BENEFITS_FIELDSET . "-description";

    public static function getBenefitsFieldset()
    {
        $fieldest = new \KT_Form_Fieldset(self::BENEFITS_FIELDSET, __("Výhody", "PD_ADMIN_DOMAIN"));
        $fieldest->setPostPrefix(self::BENEFITS_FIELDSET);

        $fieldest->addText(self::BENEFITS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldest->addMedia(self::BENEFITS_IMAGE_ID, __("Obrázek:", "PD_ADMIN_DOMAIN"));
        $fieldest->addText(self::BENEFITS_DESCRIPTION, __("Popisek:", "PD_ADMIN_DOMAIN"));

        return $fieldest;
    }

    const BENEFITS_DYNAMIC_FIELDSET = BlockConfig::FORM_PREFIX . "-benefits-dynamic";
    const BENEFITS_DYNAMIC_FIELD = self::BENEFITS_DYNAMIC_FIELDSET . "-field";

    public static function getBenefitsDynamicFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::BENEFITS_DYNAMIC_FIELDSET, __("Výhody", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::BENEFITS_DYNAMIC_FIELDSET);

        $fieldset->addFieldset(self::BENEFITS_DYNAMIC_FIELD, __("Výhody", "PD_ADMIN_DOMAIN"), [self::class, self::BENEFITS_FIELDSET]);

        return $fieldset;
    }
}
