<?php

namespace Components\PersonQuery;

use Utils\Util;
use Presenters\QueryBase;
use Components\Person\Person;

/**
 * Class PersonQuery
 * @package Components\PersonQuery
 */
class PersonQuery extends QueryBase
{
    private $PostIn;

    public function __construct()
    {
        parent::__construct();
        $this->setPostType(Person::KEY);
        $this->setComponent(Person::class);
    }

    public function setOffset($value)
    {
        $this->Offset = Util::tryGetInt($value);
        return $this;
    }

    /** @return boolean */
    public function isOffset()
    {
        return Util::isIdFormat($this->getOffset());
    }

    // Custom Args for Query
    public function initArgs()
    {
        $Args = [
            "post_type" => $this->getPostType(),
            "post_status" => "publish",
            "posts_per_page" => $this->getMaxCount(),
            "orderby" => "menu_order",
            "order" => \KT_Repository::ORDER_ASC,
        ];

        // except himself
        if (is_single()) {
            $Args["post__not_in"] = [get_the_ID()];
        }

        if ($this->isOffset()) {
            $Args["offset"] = $this->getOffset();
        }

        if ($this->isPostIn()) {
            $Args["post__in"] = $this->getPostIn();
        }

        return $this->setArgs($Args);
    }

    public function getPostIn()
    {
        return $this->PostIn;
    }

    public function setPostIn($PostIn)
    {
        return $this->PostIn = $PostIn;
    }

    public function isPostIn()
    {
        return Util::arrayIssetAndNotEmpty($this->getPostIn());
    }
}
