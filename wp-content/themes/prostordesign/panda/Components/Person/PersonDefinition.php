<?php


// --- post type ------------------------

use Components\Person\Person;

add_action("init", "register_person_post_type");

function register_person_post_type()
{
    $labels = [
        "name"                  => __("Osoba", "PD_ADMIN_DOMAIN"),
        "singular_name"         => __("Osoba", "PD_ADMIN_DOMAIN"),
        "menu_name"             => __("Osoby", "PD_ADMIN_DOMAIN"),
        "name_admin_bar"        => __("Osoby", "PD_ADMIN_DOMAIN"),
        "archives"              => __("Archív osob", "PD_ADMIN_DOMAIN"),
        "attributes"            => __("Atributy", "PD_ADMIN_DOMAIN"),
        "parent_item_colon"     => __("NadřazenÉ osoby", "PD_ADMIN_DOMAIN"),
        "all_items"             => __("Všechny osoby", "PD_ADMIN_DOMAIN"),
        "add_new_item"          => __("Přidat novou osobu", "PD_ADMIN_DOMAIN"),
        "add_new"               => __("Přidat novou", "PD_ADMIN_DOMAIN"),
        "new_item"              => __("Přidat osobu", "PD_ADMIN_DOMAIN"),
        "edit_item"             => __("Upravit osobu", "PD_ADMIN_DOMAIN"),
        "update_item"           => __("Aktualizovat osobu", "PD_ADMIN_DOMAIN"),
        "view_item"             => __("Zobrazit osoby", "PD_ADMIN_DOMAIN"),
        "view_items"            => __("Zobrazit osoby", "PD_ADMIN_DOMAIN"),
        "search_items"          => __("Hledat osoby", "PD_ADMIN_DOMAIN"),
        "not_found"             => __("Nenalezeno", "PD_ADMIN_DOMAIN"),
        "not_found_in_trash"    => __("Nenalezeno v koši", "PD_ADMIN_DOMAIN"),
        "featured_image"        => __("Obrázek", "PD_ADMIN_DOMAIN"),
        "set_featured_image"    => __("Zvolit obrázek", "PD_ADMIN_DOMAIN"),
        "remove_featured_image" => __("Odstranit obrázek", "PD_ADMIN_DOMAIN"),
        "use_featured_image"    => __("Zvolit obrázek", "PD_ADMIN_DOMAIN"),
        "insert_into_item"      => __("Vložit k osobě", "PD_ADMIN_DOMAIN"),
        "uploaded_to_this_item" => __("Nahrát k osobě", "PD_ADMIN_DOMAIN"),
        "items_list"            => __("Seznam osob", "PD_ADMIN_DOMAIN"),
        "items_list_navigation" => __("Seznam osob menu", "PD_ADMIN_DOMAIN"),
        "filter_items_list"     => __("Filtrovat osoby", "PD_ADMIN_DOMAIN"),
    ];
    $args = [
        "label"              => __("Osoby", "PD_ADMIN_DOMAIN"),
        "description"        => __("Entita osoba", "PD_ADMIN_DOMAIN"),
        "labels"             => $labels,
        "public"             => false,
        "publicly_queryable" => true,
        "show_ui"            => true,
        "show_in_menu"       => true,
        'show_in_rest'       => false,
        "capability_type"    => KT_WP_POST_KEY,
        "query_var"          => true,
        "rewrite"            => ["slug" => Person::KEY, "with_front" => true],
        "has_archive"        => false,
        "hierarchical"       => false,
        "menu_position"      => 6,
        "menu_icon"          => "dashicons-admin-users",
        "supports"           => [
            KT_WP_POST_TYPE_SUPPORT_TITLE_KEY,
            KT_WP_POST_TYPE_SUPPORT_THUMBNAIL_KEY,
            KT_WP_POST_TYPE_SUPPORT_PAGE_ATTRIBUTES_KEY
        ],
    ];
    register_post_type(Person::KEY, $args);
}
