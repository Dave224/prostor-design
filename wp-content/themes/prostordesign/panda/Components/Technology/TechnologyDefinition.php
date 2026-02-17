<?php


// --- post type ------------------------

use Components\Technology\Technology;

add_action("init", "register_technology_post_type");

function register_technology_post_type()
{
    $labels = [
        "name"                  => __("Technologie", "PD_ADMIN_DOMAIN"),
        "singular_name"         => __("Technologie", "PD_ADMIN_DOMAIN"),
        "menu_name"             => __("Technologie", "PD_ADMIN_DOMAIN"),
        "name_admin_bar"        => __("Technologie", "PD_ADMIN_DOMAIN"),
        "archives"              => __("Archív technologií", "PD_ADMIN_DOMAIN"),
        "attributes"            => __("Atributy", "PD_ADMIN_DOMAIN"),
        "parent_item_colon"     => __("Nadřazené technologie", "PD_ADMIN_DOMAIN"),
        "all_items"             => __("Všechny technologie", "PD_ADMIN_DOMAIN"),
        "add_new_item"          => __("Přidat novou technologii", "PD_ADMIN_DOMAIN"),
        "add_new"               => __("Přidat novou", "PD_ADMIN_DOMAIN"),
        "new_item"              => __("Přidat technologii", "PD_ADMIN_DOMAIN"),
        "edit_item"             => __("Upravit technologii", "PD_ADMIN_DOMAIN"),
        "update_item"           => __("Aktualizovat technologii", "PD_ADMIN_DOMAIN"),
        "view_item"             => __("Zobrazit technologii", "PD_ADMIN_DOMAIN"),
        "view_items"            => __("Zobrazit technologii", "PD_ADMIN_DOMAIN"),
        "search_items"          => __("Hledat technologii", "PD_ADMIN_DOMAIN"),
        "not_found"             => __("Nenalezeno", "PD_ADMIN_DOMAIN"),
        "not_found_in_trash"    => __("Nenalezeno v koši", "PD_ADMIN_DOMAIN"),
        "featured_image"        => __("Obrázek", "PD_ADMIN_DOMAIN"),
        "set_featured_image"    => __("Zvolit obrázek", "PD_ADMIN_DOMAIN"),
        "remove_featured_image" => __("Odstranit obrázek", "PD_ADMIN_DOMAIN"),
        "use_featured_image"    => __("Zvolit obrázek", "PD_ADMIN_DOMAIN"),
        "insert_into_item"      => __("Vložit k technologii", "PD_ADMIN_DOMAIN"),
        "uploaded_to_this_item" => __("Nahrát k technologii", "PD_ADMIN_DOMAIN"),
        "items_list"            => __("Seznam technologií", "PD_ADMIN_DOMAIN"),
        "items_list_navigation" => __("Seznam technologií menu", "PD_ADMIN_DOMAIN"),
        "filter_items_list"     => __("Filtrovat technologie", "PD_ADMIN_DOMAIN"),
    ];
    $args = [
        "label"              => __("Technologie", "PD_ADMIN_DOMAIN"),
        "description"        => __("Entita technologie", "PD_ADMIN_DOMAIN"),
        "labels"             => $labels,
        "public"             => true,
        "publicly_queryable" => true,
        "show_ui"            => true,
        "show_in_menu"       => true,
        'show_in_rest'       => true,
        "capability_type"    => KT_WP_POST_KEY,
        "query_var"          => true,
        "rewrite"            => ["slug" => Technology::SLUG, "with_front" => true],
        "has_archive"        => false,
        "hierarchical"       => false,
        "menu_position"      => 5,
        "menu_icon"          => "dashicons-admin-generic",
        "supports"           => [
            KT_WP_POST_TYPE_SUPPORT_TITLE_KEY,
            KT_WP_POST_TYPE_SUPPORT_EDITOR_KEY,
            KT_WP_POST_TYPE_SUPPORT_EXCERPT_KEY,
            KT_WP_POST_TYPE_SUPPORT_PAGE_ATTRIBUTES_KEY,
            KT_WP_POST_TYPE_SUPPORT_THUMBNAIL_KEY
        ],
    ];
    register_post_type(Technology::KEY, $args);
}
