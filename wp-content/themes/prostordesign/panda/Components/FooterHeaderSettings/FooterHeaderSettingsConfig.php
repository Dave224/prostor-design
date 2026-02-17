<?php

namespace Components\FooterHeaderSettings;

class FooterHeaderSettingsConfig implements \KT_Configable
{
    const FORM_PREFIX = "footer-header-settings";

    // --- fieldsety ---------------------------

    public static function getAllGenericFieldsets()
    {
        return self::getAllNormalFieldsets() + self::getAllSideFieldsets();
    }

    public static function getAllNormalFieldsets()
    {
        return [
            self::MAIN_CONTACT_HEADER_FIELDSET => self::getMainContactFieldset(),
            self::FOOTER_CAREER_FIEDLSET => self::getFooterCareerFieldset(),
            self::FOOTER_MAP_FIELDSET => self::getFooterMapFieldset(),
        ];
    }

    public static function getAllSideFieldsets()
    {
        return [];
    }

    // --- HLAVNÍ KONTAKT :: HEADER ------------------------

    const MAIN_CONTACT_HEADER_FIELDSET = self::FORM_PREFIX . "-main-contact-header";
    const MAIN_CONTACT_HEADER_PHONE = self::MAIN_CONTACT_HEADER_FIELDSET . "-phone";
    const MAIN_CONTACT_HEADER_EMAIL = self::MAIN_CONTACT_HEADER_FIELDSET . "-email";

    public static function getMainContactFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::MAIN_CONTACT_HEADER_FIELDSET, __("Hlavní kontakty v hlavičce", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::MAIN_CONTACT_HEADER_FIELDSET);

        $fieldset->addText(self::MAIN_CONTACT_HEADER_PHONE, __("Telefon", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::MAIN_CONTACT_HEADER_EMAIL, __("E-mail", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- PATIČKA :: KARIÉRA ------------------------

    const FOOTER_CAREER_FIEDLSET = self::FORM_PREFIX . "-footer-career";
    const FOOTER_CAREER_TITLE = self::FOOTER_CAREER_FIEDLSET . "-title";
    const FOOTER_CAREER_DESC = self::FOOTER_CAREER_FIEDLSET . "-desc";
    const FOOTER_CAREER_LINK_TEXT = self::FOOTER_CAREER_FIEDLSET . "-link-text";
    const FOOTER_CAREER_LINK_URL = self::FOOTER_CAREER_FIEDLSET . "-link-url";
    const FOOTER_CAREER_NEW_TAB = self::FOOTER_CAREER_FIEDLSET . "-new-tab";

    public static function getFooterCareerFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FOOTER_CAREER_FIEDLSET, __("Patička :: Kariéra", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::FOOTER_CAREER_FIEDLSET);

        $fieldset->addText(self::FOOTER_CAREER_TITLE, __("Titulek", "PD_ADMIN_DOMAIN"));
        $fieldset->addTrumbowygTextarea(self::FOOTER_CAREER_DESC, __("Popisek", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::FOOTER_CAREER_LINK_TEXT, __("Text odkazu", "PD_ADMIN_DOMAIN"));
        $fieldset->addText(self::FOOTER_CAREER_LINK_URL, __("URL odkazu", "PD_ADMIN_DOMAIN"));
        $fieldset->addSwitch(self::FOOTER_CAREER_NEW_TAB, __("Odkaz v novém okně", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }

    // --- PATIČKA :: MAPA ------------------------

    const FOOTER_MAP_FIELDSET = self::FORM_PREFIX . "-footer-map";
    const FOOTER_MAP_URL = self::FOOTER_MAP_FIELDSET . "-url";

    public static function getFooterMapFieldset()
    {
        $fieldset = new \KT_Form_Fieldset(self::FOOTER_MAP_FIELDSET, __("Patička :: Mapa", "PD_ADMIN_DOMAIN"));
        $fieldset->setPostPrefix(self::FOOTER_MAP_FIELDSET);

        $fieldset->addText(self::FOOTER_MAP_URL, __("URL", "PD_ADMIN_DOMAIN"));

        return $fieldset;
    }
}
