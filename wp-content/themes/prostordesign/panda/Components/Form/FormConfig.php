<?php

namespace Components\Form;

use Components\TestDates\TestDates;
use Components\TestDates\TestDatesConfig;
use Components\ThemeSettings\ThemeSettingsFactory;

class FormConfig extends \KT_Contact_Form_Base_Config
{
    const FORM_PREFIX = "form";
    const PHONE = "phone";
    const NAME = "name";

    public static function getFieldset($splittedName = false, $exactedPhone = false, $requiredPhone = false)
    {
        $Theme = ThemeSettingsFactory::create();

        $fieldset = parent::getFieldset(false, false, false);
        $fieldset->setPostPrefix(FormConfig::FORM_PREFIX);

        if ($Theme->isRecaptchOnAndSet()) {
            $fieldset->removeFieldByName(\KT_Contact_Form_Base_Config::NONCE);
        }

        return $fieldset;
    }
}
