<?php

namespace Layouts\FrontPage;

use Utils\Util;
use Utils\Image;
use Utils\uString;
use Helpers\ImageCreator;
use Layouts\Page\PageModel;
use Components\Block\BlockFactory;
use Layouts\FrontPage\FrontPageConfig;

/**
 * Class FrontPageModel
 * @package Layouts\FrontPage
 */
class FrontPageModel extends PageModel
{

    public function __construct(\WP_Post $post)
    {
        parent::__construct($post, FrontPageConfig::FORM_PREFIX);
        $this->setMetaPrefix(FrontPageConfig::FORM_PREFIX);
    }


    public function loopBlocks($BlockExtraId = null)
    {
        foreach ($this->getBlockIdsToArray() as $BlockId) {
            $BlockPath = BlockFactory::getBlockPathById($BlockId);
            if ($BlockPath === "") {
                continue;
            }
            if ($BlockId == "title" || $BlockId == "content") {
                $BlockId = $this->getPostId();
            }

            if (Util::issetAndNotEmpty($BlockExtraId)) {
                $BlockId = $BlockExtraId;
            }
            $Block = get_post($BlockId);
            global $post;
            $post = $Block;
            get_template_part($BlockPath);
        }
    }

    public function renderHeadline($postId, $content = null, $class = "base-heading")
    {
        $headline = "";
        foreach ($this->getBlockIdsToArray() as $index => $BlockId) {
            if ($index == 0 && $BlockId == $postId) {
                $headline = "<h1 class='$class'>$content</h1>";
                return $headline;
            } else {
                $headline = "<h2 class='$class'>$content</h1>";
                return $headline;
            }
        }
        return $headline;
    }



    //* --- getry ------------------------

    public function getBlocksTitlesAndDescriptions()
    {
        $TitlesAndDescriptions = [];
        foreach ($this->getBlockIdsToArray() as $BlockId) {
            $Block = get_post($BlockId);
            $MetaValues = get_post_meta($BlockId);
            if (Util::arrayIssetAndNotEmpty($MetaValues)) {
                $Keys = array_keys($MetaValues);
                foreach ($Keys as $Key) {
                    if (strpos($Key, "-title")) {
                        $TitleKey = $Key;
                        array_push($TitlesAndDescriptions, "<h3>" . $MetaValues[$TitleKey][0] . "</h3>");
                    } else if (strpos($Key, "-description")) {
                        $DescriptionKey = $Key;
                        array_push($TitlesAndDescriptions, html_entity_decode($MetaValues[$DescriptionKey][0] ?? ""));
                    }
                }
            }
        }
        return array_unique($TitlesAndDescriptions);
    }

    public function getBlocksIds()
    {
        $BlocksIds = get_post_meta($this->getPostId(), FrontPageConfig::BLOCK_INPUT);

        return $BlocksIds = reset($BlocksIds);
    }

    public function getBlockIdsToArray()
    {
        return $BlocksIds = explode(",", $this->getBlocksIds());
    }


