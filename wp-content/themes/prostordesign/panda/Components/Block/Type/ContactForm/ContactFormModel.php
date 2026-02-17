<?php

namespace Components\Block\Type\ContactForm;

use Utils\Util;
use Utils\Image;
use Utils\uString;
use Helpers\ImageCreator;
use Components\Block\BlockConfig;
use Components\Block\Type\ContactForm\ContactFormConfig;

/**
 * Class ContactFormModel
 * @package Components\Block\Type\ContactForm
 */
class ContactFormModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, BlockConfig::FORM_PREFIX);
    }

    public function getParamsImageIdSize($width, $height)
    {
        return Image::getCloudImage($this->getParamsImageId(), $width, $height);
    }

    public function renderParamsImageId()
    {
        $ImageId = new ImageCreator($this->getParamsImageId());

        $ImageId->setSrc($this->getParamsImageIdSize(520, 544));
        $ImageId->addToSrcset($this->getParamsImageIdSize(520, 544), "1x");
        $ImageId->addToSrcset($this->getParamsImageIdSize(1040, 1088), "2x");
        $ImageId->setDraggable(false);
        $ImageId->setClass("contact-form-section__img");

        $ImageAlt = get_post_meta($this->getParamsImageId(), '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($this->getParamsImageId());

        if ($ImageAlt) {
            $ImageId->setAlt($ImageAlt);
        } else {
            $ImageId->setAlt($ImageTitle);
        }

        return $ImageId->render();
    }

    //? --- Gettery -------------------------------------------------------------

    //* --- Nastavení bloku
    //* --- Prefix: Settings

    public function getSettingsSpaceTop(): ?bool
    {
        return $this->getMetaValue(ContactFormConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(ContactFormConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(ContactFormConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(ContactFormConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return html_entity_decode($this->getMetaValue(ContactFormConfig::PARAMS_CONTENT));
    }

    public function getParamsPhone(): ?string
    {
        return uString::clearPhoneNumber($this->getMetaValue(ContactFormConfig::PARAMS_PHONE));
    }

    public function getParamsPhoneFancy(): ?string
    {
        return uString::phoneNumberFormat($this->getMetaValue(ContactFormConfig::PARAMS_PHONE));
    }

    public function getParamsEmail(): ?string
    {
        return $this->getMetaValue(ContactFormConfig::PARAMS_EMAIL);
    }

    public function getParamsLinkText(): ?string
    {
        return $this->getMetaValue(ContactFormConfig::PARAMS_LINK_TEXT);
    }

    public function getParamsLinkUrl(): ?string
    {
        return $this->getMetaValue(ContactFormConfig::PARAMS_LINK_URL);
    }

    public function getParamsImageId(): ?string
    {
        return $this->getMetaValue(ContactFormConfig::PARAMS_IMAGE_ID);
    }

    //* --- Formulář
    //* --- Prefix: Form

    public function getFormTitle(): ?string
    {
        return $this->getMetaValue(ContactFormConfig::FORM_TITLE);
    }

    public function getFormDescription(): ?string
    {
        return $this->getMetaValue(ContactFormConfig::FORM_DESCRIPTION);
    }


    //? --- Settery -------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: params

    public function isParamsTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    public function isParamsContent(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsContent());
    }

    public function isParamsPhone(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsPhone());
    }

    public function isParamsEmail(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsEmail());
    }

    public function isParamsLinkText(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsLinkText());
    }

    public function isParamsLinkUrl(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsLinkUrl());
    }

    public function isParamsImageId(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsImageId());
    }

    //* --- Formulář
    //* --- Prefix: Form

    public function isFormTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getFormTitle());
    }

    public function isFormDescription(): bool
    {
        return Util::issetAndNotEmpty($this->getFormDescription());
    }
}
