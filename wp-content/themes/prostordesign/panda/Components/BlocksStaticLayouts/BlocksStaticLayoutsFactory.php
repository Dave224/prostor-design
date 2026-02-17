<?php

namespace Components\BlocksStaticLayouts;

class BlocksStaticLayoutsFactory
{
    private static $BlocksStaticLayouts = null;

    /** @return BlocksStaticLayoutsModel */
    public static function create()
    {
        if (isset(self::$BlocksStaticLayouts)) {
            return self::$BlocksStaticLayouts;
        }
        $BlocksStaticLayouts = new BlocksStaticLayoutsModel();
        return self::$BlocksStaticLayouts = $BlocksStaticLayouts;
    }
}