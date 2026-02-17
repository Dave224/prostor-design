<?php

namespace Components\FastContactForm;

use Components\ThemeSettings\ThemeSettingsFactory;

class FastContactFormConfig extends \KT_Contact_Form_Base_Config
{
    const FORM_PREFIX = "fast-contact-form";
    const PHONE = "fast-phone";
    const NAME = "fast-name";

    public static function getFieldset($splittedName = false, $exactedPhone = false, $requiredPhone = false)
    {
        $Theme = ThemeSettingsFactory::create();

        $fieldset = parent::getFieldset(false, false, false);
        $fieldset->setPostPrefix(self::FORM_PREFIX);
        $fieldset->removeFieldByName(\KT_Contact_Form_Base_Config::NAME);
        $fieldset->removeFieldByName(\KT_Contact_Form_Base_Config::EMAIL);
        $fieldset->removeFieldByName(\KT_Contact_Form_Base_Config::PHONE);
        $fieldset->removeFieldByName(\KT_Contact_Form_Base_Config::AGREEMENT);
        $fieldset->removeFieldByName(\KT_Contact_Form_Base_Config::MESSAGE);

        $fieldset->addText(self::NAME, __("Name*:", "KT_CORE_DOMAIN"))
            ->setPlaceholder(__("Name*", "KT_CORE_DOMAIN"))
            ->addAttribute("maxlength", 30)
            ->addRule(\KT_Field_Validator::REQUIRED, __("Name is required", "KT_CORE_DOMAIN"))
            ->addRule(\KT_Field_Validator::MAX_LENGTH, __("The name can be up to 30 characters", "KT_CORE_DOMAIN"), 30);

        $phoneField = $fieldset->addText(self::PHONE, __("Phone:", "KT_CORE_DOMAIN"))
            ->setPlaceholder(__("Phone", "KT_CORE_DOMAIN"))
            ->addAttribute("maxlength", 30)
            ->addRule(\KT_Field_Validator::MAX_LENGTH, __("The phone number can be up to 30 characters", "KT_CORE_DOMAIN"), 30);
        if ($requiredPhone) {
            $phoneField->addRule(\KT_Field_Validator::REQUIRED, __("Phone is required", "KT_CORE_DOMAIN"));
        }
        if ($exactedPhone) {
            $phoneField->addRule(\KT_Field_Validator::REGULAR, __("Invalid phone number", "KT_CORE_DOMAIN"), "^((\+|0)(420|421) ?)?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}$");
        }

        if ($Theme->isRecaptchOnAndSet()) {
            $fieldset->removeFieldByName(\KT_Contact_Form_Base_Config::NONCE);
        }

        return $fieldset;
    }
}
