<?php

namespace Components\Block\Type\Steps;


/**
 * Class StepsFactory
 * @package Components\Type\Steps
 */
class StepsFactory
{
    public static function create(): StepsModel
    {
        global $post;
        return new StepsModel($post);
    }
}
