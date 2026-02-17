<?php

namespace Admin\Components\IconPicker;


class IconPickerPresenter
{
    private $iconsList = "";

    public static function renderIcons()
    {
        if (isset(self::$iconsList)) {
            return self::$iconsList;
        }

        $iconsDir = TEMPLATEPATH . "/images/advantages-ico";
        $iconsList = "";

        if (file_exists($iconsDir)) {
            $icons = array_diff(scandir($iconsDir), array('..', '.'));
            $iconBasepath = get_template_directory_uri() . "/images/advantages-ico/";

            foreach ($icons as $icon) {

                $iconPath = $iconBasepath . $icon;
                $img = "";
                $img .= "<div class=\"icon-preview\" data-icon-name=\"{$icon}\">";
                $img .= "<img src=\"{$iconPath}\" alt=\"icon\" draggable=\"false\" loading=\"lazy\">";
                $img .= "</div>";

                $iconsList .= $img;
            }
        }

        return $iconsList;
    }
}
