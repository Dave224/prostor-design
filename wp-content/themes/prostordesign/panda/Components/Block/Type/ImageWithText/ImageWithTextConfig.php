<?php

namespace Components\Block\Type\ImageWithText;

use Components\Block\BlockConfig;
use Interfaces\Blockable;

class   ImageWithTextConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Obrázek s textem", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "ImageWithText";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET             => self::getSettingsFieldset(),
            self::ADDITIONAL_SETTINGS_FIELDSET  => self::getAdditionalSettingsFieldset(),
            self::PARAMS_FIELDSET               => self::getParamsFieldset(),
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-image-with-text-settings";
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

    // Další nastavení

    const ADDITIONAL_SETTINGS_FIELDSET          = BlockConfig::FORM_PREFIX . "-image-with-text-additional-settings";
    const ADDITIONAL_SETTINGS_IMAGE_POSITION    = self::ADDITIONAL_SETTINGS_FIELDSET . "-image-position";
    const ADDITIONAL_SETTINGS_IMAGE_SIZE        = self::ADDITIONAL_SETTINGS_FIELDSET . "-image-size";
    const ADDITIONAL_SETTINGS_SECTION_COLOR     = self::ADDITIONAL_SETTINGS_FIELDSET . "-section-color";
    const ADDITIONAL_SETTINGS_TEXT_POSITION     = self::ADDITIONAL_SETTINGS_FIELDSET . "-text-position";

    public static function getAdditionalSettingsFieldset()
    {
        $ImagePositionOptions = [
            "--img-right-side" => __("Obrázek napravo", "PD_ADMIN_DOMAIN"),
            "--img-left-side" => __("Obrázek nalevo", "PD_ADMIN_DOMAIN"),
        ];

        $ImageSizeOptions = [
            "--larger-img" => __("Obrázek uvnitř containeru", "PD_ADMIN_DOMAIN"),
            "--smaller-img" => __("Obrázek přetékající container", "PD_ADMIN_DOMAIN"),
        ];

        $BgColorOptions = [
            "--bg-color-white" => __("Bílé pozadí", "PD_ADMIN_DOMAIN"),
            "--bg-color-section" => __("Šedé pozadí", "PD_ADMIN_DOMAIN"),
            "--bg-color-text" => __("Šedé pozadí pouze pod textem", "PD_ADMIN_DOMAIN"),
        ];

        $TextPositionOptions = [
            "--top-img" => __("Text zarovnán s obrázkem nahoře", "PD_ADMIN_DOMAIN"),
            "--centered-img" => __("Text (i titulek) zarovnán se středem obrázku", "PD_ADMIN_DOMAIN"),
        ];

        $fieldset = new \KT_Form_Fieldset(self::ADDITIONAL_SETTINGS_FIELDSET, __("Další nastavení bloku", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::ADDITIONAL_SETTINGS_FIELDSET);

        $fieldset->addSelect(self::ADDITIONAL_SETTINGS_IMAGE_POSITION, __("Pozice obrázku:", "PD_ADMIN_DOMAIN"))
            ->setOptionsData($ImagePositionOptions);
        $fieldset->addSelect(self::ADDITIONAL_SETTINGS_IMAGE_SIZE, __("Velikost obrázku:", "PD_ADMIN_DOMAIN"))
            ->setOptionsData($ImageSizeOptions);
        $fieldset->addSelect(self::ADDITIONAL_SETTINGS_SECTION_COLOR, __("Barva pozadí:", "PD_ADMIN_DOMAIN"))
            ->setOptionsData($BgColorOptions);
        $fieldset->addSelect(self::ADDITIONAL_SETTINGS_TEXT_POSITION, __("Pozice textu:", "PD_ADMIN_DOMAIN"))
            ->setOptionsData($TextPositionOptions);

        return $fieldset;
    }

    const PARAMS_FIELDSET       = BlockConfig::FORM_PREFIX . "-image-with-text-params";
    const PARAMS_TITLE          = self::PARAMS_FIELDSET . "-title";
    const PARAMS_CONTENT        = self::PARAMS_FIELDSET . "-content";
    const PARAMS_IMAGE_ID       = self::PARAMS_FIELDSET . "-image-id";
    const PARAMS_BUTTON_TEXT    = self::PARAMS_FIELDSET . "-button-text";
    const PARAMS_BUTTON_URL     = self::PARAMS_FIELDSET . "-button-url";

    public static function getParamsFieldset()
    {

        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Parametry", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTrumbowygTextarea(self::PARAMS_CONTENT, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::PARAMS_IMAGE_ID, __("Obrázek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_BUTTON_URL, __("URL tlačítka:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
