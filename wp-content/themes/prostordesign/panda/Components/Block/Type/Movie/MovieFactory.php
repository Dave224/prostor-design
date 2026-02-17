<?php

namespace Components\Block\Type\Movie;


/**
 * Class MovieFactory
 * @package Components\Type\Movie
 */
class MovieFactory
{
    public static function create(): MovieModel
    {
        global $post;
        return new MovieModel($post);
    }
}