<?php

namespace Components\PopUpSettings;

class PopUpSettingsConfig implements \KT_Configable
{
    const FORM_PREFIX = "popup-settings";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::POP_UP_FIELDSET => self::getPopUpFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    // --- Nastavení popup okna ------------------------

    const POP_UP_FIELDSET       = self::FORM_PREFIX . "-popup-fieldset";
    const POP_UP_TITLE          = self::POP_UP_FIELDSET . "-title";
    const POP_UP_DESCRIPTION    = self::POP_UP_FIELDSET . "-description";
    const POP_UP_IMAGE          = self::POP_UP_FIELDSET . "-image";
    const POP_UP_BUTTON_TEXT    = self::POP_UP_FIELDSET . "-button-text";
    const POP_UP_BUTTON_URL     = self::POP_UP_FIELDSET . "-button-url";
    const POP_UP_BUTTON_TARGET  = self::POP_UP_FIELDSET . "-button-target";
    const POP_UP_SHOW           = self::POP_UP_FIELDSET . "-show";

    public static function getPopUpFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::POP_UP_FIELDSET, __("Nastavení popUp okna", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::POP_UP_FIELDSET);

        $fieldset->addText(self::POP_UP_TITLE, __("Titulek", "PD_ADMIN_DOMAIN"));
        $fieldset->addTrumbowygTextarea(self::POP_UP_DESCRIPTION, __("Popisek", "PD_ADMIN_DOMAIN"));
      //  $fieldset->addMedia(self::POP_UP_IMAGE, __("Obrázek", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::POP_UP_BUTTON_TEXT, __("Text tlačítka", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::POP_UP_BUTTON_URL, __("URL tlačítka", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::POP_UP_BUTTON_TARGET, __("Otevřít odkaz tlačítka na nové kartě", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::POP_UP_SHOW, __("Zobrazit popUp", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
