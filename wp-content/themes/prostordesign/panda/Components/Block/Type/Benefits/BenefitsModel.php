<?php

namespace Components\Block\Type\Benefits;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;
use Components\Block\BlockConfig;

/**
 * Class BenefitsModel
 * @package Components\Block\Type\Benefits
 */
class BenefitsModel extends \KT_WP_Post_Base_Model
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
        return $this->getMetaValue(BenefitsConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(BenefitsConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(BenefitsConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(BenefitsConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return $this->getMetaValue(BenefitsConfig::PARAMS_CONTENT);
    }

    public function getParamsBackground(): ?string
    {
        return $this->getMetaValue(BenefitsConfig::PARAMS_BACKGROUND);
    }

    public function getBackground(): ?string
    {
        if ($this->isParamsBackground()) {
            return "dark";
        } else {
            return "light";
        }
    }

    //* --- Výhody
    //* --- Prefix: DynamicBenefits

    public function getDynamicBenefitsField(): ?array
    {
        return $this->getMetaValue(BenefitsConfig::BENEFITS_DYNAMIC_FIELD);
    }

    public function getBenefitsCollection(): ?array
    {
        $Benefits = [];
        $Iterator = 0;

        foreach ($this->getDynamicBenefitsField() as $Field) {
            $Title = $Field[BenefitsConfig::BENEFITS_TITLE];
            $Description = $Field[BenefitsConfig::BENEFITS_DESCRIPTION];
            $ImageId = $Field[BenefitsConfig::BENEFITS_IMAGE_ID];

            $renderedImage = "";
            $Image = new ImageCreator($ImageId);

            $Image->setSrcWithoutPostfix(Image::getCloudImage($ImageId, 56, 56));
            $Image->addToSrcset(Image::getCloudImage($ImageId, 56, 56), "1x");
            $Image->addToSrcset(Image::getCloudImage($ImageId, 112, 112), "2x");
            $Image->setDraggable(false);

            $ImageAlt = get_post_meta($ImageId, '_wp_attachment_image_alt', true);
            $ImageTitle = get_the_title($ImageId);

            if ($ImageAlt) {
                $Image->setAlt($ImageAlt);
            } else {
                $Image->setAlt($ImageTitle);
            }

            $renderedImage = $Image->render();

            $Benefits["n-" . $Iterator] = [
                $Title,
                $renderedImage,
                $Description,
            ];

            $Iterator++;
        }


        return $Benefits;
    }

    //? --- Setter -------------------------------------------------------------

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

    public function isParamsBackground(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsBackground());
    }

    //* --- Výhody
    //* --- Prefix: DynamicBenefits

    public function isDynamicBenefitsField(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getDynamicBenefitsField());
    }
}
