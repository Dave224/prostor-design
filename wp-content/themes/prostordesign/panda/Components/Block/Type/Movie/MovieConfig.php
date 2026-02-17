<?php

namespace Components\Block\Type\Movie;

use Components\Block\BlockConfig;
use Interfaces\Blockable;
use KT_Text_Field;

class MovieConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Video", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "Movie";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-movie-settings";
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

    const PARAMS_FIELDSET = BlockConfig::FORM_PREFIX . "-movie-params";
    const PARAMS_TITLE = self::PARAMS_FIELDSET . "-title";
    const PARAMS_CONTENT = self::PARAMS_FIELDSET . "-content";
    const PARAMS_MOVIE_IMAGE_ID = self::PARAMS_FIELDSET . "-movie-image-id";
    const PARAMS_MOVIE_URL = self::PARAMS_FIELDSET . "-movie-url";
    const PARAMS_MOVIE_ID = self::PARAMS_FIELDSET . "movie-id";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Základní nastavení", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addTrumbowygTextarea(self::PARAMS_CONTENT, __("Popisek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_MOVIE_URL, __("URL videa:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::PARAMS_MOVIE_IMAGE_ID, __("Zástupný obrázek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addMedia(self::PARAMS_MOVIE_ID, __("Vlastní video:", "PD_ADMIN_DOMAIN"));
        $fieldset->setAfterFieldsetContent("Pokud nebude vyplněn zástupný obrázek, blok s videem nebude fungovat.");

        return $fieldset;
    }
}
