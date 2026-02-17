<?php

use Utils\Admin;

// add_action("admin_init", "hide_editor");

function hide_editor()
{

    if (Admin::isPageTemplate("pages/page-blocks.php")) {
        remove_post_type_support("page", "editor");
    }
}
