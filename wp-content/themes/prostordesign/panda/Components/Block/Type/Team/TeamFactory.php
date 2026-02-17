<?php

namespace Components\Block\Type\Team;


/**
 * Class TeamFactory
 * @package Components\Type\Team
 */
class TeamFactory
{
    public static function create(): TeamModel
    {
        global $post;
        return new TeamModel($post);
    }
}
