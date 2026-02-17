<?php

namespace Components\Block\Type\TechnologySlider;

use Components\Block\BlockConfig;
use Components\Technology\Technology;
use Interfaces\Blockable;

class TechnologySliderConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Technologie (slider)", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "TechnologySlider";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
        ];
    }

    public static function getAllDynamicFieldsets()
    {
        return [];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-technology-slider-settings";
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


    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-technology-slider-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_LINK_TEXT = self::PARAMS_FIELDSET . "-link-text";
    const PARAMS_LINK_URL = self::PARAMS_FIELDSET . "-link-url";
    const PARAMS_ROBOTS = self::PARAMS_FIELDSET . "-robots";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_LINK_TEXT, __("Text odkazu:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_LINK_URL, __("URL odkazu:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMultiSelect(SELF::PARAMS_ROBOTS, __("Roboti:", "PD_ADMIN_DOMAIN"))
            ->setFirstEmpty()
            ->setDataManager(new \KT_Custom_Post_Data_Manager([
                "post_type" => Technology::KEY,
                "post_status" => "publish",
                "posts_per_page" => -1,
                "orderby" => "menu_order",
                "order" => \KT_Repository::ORDER_ASC,
            ]));

        return $fieldset;
    }
}
