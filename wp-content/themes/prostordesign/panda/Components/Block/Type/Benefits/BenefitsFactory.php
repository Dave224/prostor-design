<?php

namespace Components\Block\Type\Benefits;


/**
 * Class BenefitsFactory
 * @package Components\Type\Benefits
 */
class BenefitsFactory
{
    public static function create(): BenefitsModel
    {
        global $post;
        return new BenefitsModel($post);
    }
}
