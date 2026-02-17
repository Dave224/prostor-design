<?php

namespace Components\PopUpSettings;

class PopUpSettingsFactory
{
    private static $PopUpSettings = null;

    /** @return PopUpSettingsModel */
    public static function create()
    {
        if (isset(self::$PopUpSettings)) {
            return self::$PopUpSettings;
        }
        $PopUpSettings = new PopUpSettingsModel();
        return self::$PopUpSettings = $PopUpSettings;
    }
}