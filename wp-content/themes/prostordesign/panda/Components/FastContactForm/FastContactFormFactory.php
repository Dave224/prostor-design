<?php

namespace Components\FastContactForm;

class FastContactFormFactory
{

    private static $FormPresenter;

    /** @return FastContactFormPresenter */
    public static function create($withProcessing = true): FastContactFormPresenter
    {

        if (isset(self::$FormPresenter)) {
            return self::$FormPresenter;
        }
        return self::$FormPresenter = new FastContactFormPresenter($withProcessing);
    }
}
