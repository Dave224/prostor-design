<?php

use Components\Block\Block;
use Utils\Admin;

add_action("admin_footer", "iconPickerDynamicModal");

function iconPickerDynamicModal()
{
    if (Admin::isPostType(Block::KEY)) {
        get_template_part("/panda/Admin/Components/IconPickerDynamic/IconPickerDynamicModal");
    }
}
