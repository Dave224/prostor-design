<?php

namespace Components\Block\Type\Documents;

use Utils\Util;
use Components\Block\BlockConfig;

/**
 * Class DocumentsModel
 * @package Components\Block\Type\Documents
 */
class DocumentsModel extends \KT_WP_Post_Base_Model
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
        return $this->getMetaValue(DocumentsConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(DocumentsConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(DocumentsConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(DocumentsConfig::PARAMS_TITLE);
    }

    public function getParamsContent(): ?string
    {
        return $this->getMetaValue(DocumentsConfig::PARAMS_CONTENT);
    }

    public function getParamsBackground(): ?string
    {
        return $this->getMetaValue(DocumentsConfig::PARAMS_BACKGROUND);
    }

    public function getBackground(): ?string
    {
        if ($this->isParamsBackground()) {
            return "dark";
        } else {
            return "light";
        }
    }

    //* --- Dokumenty
    //* --- Prefix: DynamicItems

    public function getDynamicItemsField(): ?array
    {
        return $this->getMetaValue(DocumentsConfig::ITEMS_DYNAMIC_FIELD);
    }

    public function getItemsCollection(): ?array
    {
        $Documents = [];
        $Iterator = 0;

        foreach ($this->getDynamicItemsField() as $Field) {
            $Title = $Field[DocumentsConfig::ITEMS_TITLE];
            $FileId = $Field[DocumentsConfig::ITEMS_FILE_ID];
            $FileUrl = wp_get_attachment_url($FileId);
            $File = get_attached_file($FileId);
            $FileName = basename($File);
            $FileType = wp_check_filetype($File);
            $FileSize = filesize($File);

            if (!Util::issetAndNotEmpty($Title)) {
                $Title = $FileName;
            }

            $Documents["n-" . $Iterator] = [
                $Title,
                $FileUrl,
                strtoupper($FileType['ext']),
                Util::formatSizeUnits($FileSize),
            ];

            $Iterator++;
        }


        return $Documents;
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

    //* --- Dokumenty
    //* --- Prefix: DynamicItems

    public function isDynamicItemsField(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getDynamicItemsField());
    }
}
