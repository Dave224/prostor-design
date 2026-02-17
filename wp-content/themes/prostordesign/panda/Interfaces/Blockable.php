<?php

namespace Interfaces;

/**
 * Class Blockable
 * @package Interfaces
 */
interface Blockable
{

    public static function getFieldsets(string $FormPrefix);
    public static function getTitle(): string;
    public static function getTemplateName(): string;
}
