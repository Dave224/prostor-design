<?php

namespace Components\Block\Type\DepartmentContact;

use Components\Block\BlockConfig;
use Utils\uString;
use Utils\Util;

/**
 * Class DepartmentContactModel
 * @package Components\Block\Type\DepartmentContact
 */
class DepartmentContactModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, BlockConfig::FORM_PREFIX);
    }

    //? --- Gettery -------------------------------------------------------------

    //* --- Nastavení bloku
    //* --- Prefix: Settings

    public function getSettingsSpaceTop(): ?bool
    {
        return $this->getMetaValue(DepartmentContactConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(DepartmentContactConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(DepartmentContactConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry oddělení 1
    //* --- Prefix: FirstDept

    public function getFirstDeptTitle(): ?string
    {
        return $this->getMetaValue(DepartmentContactConfig::FIRST_DEPT_TITLE);
    }

    public function getFirstDeptPhone(): ?string
    {
        return $this->getMetaValue(DepartmentContactConfig::FIRST_DEPT_PHONE);
    }

    public function getFirstDeptPhoneClean(): ?string
    {
        return uString::clearPhoneNumber($this->getMetaValue(DepartmentContactConfig::FIRST_DEPT_PHONE));
    }

    public function getFirstDeptPhoneFancy(): ?string
    {
        return uString::phoneNumberFormat($this->getMetaValue(DepartmentContactConfig::FIRST_DEPT_PHONE));
    }

    public function getFirstDeptEmail(): ?string
    {
        return $this->getMetaValue(DepartmentContactConfig::FIRST_DEPT_MAIN_EMAIL);
    }

    public function getFirstDeptPersons(): ?array
    {
        return $this->getMetaValue(DepartmentContactConfig::FIRST_DEPT_PERSON_SELECT);
    }

    //* --- Parametry oddělení 2
    //* --- Prefix: SecondDept

    public function getSecondDeptTitle(): ?string
    {
        return $this->getMetaValue(DepartmentContactConfig::SECOND_DEPT_TITLE);
    }

    public function getSecondDeptPhone(): ?string
    {
        return $this->getMetaValue(DepartmentContactConfig::SECOND_DEPT_PHONE);
    }

    public function getSecondDeptPhoneClean(): ?string
    {
        return uString::clearPhoneNumber($this->getMetaValue(DepartmentContactConfig::SECOND_DEPT_PHONE));
    }

    public function getSecondDeptPhoneFancy(): ?string
    {
        return uString::phoneNumberFormat($this->getMetaValue(DepartmentContactConfig::SECOND_DEPT_PHONE));
    }

    public function getSecondDeptEmail(): ?string
    {
        return $this->getMetaValue(DepartmentContactConfig::SECOND_DEPT_MAIN_EMAIL);
    }

    public function getSecondDeptPersons(): ?array
    {
        return $this->getMetaValue(DepartmentContactConfig::SECOND_DEPT_PERSON_SELECT);
    }


    //? --- Issety -------------------------------------------------------------

    //* --- Parametry oddělení 1
    //* --- Prefix: FirstDept

    public function isFirstDeptTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getFirstDeptTitle());
    }

    public function isFirstDeptPhone(): bool
    {
        return Util::issetAndNotEmpty($this->getFirstDeptPhone());
    }

    public function isFirstDeptEmail(): bool
    {
        return Util::issetAndNotEmpty($this->getFirstDeptEmail());
    }

    public function isFirstDeptPersons(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getFirstDeptPersons());
    }

    //* --- Parametry oddělení 2
    //* --- Prefix: SecondDept

    public function isSecondDeptTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getSecondDeptTitle());
    }

    public function isSecondDeptPhone(): bool
    {
        return Util::issetAndNotEmpty($this->getSecondDeptPhone());
    }

    public function isSecondDeptEmail(): bool
    {
        return Util::issetAndNotEmpty($this->getSecondDeptEmail());
    }

    public function isSecondDeptPersons(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getSecondDeptPersons());
    }
}
