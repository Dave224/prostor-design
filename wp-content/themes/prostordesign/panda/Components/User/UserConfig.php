<?php

namespace Components\User;

class UserConfig implements \KT_Configable
{
    const FORM_PREFIX = "panda-user";


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

    // --- parametry ---------------------------

    const PARAMS_FIELDSET = self::FORM_PREFIX . "-params";
    const IMAGE_ID = self::PARAMS_FIELDSET .  "-image-id";

    public static function getParamsFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::PARAMS_FIELDSET, __("Rozšířené parametry", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::PARAMS_FIELDSET);

        wp_enqueue_media(); // a little hack helper

        // $userId = filter_input(INPUT_GET, "user_id", FILTER_SANITIZE_NUMBER_INT);

        $fieldset->addMedia(self::IMAGE_ID, __("Profilový obrázek:", "PD_ADMIN_DOMAIN"));


        return $fieldset;
    }

    public static function getParamsKeys()
    {
        return [
            self::IMAGE_ID => FILTER_SANITIZE_NUMBER_INT,
        ];
    }
}
