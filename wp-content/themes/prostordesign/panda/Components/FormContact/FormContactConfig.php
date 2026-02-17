<?php

namespace Components\FormContact;

use Components\ThemeSettings\ThemeSettingsFactory;

class FormContactConfig extends \KT_Contact_Form_Base_Config
{
    const FORM_PREFIX = "form";
    const PHONE = "phone";
    const NAME = "name";

    public static function getFieldset($splittedName = false, $exactedPhone = false, $requiredPhone = false)
    {
        $Theme = ThemeSettingsFactory::create();

        $fieldset = parent::getFieldset(false, false, false);
        $fieldset->setPostPrefix(FormContactConfig::FORM_PREFIX);

        if ($Theme->isRecaptchOnAndSet()) {
            $fieldset->removeFieldByName(\KT_Contact_Form_Base_Config::NONCE);
        }

        return $fieldset;
    }
}
