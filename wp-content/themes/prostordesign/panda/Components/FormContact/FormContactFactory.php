<?php

namespace Components\FormContact;

class FormContactFactory
{

    private static $FormContactPresenter;

    /** @return FormContactPresenter */
    public static function create($withProcessing = true): FormContactPresenter
    {

        if (isset(self::$FormContactPresenter)) {
            return self::$FormContactPresenter;
        }
        return self::$FormContactPresenter = new FormContactPresenter($withProcessing);
    }
}
