<?php

namespace Components\Block\Type\ContactForm;


/**
 * Class ContactFormFactory
 * @package Components\Type\ContactForm
 */
class ContactFormFactory
{
    public static function create(): ContactFormModel
    {
        global $post;
        return new ContactFormModel($post);
    }
}