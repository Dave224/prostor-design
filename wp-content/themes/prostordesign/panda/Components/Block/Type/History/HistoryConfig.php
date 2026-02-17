<?php

namespace Components\Block\Type\History;

use Components\Block\BlockConfig;
use Interfaces\Blockable;
use KT_Text_Field;

class HistoryConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Historie firmy", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "History";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::DYNAMIC_TIMELINE_FIELDSET => self::getDynamicTimelineFieldset()

        ];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::TIMELINE_FIELDSET => self::getTimelineFieldset()
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

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const TIMELINE_FIELDSET = BlockConfig::FORM_PREFIX . "-timeline";
    const TIMELINE_YEAR = self::TIMELINE_FIELDSET . "-year";
    const TIMELINE_TITLE = self::TIMELINE_FIELDSET . "-title";
    const TIMELINE_DESCRIPTION = self::TIMELINE_FIELDSET . "-description";

    public static function getTimelineFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::TIMELINE_FIELDSET, __("Časová osa", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::TIMELINE_FIELDSET);

        $fieldset->addText(self::TIMELINE_YEAR, __("Rok:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::TIMELINE_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::TIMELINE_DESCRIPTION, __("Popisek:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const DYNAMIC_TIMELINE_FIELDSET = BlockConfig::FORM_PREFIX . "-dynamic-timeline";
    const DYNAMIC_TIMELINE_FIELD = self::DYNAMIC_TIMELINE_FIELDSET . "-field";

    public static function getDynamicTimelineFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::DYNAMIC_TIMELINE_FIELDSET, __("Časová osa", "ADMIN_PROJECT_DOMAIN"));
        $fieldset->setPostPrefix(self::DYNAMIC_TIMELINE_FIELDSET);
        $fieldset->setAfterFieldsetContent("Pro zalomení titulku na určitém místě vepište '##'");

        $fieldset->addFieldset(self::DYNAMIC_TIMELINE_FIELD, __("Časová osa", "PD_ADMIN_DOMAIN"), [self::class, self::TIMELINE_FIELDSET]);

        return $fieldset;
    }
}
