<?php

namespace Enums;

final class SignpostEnum extends \KT_Enum
{
    const NONE = 0;
    const FOUR = "four";
    const THREE = "three";
    const TWO = "two";

    function __construct($value = null)
    {
        parent::__construct($value  ?: self::NONE);
        $translates = [];

        $translates[self::NONE] = KT_EMPTY_SYMBOL;
        $translates[self::FOUR] = __("Velký + 3 malé", "PD_ADMIN_DOMAIN");
        $translates[self::THREE] = __("3 na řádek", "PD_ADMIN_DOMAIN");
        $translates[self::TWO] = __("2 na řádek", "PD_ADMIN_DOMAIN");

        $this->setTranslates($translates);
    }
}
