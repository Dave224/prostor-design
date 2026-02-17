<?php

namespace Components\Block\Type\Gallery;

use Components\Block\BlockConfig;
use Interfaces\Blockable;

class GalleryConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Galerie", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "Gallery";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
            self::IMAGES_DYNAMIC_FIELDSET => self::getImagesDynamicFieldset()
        ];
    }

    public static function getAllDynamicFieldsets()
    {
        return [
            self::IMAGES_FIELDSET => self::getImagesFieldset()
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-gallery-settings";
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


    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-gallery-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_CONTENT = self::PARAMS_FIELDSET . "-content";
    const PARAMS_BACKGROUND = self::PARAMS_FIELDSET . "-background";
    const PARAMS_BUTTON_TEXT = self::PARAMS_FIELDSET . "-button-text";
    const PARAMS_BUTTON_URL = self::PARAMS_FIELDSET . "-button-url";
    const PARAMS_BUTTON_TARGET = self::PARAMS_FIELDSET . "-button-target";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTextarea(self::PARAMS_CONTENT, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::PARAMS_BACKGROUND, __("Pozadí:", "PD_ADMIN_DOMAIN"), "Tmavé", "Světlé");
        $fieldset->addText(self::PARAMS_BUTTON_TEXT, __("Text tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_BUTTON_URL, __("URL tlačítka:", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::PARAMS_BUTTON_TARGET, __("Otevřít odkaz do nového okna:", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    const IMAGES_FIELDSET = BlockConfig::FORM_PREFIX . "-gallery-images";
    const IMAGES_IMAGE_ID = self::IMAGES_FIELDSET . "-image-id";

    public static function getImagesFieldset()
    {
        $fieldest = new \KT_Form_Fieldset(self::IMAGES_FIELDSET, __("Obrázky", "PD_ADMIN_DOMAIN"));
        $fieldest->setPostPrefix(self::IMAGES_FIELDSET);

        $fieldest->addMedia(self::IMAGES_IMAGE_ID, __("Obrázek:", "PD_ADMIN_DOMAIN"));

        return $fieldest;
    }

    const IMAGES_DYNAMIC_FIELDSET = BlockConfig::FORM_PREFIX . "-gallery-images-dynamic";
    const IMAGES_DYNAMIC_FIELD = self::IMAGES_DYNAMIC_FIELDSET . "-field";

    public static function getImagesDynamicFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::IMAGES_DYNAMIC_FIELDSET, __("Obrázky", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::IMAGES_DYNAMIC_FIELDSET);

        $fieldset->addFieldset(self::IMAGES_DYNAMIC_FIELD, __("Obrázky", "PD_ADMIN_DOMAIN"), [self::class, self::IMAGES_FIELDSET]);

        return $fieldset;
    }
}
