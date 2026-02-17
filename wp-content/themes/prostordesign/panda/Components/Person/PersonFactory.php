<?php

namespace Components\Person;

/**
 * Class PersonFactory
 * @package Components\Person
 */
class PersonFactory
{
    public static function create(): PersonModel
    {
        global $post;
        return new PersonModel($post);
    }

    public static function createById($PersonId): PersonModel
    {
        $Post = get_post($PersonId);
        return new PersonModel($Post);
    }
}