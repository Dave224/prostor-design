<?php

namespace Utils;

class Page
{

    //? Issets

    public static function isPages()
    {
        return boolval(wp_count_posts(KT_WP_PAGE_KEY));
    }
}
