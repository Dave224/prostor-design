<?php


// IconPicker JS and CSS
add_action('admin_enqueue_scripts', 'panda_admin_scripts_callback');

function panda_admin_scripts_callback()
{

    // Vue
    // wp_enqueue_script("VueDevCdn", "https://cdn.jsdelivr.net/npm/vue/dist/vue.js");
    wp_enqueue_script("VueProdCdn", "https://cdn.jsdelivr.net/npm/vue@2.6.11");

    // Trumbowyg
    wp_enqueue_script("TrumbowygJsCdn", "https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/trumbowyg.min.js");

    // Sortable
    wp_enqueue_script("SortableJsCdn", "https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js");
    wp_enqueue_script("SortableVueCdn", "//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js");

    wp_enqueue_style("extraAdminCss", get_template_directory_uri() . "/panda/Admin/Build/extraAdmin.css");
    wp_enqueue_script("extraAdminJs", get_template_directory_uri() . "/panda/Admin/Build/extraAdminBundle.js", null, false, false);

    wp_localize_script('extraAdminJs', 'BriloRestApiUrl ', ["url" => REST_BRILO_URL]);
}

add_action('login_enqueue_scripts', 'panda_login_style_callback');

function panda_login_style_callback()
{
    wp_enqueue_style("extraAdminCss", get_template_directory_uri() . "/panda/Admin/Build/extraAdmin.css");
}

