<?php

namespace Components\Block\Type\DepartmentContact;

use Components\Block\BlockConfig;
use Components\Person\Person;
use Interfaces\Blockable;
use KT_String_Phone;
use KT_Text_Field;

class DepartmentContactConfig implements Blockable
{

    public static function getTitle(): string
    {
        return __("Kontakt oddělení", "PD_ADMIN_DOMAIN");
    }

    public static function getTemplateName(): string
    {
        return "DepartmentContact";
    }

    public static function getFieldsets($FormPrefix)
    {
        return [
            self::SETTINGS_FIELDSET => self::getSettingsFieldset(),
            self::FIRST_DEPT_FIELDSET => self::getFirstDeptFieldset(),
            self::SECOND_DEPT_FIELDSET => self::getSecondDeptFieldset(),
        ];
    }

    const SETTINGS_FIELDSET = BlockConfig::FORM_PREFIX . "-department-contact-settings";
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

    const FIRST_DEPT_FIELDSET = BlockConfig::FORM_PREFIX . "-department-contact-first-dept";
    const FIRST_DEPT_TITLE = self::FIRST_DEPT_FIELDSET . "-title";
    const FIRST_DEPT_PHONE = self::FIRST_DEPT_FIELDSET . "-phone";
    const FIRST_DEPT_MAIN_EMAIL = self::FIRST_DEPT_FIELDSET . "-main-email";
    const FIRST_DEPT_PERSON_SELECT = self::FIRST_DEPT_FIELDSET . "-person-select";

    public static function getFirstDeptFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FIRST_DEPT_FIELDSET, __("Parametry oddělení 1", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::FIRST_DEPT_FIELDSET);

        $fieldset->addText(self::FIRST_DEPT_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(SELF::FIRST_DEPT_PHONE, __("Telefon:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::FIRST_DEPT_MAIN_EMAIL, __("Hlavní email:", "PD_ADMIN_DOMAIN"))
            ->setInputType(KT_Text_Field::INPUT_EMAIL);
        $fieldset->addMultiSelect(SELF::FIRST_DEPT_PERSON_SELECT, __("Výběr osoby:", "PD_ADMIN_DOMAIN"))
            ->setFirstEmpty()
            ->setDataManager(new \KT_Custom_Post_Data_Manager([
                "post_type" => Person::KEY,
                "post_status" => "publish",
                "posts_per_page" => -1,
                "orderby" => "menu_order",
                "order" => \KT_Repository::ORDER_ASC,
            ]));

        return $fieldset;
    }

    const SECOND_DEPT_FIELDSET = BlockConfig::FORM_PREFIX . "-department-contact-second-dept";
    const SECOND_DEPT_TITLE = self::SECOND_DEPT_FIELDSET . "-title";
    const SECOND_DEPT_PHONE = self::SECOND_DEPT_FIELDSET . "-phone";
    const SECOND_DEPT_MAIN_EMAIL = self::SECOND_DEPT_FIELDSET . "-main-email";
    const SECOND_DEPT_PERSON_SELECT = self::SECOND_DEPT_FIELDSET . "-person-select";

    public static function getSecondDeptFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::SECOND_DEPT_FIELDSET, __("Parametry oddělení 2", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::SECOND_DEPT_FIELDSET);

        $fieldset->addText(self::SECOND_DEPT_TITLE, __("Titulek:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(SELF::SECOND_DEPT_PHONE, __("Telefon:", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::SECOND_DEPT_MAIN_EMAIL, __("Hlavní email:", "PD_ADMIN_DOMAIN"))
            ->setInputType(KT_Text_Field::INPUT_EMAIL);
        $fieldset->addMultiSelect(SELF::SECOND_DEPT_PERSON_SELECT, __("Výběr osoby:", "PD_ADMIN_DOMAIN"))
            ->setFirstEmpty()
            ->setDataManager(new \KT_Custom_Post_Data_Manager([
                "post_type" => Person::KEY,
                "post_status" => "publish",
                "posts_per_page" => -1,
                "orderby" => "menu_order",
                "order" => \KT_Repository::ORDER_ASC,
            ]));

        return $fieldset;
    }
}
