<?php

namespace Components\Block\Type\History;

use Components\Block\BlockConfig;
use Utils\uString;
use Utils\Util;

/**
 * Class HistoryModel
 * @package Components\Block\Type\History
 */
class HistoryModel extends \KT_WP_Post_Base_Model
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
        return $this->getMetaValue(HistoryConfig::SETTINGS_SPACE_TOP);
    }

    public function getSettingsSpaceBot(): ?bool
    {
        return $this->getMetaValue(HistoryConfig::SETTINGS_SPACE_BOT);
    }

    public function getSettingsDivider(): ?bool
    {
        return $this->getMetaValue(HistoryConfig::SETTINGS_DIVIDER);
    }

    public function renderSectionSettingsClass(): string
    {
        return Util::getSectionClasses($this->getSettingsSpaceTop(), $this->getSettingsSpaceBot(), $this->getSettingsDivider());
    }

    //* --- Parametry
    //* --- Prefix: Params

    public function getParamsTitle(): ?string
    {
        return $this->getMetaValue(HistoryConfig::PARAMS_TITLE);
    }

    //* --- Časová osa
    //* --- Prefix: Timeline

    public function getTimelineField(): ?array
    {
        return $this->getMetaValue(HistoryConfig::DYNAMIC_TIMELINE_FIELD);
    }

    public function getTimelineCollection(): ?array
    {
        $TimelineItems = [];
        $Iterator = 0;

        foreach ($this->getTimelineField() as $Field) {
            $Year = $Field[HistoryConfig::TIMELINE_YEAR];
            $Title = uString::renderBreakTagInString($Field[HistoryConfig::TIMELINE_TITLE]);
            $Description = $Field[HistoryConfig::TIMELINE_DESCRIPTION];

            $TimelineItems["n-" . $Iterator] = [
                $Year,
                $Title,
                $Description,
            ];

            $Iterator++;
        }


        return $TimelineItems;
    }



    //? --- Issety -------------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: Params

    public function isParamsTitle(): bool
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    //* --- Časová osa
    //* --- Prefix: Timeline

    public function isTimelineField(): bool
    {
        return Util::issetAndNotEmpty($this->getTimelineField());
    }
}
