<?php

namespace Layouts\TechnologyPage;

/**
 * Class TechnologyPageFactory
 * @package Layouts\TechnologyPage
 */
class TechnologyPageFactory
{
    public static function create(): TechnologyPageModel
    {
        global $post;
        return new TechnologyPageModel($post);
    }
}
