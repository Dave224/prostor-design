<?php

namespace Components\Form;

class FormFactory
{

    private static $FormPresenter;

    /** @return FormPresenter */
    public static function create($withProcessing = true): FormPresenter
    {

        if (isset(self::$FormPresenter)) {
            return self::$FormPresenter;
        }
        return self::$FormPresenter = new FormPresenter($withProcessing);
    }
}
