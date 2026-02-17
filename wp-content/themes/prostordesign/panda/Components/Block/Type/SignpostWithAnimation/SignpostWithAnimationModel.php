<?php

namespace Components\Block\Type\SignpostWithAnimation;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;
use Components\Block\BlockConfig;
use Components\Block\Type\SignpostWithAnimation\SignpostWithAnimationConfig;

/**
 * Class SignpostWithAnimationModel
 * @package Components\Block\Type\SignpostWithAnimation
 */
class SignpostWithAnimationModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, BlockConfig::FORM_PREFIX);
    }

    //? --- Gettery -------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(SignpostWithAnimationConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return html_entity_decode($this->getMetaValue(SignpostWithAnimationConfig::PARAMS_CONTENT));
    }

    public function getParamsButtonText(): ?string
    {
        return $this->getMetaValue(SignpostWithAnimationConfig::PARAMS_BUTTON_TEXT);
    }

    public function getParamsButtonUrl(): ?string
    {
        return $this->getMetaValue(SignpostWithAnimationConfig::PARAMS_BUTTON_URL);
    }

    //* --- Položky
    //* --- Prefix: Items

    public function getDynamicItemsField(): ?array
    {
        return $this->getMetaValue(SignpostWithAnimationConfig::ITEM_DYNAMIC_FIELD);
    }

    public function getItems(): ?array
    {
        $Items = [];
        $Iterator = 0;

        foreach ($this->getDynamicItemsField() as $Field) {

            $ImageId = $Field[SignpostWithAnimationConfig::ITEM_IMAGE_ID];
            $Title = $Field[SignpostWithAnimationConfig::ITEM_TITLE];
            $Description = html_entity_decode($Field[SignpostWithAnimationConfig::ITEM_DESC]);
            $ButtonText = $Field[SignpostWithAnimationConfig::ITEM_BUTTON_TEXT];
            $ButtonUrl = $Field[SignpostWithAnimationConfig::ITEM_BUTTON_URL];

            $Image = new ImageCreator($ImageId);

            $Image->setSrcWithoutPostfix(Image::getCloudImage($ImageId, 384, 528));
            $Image->addToSrcset(Image::getCloudImage($ImageId, 384, 528), "1x");
            $Image->addToSrcset(Image::getCloudImage($ImageId, 768, 1056), "2x");
            $Image->setDraggable(false);

            $Items["n-" . $Iterator] = [
                $Image->render(),
                $Title,
                $Description,
                $ButtonText,
                $ButtonUrl,
            ];
            $Iterator++;
        }


        return $Items;
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

    public function isParamsButtonText(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonText());
    }

    public function isParamsButtonUrl(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonUrl());
    }

    //* --- Položky
    //* --- Prefix: Items

    public function isDynamicItemsField(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getDynamicItemsField());
    }
}
