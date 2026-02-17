<?php

namespace Components\Block\Type\SignpostServices;

use Utils\Util;
use KT_Text_Field;
use Enums\SignpostEnum;
use Interfaces\Blockable;
use Components\Block\BlockConfig;
use KT_Field_Validator;

class SignpostServicesConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Rozcestník služby", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "SignpostServices";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::DYNAMIC_SIGNPOST_ITEMS_FIELDSET => self::getDynamicSingpostItemsFieldset()

        ];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::SIGNPOST_ITEMS_FIELDSET => self::getSingpostItemsFieldset()
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-signpost-services-settings";
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

    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-signpost-services-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_CONTENT = self::PARAMS_FIELDSET . "-content";
    const PARAMS_VARIANT = self::PARAMS_FIELDSET . "-variant";

    public static function getParamsFieldset()
    {
        $VariantsEnum = new SignpostEnum();
        $Variants = Util::arrayRemoveByKey($VariantsEnum->getTranslates(), SignpostEnum::NONE);

        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::PARAMS_CONTENT, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSelect(self::PARAMS_VARIANT, __("Varianta:", "PD_ADMIN_DOMAIN"))
            ->setOptionsData($Variants);

        return $fieldset;
    }

    const SIGNPOST_ITEMS_FIELDSET = BlockConfig::FORM_PREFIX . "-signpost-items";
    const SIGNPOST_ITEMS_TITLE = self::SIGNPOST_ITEMS_FIELDSET . "-title";
    const SIGNPOST_ITEMS_DESCRIPTION = self::SIGNPOST_ITEMS_FIELDSET . "-description";
    const SIGNPOST_ITEMS_IMAGE_ID = self::SIGNPOST_ITEMS_FIELDSET . "-image-id";
    const SIGNPOST_ITEMS_BUTTON_TEXT = self::SIGNPOST_ITEMS_FIELDSET . "-button-text";
    const SIGNPOST_ITEMS_BUTTON_URL = self::SIGNPOST_ITEMS_FIELDSET . "-button-url";

    public static function getSingpostItemsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SIGNPOST_ITEMS_FIELDSET, __("Položky rozcestníku", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SIGNPOST_ITEMS_FIELDSET);

        $fieldset->addText(self::SIGNPOST_ITEMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::SIGNPOST_ITEMS_DESCRIPTION, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::SIGNPOST_ITEMS_IMAGE_ID, __("Obrázek", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::SIGNPOST_ITEMS_BUTTON_TEXT, __("Text tlačítka", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::SIGNPOST_ITEMS_BUTTON_URL, __("URL tlačítka", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const DYNAMIC_SIGNPOST_ITEMS_FIELDSET = BlockConfig::FORM_PREFIX . "-dynamic-signpost-items";
    const DYNAMIC_SIGNPOST_ITEMS_FIELD = self::DYNAMIC_SIGNPOST_ITEMS_FIELDSET . "-field";

    public static function getDynamicSingpostItemsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::DYNAMIC_SIGNPOST_ITEMS_FIELDSET, __("Položky rozcestníku", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::DYNAMIC_SIGNPOST_ITEMS_FIELDSET);

        $fieldset->addFieldset(self::DYNAMIC_SIGNPOST_ITEMS_FIELD, __("Položky", "PD_ADMIN_DOMAIN"), [self::class, self::SIGNPOST_ITEMS_FIELDSET]);

        return $fieldset;
    }
}
