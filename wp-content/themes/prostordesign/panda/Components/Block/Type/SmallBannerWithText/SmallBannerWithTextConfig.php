<?php

namespace Components\Block\Type\SmallBannerWithText;

use Components\Block\BlockConfig;
use Interfaces\Blockable;
use KT_Switch_Field;
use KT_Text_Field;

class SmallBannerWithTextConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Banner", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "SmallBannerWithText";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-small-banner-with-text-settings";
    const SETTINGS_BUTTON_TEXT = self::SETTINGS_FIELDSET . "-button-text";
    const SETTINGS_BUTTON_URL = self::SETTINGS_FIELDSET . "-button-url";
    const SETTINGS_NEW_TAB = self::SETTINGS_FIELDSET . "-new-tab";
    const SETTINGS_CONTENT = self::SETTINGS_FIELDSET . "-content";

    public static function getSettingsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SETTINGS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SETTINGS_FIELDSET);

        $fieldset->addText(self::SETTINGS_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::SETTINGS_BUTTON_URL, __("URL tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::SETTINGS_NEW_TAB, __("Otevřít v novém okně:", "PD_ADMIN_DOMAIN"))
            ->setDefaultValue(KT_Switch_Field::NO);
        $fieldset->addTrumbowygTextareaMinimal(self::SETTINGS_CONTENT, __("Popisek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
