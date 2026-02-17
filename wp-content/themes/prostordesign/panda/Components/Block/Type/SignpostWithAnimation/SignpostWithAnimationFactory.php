<?php

namespace Components\Block\Type\SignpostWithAnimation;


/**
 * Class SignpostWithAnimationFactory
 * @package Components\Type\SignpostWithAnimation
 */
class SignpostWithAnimationFactory
{
    public static function create(): SignpostWithAnimationModel
    {
        global $post;
        return new SignpostWithAnimationModel($post);
    }
}