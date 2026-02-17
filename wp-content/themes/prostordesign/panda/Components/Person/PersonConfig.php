<?php

namespace Components\Person;

use Interfaces\Configable;
use KT_Text_Field;

/**
 * Class PersonConfig
 * @package Components\Person
 */
class PersonConfig implements Configable
{
    const FORM_PREFIX = Person::KEY;
    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::PARAMS_FIELDSET => self::getParamsFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    public static function getAllDynamicFieldsets(): array
    {
        return [];
    }

    public static function registerMetaboxes()
    {
        registerMetabox(self::class, Person::KEY);
    }

    // --- Parametry ---------------------------

    const PARAMS_FIELDSET = self::FORM_PREFIX . "-params";
    const PARAMS_POSITION = self::PARAMS_FIELDSET . "-position";
    const PARAMS_FIRST_PHONE = self::PARAMS_FIELDSET . "-first-phone";
    const PARAMS_SECOND_PHONE = self::PARAMS_FIELDSET . "-second-phone";
    const PARAMS_EMAIL = self::PARAMS_FIELDSET . "-email";
    const PARAMS_DESC = self::PARAMS_FIELDSET . "-desc";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Parametry", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        $fieldset->addText(self::PARAMS_POSITION, __("Pracovní pozice", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_FIRST_PHONE, __("1. Telefon", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_SECOND_PHONE, __("2. Telefon", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::PARAMS_EMAIL, __("Email", "PD_ADMIN_DOMAIN"))
            ->setInputType(KT_Text_Field::INPUT_EMAIL);
        $fieldset->addTextarea(self::PARAMS_DESC, __("Popisek", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
