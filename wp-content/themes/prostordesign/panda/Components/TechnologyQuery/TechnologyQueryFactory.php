<?php

namespace Components\TechnologyQuery;

use Components\Technology\Technology;

/**
 * Class TechnologyQueryFactory
 * @package Components\TechnologyQuery
 */
class TechnologyQueryFactory
{
    public static function create($PostIn = []): TechnologyQuery
    {
        $TechnologyQuery = new TechnologyQuery($PostIn);
        $TechnologyQuery->setTemplate(Technology::TEMPLATE_SLIDER);
        $TechnologyQuery->setPostIn($PostIn);
        $TechnologyQuery->setPostType(Technology::KEY);
        $TechnologyQuery->initArgs();
        $TechnologyQuery->setComponent("Components/Technology/Technology");

        return $TechnologyQuery;
    }

    public static function createPage($PostIn = [], $MaxCount = 4): TechnologyQuery
    {
        $TechnologyQuery = new TechnologyQuery($PostIn);
        $TechnologyQuery->setTemplate(Technology::TEMPLATE_PAGE);
        $TechnologyQuery->setPostIn($PostIn);
        $TechnologyQuery->setMaxCount($MaxCount);
        $TechnologyQuery->setPostType(Technology::KEY);
        $TechnologyQuery->initArgs();
        $TechnologyQuery->setComponent("Components/Technology/Technology");

        return $TechnologyQuery;
    }
}
