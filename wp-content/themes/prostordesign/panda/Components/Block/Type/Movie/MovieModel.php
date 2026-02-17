<?php

namespace Components\Block\Type\Movie;

use Utils\Util;
use Utils\Image;
use Helpers\ImageCreator;
use Components\Block\BlockConfig;
use Components\Block\Type\Movie\MovieConfig;

/**
 * Class MovieModel
 * @package Components\Block\Type\Movie
 */
class MovieModel extends \KT_WP_Post_Base_Model
{

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, BlockConfig::FORM_PREFIX);
    }

    public function getImageSize($width, $height)
    {
        return Image::getCloudImage($this->getParamsMovieImage(), $width, $height);
    }

    public function renderImage()
    {
        $Image = new ImageCreator($this->getParamsMovieImage());

        $Image->setSrc($this->getImageSize(1408, 697));
        $Image->addToSrcset($this->getImageSize(1408, 697), "1x");
        $Image->addToSrcset($this->getImageSize(2816, 1394), "2x");
        $Image->setDraggable(false);
        $Image->setClass("video-section__placeholder-img");

        $ImageAlt = get_post_meta($this->getParamsMovieImage(), '_wp_attachment_image_alt', true);
        $ImageTitle = get_the_title($this->getParamsMovieImage());

        if ($ImageAlt) {
            $Image->setAlt($ImageAlt);
        } else {
            $Image->setAlt($ImageTitle);
        }

        return $Image->render();
    }

    //? --- Gettery -------------------------------------------------------------

    //* --- Nastavení bloku
    //* --- Prefix: Settings

    public function getSettingsSpaceTop(): ?bool
    {
        return $this->getMetaValue(MovieConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(MovieConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(MovieConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(MovieConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return html_entity_decode($this->getMetaValue(MovieConfig::PARAMS_CONTENT));
    }

    public function getParamsMovieImage(): ?string
    {
        return $this->getMetaValue(MovieConfig::PARAMS_MOVIE_IMAGE_ID);
    }

    public function getParamsMovieUrl(): ?string
    {
        return $this->getMetaValue(MovieConfig::PARAMS_MOVIE_URL);
    }

    public function getMovieSrc(): ?string
    {
        $originalUrl = $this->getParamsMovieUrl();
        $autoplayString = "?autoplay=1";
        $autoplay = "?autoplay";

        if (str_contains($originalUrl, $autoplay)) {
            $Movie =  $originalUrl;
        } else {
            $Movie = $originalUrl . $autoplayString;
        }

        if ($this->isParamsMovieImage()) {
            return 'src="" data-url="' . $Movie . '"';
        } else {
            return 'src="' . $Movie . '"';
        }
    }

    public function getParamsMovieId(): ?string
    {
        return $this->getMetaValue(MovieConfig::PARAMS_MOVIE_ID);
    }

    public function getParamsMovieSrc(): ?string
    {
        if ($this->isParamsMovieImage() && $this->isParamsMovieId()) {
            $Movie = wp_get_attachment_url($this->getMetaValue(MovieConfig::PARAMS_MOVIE_ID));
            return 'src="" data-url="' . $Movie . '"';
        } elseif ($this->isParamsMovieId()) {
            $Movie = wp_get_attachment_url($this->getMetaValue(MovieConfig::PARAMS_MOVIE_ID));

            return 'src="' . $Movie . '"';
        }
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

    public function isParamsMovieImage(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsMovieImage());
    }

    public function isParamsMovieUrl(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsMovieUrl());
    }

    public function isParamsMovieId(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsMovieId());
    }
}
