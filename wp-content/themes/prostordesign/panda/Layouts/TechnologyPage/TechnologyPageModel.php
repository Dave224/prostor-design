<?php

namespace Layouts\TechnologyPage;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;
use Layouts\Page\PageModel;
use Components\Block\BlockFactory;
use Layouts\TechnologyPage\TechnologyPageConfig;

/**
 * Class TechnologyPageModel
 * @package Layouts\TechnologyPage
 */
class TechnologyPageModel extends PageModel
{

    public function __construct(\WP_Post $post)
    {
        parent::__construct($post, TechnologyPageConfig::FORM_PREFIX);
        $this->setMetaPrefix(TechnologyPageConfig::FORM_PREFIX);
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

    public function getImageSize($width, $height)
    {
        return Image::getCloudImage($this->getParamsImage(), $width, $height);
    }

    public function renderImage()
    {
        $Image = new ImageCreator($this->getParamsImage());

        $Image->setSrc($this->getImageSize(1408, 697));
        $Image->addToSrcset($this->getImageSize(1408, 697), "1x");
        $Image->addToSrcset($this->getImageSize(2816, 1394), "2x");
        $Image->setDraggable(false);
        $Image->setClass("intro-section__img");

        $ImageAlt = get_post_meta($this->getParamsImage(), '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($this->getParamsImage());

        if ($ImageAlt) {
            $Image->setAlt($ImageAlt);
        } else {
            $Image->setAlt($ImageTitle);
        }

        return $Image->render();
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
                        array_push($TitlesAndDescriptions, html_entity_decode($MetaValues[$DescriptionKey][0]));
                    }
                }
            }
        }
        return array_unique($TitlesAndDescriptions);
    }

    public function getBlocksIds()
    {
        $BlocksIds = get_post_meta($this->getPostId(), TechnologyPageConfig::BLOCK_INPUT);

        return $BlocksIds = reset($BlocksIds);
    }

    public function getBlockIdsToArray()
    {
        return $BlocksIds = explode(",", $this->getBlocksIds());
    }

    //* --- Nastavení intra
    //* --- Prefix: Settings

    public function getSettingsSpaceTop(): ?bool
    {
        return $this->getMetaValue(TechnologyPageConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(TechnologyPageConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(TechnologyPageConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }


    //? --- Parametry
    //? --- Prefix: Params

    public function getParamsImage(): ?string
    {
        return $this->getMetaValue(TechnologyPageConfig::PARAMS_IMAGE);
    }

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(TechnologyPageConfig::PARAMS_TITLE);
    }

    public function getParamsDescription(): ?string
    {
        return html_entity_decode($this->getMetaValue(TechnologyPageConfig::PARAMS_DESCRIPTION));
    }

    public function getParamsButtonText(): ?string
    {
        return $this->getMetaValue(TechnologyPageConfig::PARAMS_BUTTON_TEXT);
    }

    public function getParamsButtonUrl(): ?string
    {
        return $this->getMetaValue(TechnologyPageConfig::PARAMS_BUTTON_URL);
    }

    public function getParamsButtonTarget(): ?bool
    {
        return $this->getMetaValue(TechnologyPageConfig::PARAMS_BUTTON_TARGET);
    }

    public function getButtonTarget(): ?string
    {
        $attributes = "";

        if ($this->isParamsButtonTarget()) {
            $attributes = 'target = "_blank" rel="nofollow"';
        }
        return $attributes;
    }

    //? --- Výběr technologií
    //? --- Prefix: Technology

    public function getTechnologySelect(): ?array
    {
        return $this->getMetaValue(TechnologyPageConfig::TECHNOLOGY_SELECT);
    }

    public function getTechnologyCount(): ?int
    {
        return $this->getMetaValue(TechnologyPageConfig::TECHNOLOGY_COUNT);
    }

    //* --- Formulář
    //* --- Prefix: Form

    public function getFormTitle(): ?string
    {
        return $this->getMetaValue(TechnologyPageConfig::FORM_TITLE);
    }

    public function getFormDesctiption(): ?string
    {
        return $this->getMetaValue(TechnologyPageConfig::FORM_DESC);
    }

    //* --- issety ------------------------


    //? --- Parametry
    //? --- Prefix: Params

    public function isParamsImage(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsImage());
    }

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

    //? --- Výběr technologií
    //? --- Prefix: Technology

    public function isTechnologySelect(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getTechnologySelect());
    }

    public function isTechnologyCount(): bool
    {
        return Util::issetAndNotEmpty($this->getTechnologyCount());
    }

    //* --- Formulář
    //* --- Prefix: Form

    public function isFormTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getFormTitle());
    }

    public function isFormDesctiption(): bool
    {
        return Util::issetAndNotEmpty($this->getFormDesctiption());
    }

    //* --- Setters ------------------------

}
