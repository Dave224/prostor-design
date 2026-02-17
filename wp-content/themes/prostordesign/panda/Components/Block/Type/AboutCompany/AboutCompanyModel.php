<?php

namespace Components\Block\Type\AboutCompany;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;
use Components\Block\BlockConfig;
use Components\Block\Type\AboutCompany\AboutCompanyConfig;
use Utils\uString;

/**
 * Class AboutCompanyModel
 * @package Components\Block\Type\AboutCompany
 */
class AboutCompanyModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, BlockConfig::FORM_PREFIX);
    }

    public function getPersonImageIdSize($width, $height)
    {
        return Image::getCloudImage($this->getPersonImageId(), $width, $height);
    }

    public function renderPersonImageId()
    {
        $PersonImageId = new ImageCreator($this->getPersonImageId());

        $PersonImageId->setSrc($this->getPersonImageIdSize(112, 112));
        $PersonImageId->addToSrcset($this->getPersonImageIdSize(112, 112), "1x");
        $PersonImageId->addToSrcset($this->getPersonImageIdSize(224, 224), "2x");
        $PersonImageId->setDraggable(false);

        $ImageAlt = get_post_meta($this->getPersonImageId(), '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($this->getPersonImageId());

        if ($ImageAlt) {
            $PersonImageId->setAlt($ImageAlt);
        } else {
            $PersonImageId->setAlt($ImageTitle);
        }

        return $PersonImageId->render();
    }

    public function getParamsImageIdSize($width, $height)
    {
        return Image::getCloudImage($this->getParamsImageId(), $width, $height);
    }

    public function renderParamsImageId()
    {
        $ImageId = new ImageCreator($this->getParamsImageId());

        $ImageId->setSrc($this->getParamsImageIdSize(736, 500));
        $ImageId->addToSrcset($this->getParamsImageIdSize(736, 500), "1x");
        $ImageId->addToSrcset($this->getParamsImageIdSize(1472, 1000), "2x");
        $ImageId->setDraggable(false);

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
        return $this->getMetaValue(AboutCompanyConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(AboutCompanyConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(AboutCompanyConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return uString::renderBreakTagInString($this->getMetaValue(AboutCompanyConfig::PARAMS_TITLE));
    }

    public function getParamsSubtitle(): ?string
    {
        return $this->getMetaValue(AboutCompanyConfig::PARAMS_SUBTITLE);
    }

    public function getParamsContent(): ?string
    {
        return html_entity_decode($this->getMetaValue(AboutCompanyConfig::PARAMS_CONTENT));
    }

    public function getParamsButtonText(): ?string
    {
        return $this->getMetaValue(AboutCompanyConfig::PARAMS_BUTTON_TEXT);
    }

    public function getParamsButtonUrl(): ?string
    {
        return $this->getMetaValue(AboutCompanyConfig::PARAMS_BUTTON_URL);
    }

    public function getParamsImageId(): ?string
    {
        return $this->getMetaValue(AboutCompanyConfig::PARAMS_IMAGE_ID);
    }

    //* --- Person
    //* --- Prefix: person

    public function getPersonName(): ?string
    {
        return $this->getMetaValue(AboutCompanyConfig::PERSON_NAME);
    }

    public function getPersonPosition(): ?string
    {
        return $this->getMetaValue(AboutCompanyConfig::PERSON_POSITION);
    }

    public function getPersonImageId(): ?string
    {
        return $this->getMetaValue(AboutCompanyConfig::PERSON_IMAGE_ID);
    }

    public function getPersonDesc(): ?string
    {
        return $this->getMetaValue(AboutCompanyConfig::PERSON_DESC);
    }

    //* --- Výhody
    //* --- Prefix: benefits

    public function getBenefitsField(): ?array
    {
        return $this->getMetaValue(AboutCompanyConfig::DYNAMIC_BENEFITS_FIELD);
    }

    public function getBenefits(): ?array
    {
        $Benefits = [];
        $Iterator = 0;

        foreach ($this->getBenefitsField() as $Field) {
            $Title = $Field[AboutCompanyConfig::BENEFITS_TITLE];
            $IconId = $Field[AboutCompanyConfig::BENEFITS_ICON];
            $IconMime = get_post_mime_type($IconId);
            $renderedImage = "";
            if (str_contains($IconMime, "svg")) {
                $Image = new ImageCreator($IconId);

                $Image->setSrcWithoutPostfix(Image::getCloudImage($IconId, null, null));
                $Image->setDraggable(false);
                $Image->setClass("about-us-section__advantage-img");

                $ImageAlt = get_post_meta($IconId, '_wp_attachment_image_alt', true);
                $ImageTitle = get_the_title($IconId);

                if ($ImageAlt) {
                    $Image->setAlt($ImageAlt);
                } else {
                    $Image->setAlt($ImageTitle);
                }

                $renderedImage = $Image->render();

                $Benefits["n-" . $Iterator] = [
                    $Title,
                    $renderedImage,
                ];
            } else {
                $Benefits["n-" . $Iterator] = [
                    $Title,
                    $renderedImage,
                ];
            }

            $Iterator++;
        }


        return $Benefits;
    }

    //? --- Settery -------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: params

    public function isParamsTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    public function isParamsSubtitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsSubtitle());
    }

    public function isParamsContent(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsContent());
    }

    public function isParamsButtonText(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonText());
    }

    public function isParamsButtonUrl(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonUrl());
    }

    public function isParamsImageId(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsImageId());
    }

    //* --- Person
    //* --- Prefix: person

    public function isPersonName(): bool
    {
        return Util::issetAndNotEmpty($this->getPersonName());
    }

    public function isPersonPosition(): bool
    {
        return Util::issetAndNotEmpty($this->getPersonPosition());
    }

    public function isPersonImageId(): bool
    {
        return Util::issetAndNotEmpty($this->getPersonImageId());
    }

    public function isPersonDesc(): bool
    {
        return Util::issetAndNotEmpty($this->getPersonDesc());
    }

    //* --- Výhody
    //* --- Prefix: benefits

    public function isBenefitsField(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getBenefitsField());
    }
}
