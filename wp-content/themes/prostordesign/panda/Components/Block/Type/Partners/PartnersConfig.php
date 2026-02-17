<?php

namespace Components\Block\Type\Partners;

use Components\Block\BlockConfig;
use Interfaces\Blockable;
use KT_Text_Field;

class PartnersConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Partneři", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "Partners";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::PARTNER_DYNAMIC_FIELDSET => self::getItemDynamicFieldset()
        ];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::PARTNER_FIELDSET => self::getPartnerFieldset()
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


    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-partners-params";
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

    const PARTNER_FIELDSET = BlockConfig::FORM_PREFIX . "-partner";
    const PARTNER_TITLE = self::PARTNER_FIELDSET . "-title";
    const PARTNER_IMAGE_ID = self::PARTNER_FIELDSET . "-image-id";
    const PARTNER_LINK_URL = self::PARTNER_FIELDSET . "-link-url";

    public static function getPartnerFieldset()
    {
        $fieldest = new \KT_Form_Fieldset(self::PARTNER_FIELDSET, __("Výběr partnerů", "PD_ADMIN_DOMAIN"));
        $fieldest->setPostPrefix(self::PARTNER_FIELDSET);

        $fieldest->addText(self::PARTNER_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldest->addMedia(self::PARTNER_IMAGE_ID, __("Obrázek:", "PD_ADMIN_DOMAIN"));
        $fieldest->addText(self::PARTNER_LINK_URL, __("URL odkazu", "PD_ADMIN_DOMAIN"));

        return $fieldest;
    }

    const PARTNER_DYNAMIC_FIELDSET = BlockConfig::FORM_PREFIX . "-partner-dynamic";
    const PARTNER_DYNAMIC_FIELD = self::PARTNER_DYNAMIC_FIELDSET . "-field";

    public static function getItemDynamicFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARTNER_DYNAMIC_FIELDSET, __("Výběr partnerů", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARTNER_DYNAMIC_FIELDSET);

        $fieldset->addFieldset(self::PARTNER_DYNAMIC_FIELD, __("Partner", "PD_ADMIN_DOMAIN"), [self::class, self::PARTNER_FIELDSET]);

        return $fieldset;
    }
}
