<?php

namespace Components\Block\Type\Contact;


/**
 * Class ContactFactory
 * @package Components\Type\Contact
 */
class ContactFactory
{
    public static function create(): ContactModel
    {
        global $post;
        return new ContactModel($post);
    }
}
