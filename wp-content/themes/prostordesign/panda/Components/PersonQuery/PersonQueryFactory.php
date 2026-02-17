<?php

namespace Components\PersonQuery;

use Components\Person\Person;

/**
 * Class PersonQueryFactory
 * @package Components\PersonQuery
 */
class PersonQueryFactory
{
    public static function create($PostIn = []): PersonQuery
    {
        $PersonQuery = new PersonQuery($PostIn);
        $PersonQuery->setTemplate(Person::TEMPLATE_CONTACT);
        $PersonQuery->setPostIn($PostIn);
        $PersonQuery->setPostType(Person::KEY);
        $PersonQuery->initArgs();
        $PersonQuery->setComponent("Components/Person/Person");

        return $PersonQuery;
    }

    public static function createSlider($PostIn = []): PersonQuery
    {
        $PersonQuery = new PersonQuery($PostIn);
        $PersonQuery->setTemplate(Person::TEMPLATE_SLIDER);
        $PersonQuery->setPostIn($PostIn);
        $PersonQuery->setPostType(Person::KEY);
        $PersonQuery->initArgs();
        $PersonQuery->setComponent("Components/Person/Person");

        return $PersonQuery;
    }

    public static function createWithoutSlider($PostIn = []): PersonQuery
    {
        $PersonQuery = new PersonQuery($PostIn);
        $PersonQuery->setTemplate(Person::TEMPLATE);
        $PersonQuery->setPostIn($PostIn);
        $PersonQuery->setPostType(Person::KEY);
        $PersonQuery->initArgs();
        $PersonQuery->setComponent("Components/Person/Person");

        return $PersonQuery;
    }

    public static function createCard($PostIn = []): PersonQuery
    {
        $PersonQuery = new PersonQuery($PostIn);
        $PersonQuery->setTemplate(Person::TEMPLATE_CARD);
        $PersonQuery->setPostIn($PostIn);
        $PersonQuery->setPostType(Person::KEY);
        $PersonQuery->initArgs();
        $PersonQuery->setComponent("Components/Person/Person");

        return $PersonQuery;
    }
}