    //? --- Parametry
    //? --- Prefix: Params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(FrontPageConfig::PARAMS_TITLE);
    }

    public function getParamsDescription(): ?string
    {
        return html_entity_decode($this->getMetaValue(FrontPageConfig::PARAMS_DESCRIPTION) ?? "");
    }

    public function getParamsButtonText(): ?string
    {
        return $this->getMetaValue(FrontPageConfig::PARAMS_BUTTON_TEXT);
    }

    public function getParamsButtonUrl(): ?string
    {
        return $this->getMetaValue(FrontPageConfig::PARAMS_BUTTON_URL);
    }

    public function getParamsButtonTarget(): ?bool
    {
        return $this->getMetaValue(FrontPageConfig::PARAMS_BUTTON_TARGET);
    }

    public function getParamsMobileImageId(): ?int
    {
        return $this->getMetaValue(FrontPageConfig::PARAMS_MOBILE_IMAGE_ID);
    }

    public function getButtonTarget(): ?string
    {
        $attributes = "";

        if ($this->isParamsButtonTarget()) {
            $attributes = 'target = "_blank" rel="nofollow"';
        }
        return $attributes;
    }

    //? --- Slider
    //? --- Prefix: DynamicSlider

    public function getRenderedImageForSlider($ImageId): ?string
    {
        $Image = new ImageCreator($ImageId);
        $Image->setSrcWithoutPostfix(Image::getCloudImage($ImageId, 1200, 574));
        $Image->addSourceBySize(Image::getCloudImage($ImageId, 1200, 574), "(min-width: 991px)");
        $Image->addToSrcset(Image::getCloudImage($ImageId, 1200, 574), "1x");
        $Image->addToSrcset(Image::getCloudImage($ImageId, 2400, 1148), "2x");
        $Image->addSourceBySize(Image::getCloudImage($ImageId, 990, 470), "(min-width: 768px)");
        $Image->addToSrcset(Image::getCloudImage($ImageId, 990, 470), "1x");
        $Image->addToSrcset(Image::getCloudImage($ImageId, 1980, 940), "2x");
        $Image->setDraggable(false);

        $ImageAlt = get_post_meta($ImageId, '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($ImageId);

        if ($ImageAlt) {
            $Image->setAlt($ImageAlt);
        } else {
            $Image->setAlt($ImageTitle);
        }

        return $Image->render("main-intro-section__img");
    }
    public function getRenderedImageForSliderMobile($ImageId, $MobileImageId): ?string
    {
        $Image = new ImageCreator($ImageId);
        $Image->setSrcWithoutPostfix(Image::getCloudImage($ImageId, 1200, 574));
        $Image->addSourceBySize(Image::getCloudImage($ImageId, 1200, 574), "(min-width: 991px)");
        $Image->addToSrcset(Image::getCloudImage($ImageId, 1200, 574), "1x");
        $Image->addToSrcset(Image::getCloudImage($ImageId, 2400, 1148), "2x");
        $Image->addSourceBySize(Image::getCloudImage($ImageId, 990, 470), "(min-width: 768px)");
        $Image->addToSrcset(Image::getCloudImage($ImageId, 990, 470), "1x");
        $Image->addToSrcset(Image::getCloudImage($ImageId, 1980, 940), "2x");
        $Image->addSourceBySize(Image::getCloudImage($MobileImageId, 770, 600), "(min-width: 576px)");
        $Image->addToSrcset(Image::getCloudImage($MobileImageId, 770, 600), "1x");
        $Image->addToSrcset(Image::getCloudImage($MobileImageId, 1540, 1200), "2x");
        $Image->addSourceBySize(Image::getCloudImage($MobileImageId, 575, 440), "(max-width: 575px)");
        $Image->addToSrcset(Image::getCloudImage($MobileImageId, 575, 440), "1x");
        $Image->addToSrcset(Image::getCloudImage($MobileImageId, 1150, 880), "2x");
        $Image->setDraggable(false);

        $ImageAlt = get_post_meta($ImageId, '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($ImageId);

        if ($ImageAlt) {
            $Image->setAlt($ImageAlt);
        } else {
            $Image->setAlt($ImageTitle);
        }

        return $Image->render("main-intro-section__img");
    }

    public function getDynamicSliderCollection(): ?array
    {
        return $this->getMetaValue(FrontPageConfig::DYNAMIC_SLIDER_COLLECTION);
    }

    public function getSliderCollection(): ?array
    {
        $SliderItems = array_slice($this->getDynamicSliderCollection(), 0, 4);
        $ReversedSliderItems = array_reverse($this->getDynamicSliderCollection());
        $ReversedSliderItemsSliced = array_slice($ReversedSliderItems, 1, 4);

        $Slider = [];
        foreach ($SliderItems as $Key => $Item) {
            $ImageId = $Item[FrontPageConfig::SLIDER_IMAGE_ID];

            // Skip if ImageId is not valid
            if (!Util::issetAndNotEmpty($ImageId)) {
                continue;
            }

            if (Util::issetAndNotEmpty($this->getParamsMobileImageId())) {
                $MobileImageId = $this->getParamsMobileImageId();
            }

            if ($Key === 0 && Util::issetAndNotEmpty($MobileImageId)) {
                array_push($Slider, $this->getRenderedImageForSliderMobile($ImageId, $MobileImageId));
            } else {
                array_push($Slider, $this->getRenderedImageForSlider($ImageId));
            }
        }


        foreach ($ReversedSliderItemsSliced as $Item) {
            $ImageId = $Item[FrontPageConfig::SLIDER_IMAGE_ID];

            array_push($Slider, $this->getRenderedImageForSlider($ImageId));
        }

        return $Slider;
    }

    //* --- issety ------------------------

    //? --- Parametry
    //? --- Prefix: Params

    public function isParamsTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    public function isParamsDescription(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsDescription());
    }

    public function isParamsButtonText(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonText());
    }

    public function isParamsButtonUrl(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonUrl());
    }

    public function isParamsButtonTarget(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsButtonTarget());
    }

    //? --- Slider
    //? --- Prefix: DynamicSlider

    public function isDynamicSliderCollection(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getDynamicSliderCollection());
    }


    //* --- Setters ------------------------

}
