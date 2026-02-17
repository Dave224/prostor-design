<?php

namespace Components\Block\Type\DepartmentContact;


/**
 * Class DepartmentContactFactory
 * @package Components\Type\DepartmentContact
 */
class DepartmentContactFactory
{
    public static function create(): DepartmentContactModel
    {
        global $post;
        return new DepartmentContactModel($post);
    }
}
