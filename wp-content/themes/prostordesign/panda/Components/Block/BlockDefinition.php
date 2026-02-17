<?php

use Components\Block\Block;
use Components\Block\BlockConfig;

add_action("init", "register_block_post_type");

function register_block_post_type()
{
    // --- post type ------------------------

    $labels = [
        "name"               => __("Bloky", "PD_ADMIN_DOMAIN"),
        "singular_name"      => __("Blok", "PD_ADMIN_DOMAIN"),
        "add_new"            => __("Přidat blok", "PD_ADMIN_DOMAIN"),
        "add_new_item"       => __("Přidat nový blok", "PD_ADMIN_DOMAIN"),
        "edit_item"          => __("Změnit blok", "PD_ADMIN_DOMAIN"),
        "new_item"           => __("Nový blok", "PD_ADMIN_DOMAIN"),
        "view_item"          => __("Zobrazit blok", "PD_ADMIN_DOMAIN"),
        "all_items"          => __("Všechny bloky", "PD_ADMIN_DOMAIN"),
        "search_items"       => __("Hledat bloky", "PD_ADMIN_DOMAIN"),
        "not_found"          => __("Žádné bloky nenalezeny", "PD_ADMIN_DOMAIN"),
        "not_found_in_trash" => __("Žádné bloky v koši", "PD_ADMIN_DOMAIN"),
        "menu_name"          => __("Bloky", "PD_ADMIN_DOMAIN"),
    ];

    $args = [
        "labels"             => $labels,
        "public"             => false,
        "publicly_queryable" => true,
        "show_ui"            => true,
        "show_in_menu"       => true,
        'show_in_rest'       => true,
        "capability_type"    => KT_WP_POST_KEY,
        "query_var"          => true,
        "rewrite"            => ["slug" => Block::SLUG, "with_front" => false],
        "has_archive"        => false,
        "hierarchical"       => false,
        "menu_position"      => 4,
        "menu_icon"          => "dashicons-cart",
        "supports"           => [
            KT_WP_POST_TYPE_SUPPORT_TITLE_KEY,
            KT_WP_POST_TYPE_SUPPORT_THUMBNAIL_KEY,
            KT_WP_POST_TYPE_SUPPORT_AUTHOR_KEY,
        ],
    ];

    register_post_type(Block::KEY, $args);
}

if (is_admin()){
    //this hook will create a new filter on the admin area for the specified post type
    add_action( 'restrict_manage_posts', function(){
        global $wpdb, $table_prefix;

        $post_type = (isset($_GET['post_type'])) ? $_GET['post_type'] : 'post';

        //only add filter to post type you want
        if ($post_type == Block::KEY){
            //query database to get a list of years for the specific post type:
            $values = array();
            $query_block = $wpdb->get_results("SELECT meta_value from " . $table_prefix . "postmeta
                    where meta_key='block-type-select'
                    order by meta_value");
            $BlockTypes = BlockConfig::getBlockTypes();
            foreach ($query_block as &$data){
                foreach ($BlockTypes as $BlockType => $Name) {
                    if ($BlockType == $data->meta_value) {
                        $values[$Name] = $BlockType;
                    }
                }
            }
            //give a unique name in the select field
            ?><select name="admin_filter_block">
            <option value="">— Všechny bloky —</option>

            <?php
            $current_v = isset($_GET['admin_filter_block'])? $_GET['admin_filter_block'] : '';
            foreach ($values as $label => $value) {
                printf(
                    '<option value="%s"%s>%s</option>',
                    $value,
                    $value == $current_v? ' selected="selected"':'',
                    $label
                );
            }
            ?>
            </select>
            <?php
        }
    });

    //this hook will alter the main query according to the user's selection of the custom filter we created above:
    add_filter( 'parse_query', function($query){
        global $pagenow;
        $post_type = (isset($_GET['post_type'])) ? $_GET['post_type'] : 'post';

        if ($post_type == Block::KEY && $pagenow=='edit.php' && isset($_GET['admin_filter_block']) && !empty($_GET['admin_filter_block'])) {
            // $query->meta_query['question-params-quiz'] = $_GET['admin_filter_quiz'];
            $query->set('meta_key', 'block-type-select');
            $query->set('meta_value', $_GET['admin_filter_block']);

        }
    });

    $extraColumns = new \KT_Admin_Columns(Block::KEY);

    $extraColumns->addColumn(BlockConfig::TYPE_SELECT, [
        KT_Admin_Columns::LABEL_PARAM_KEY => __("Typ bloku", "PD_ADMIN_DOMAIN"),
        KT_Admin_Columns::TYPE_PARAM_KEY => \KT_Admin_Columns::POST_META_TYPE_KEY,
        KT_Admin_Columns::METAKEY_PARAM_KEY => BlockConfig::TYPE_SELECT,
        KT_Admin_Columns::SORTABLE_PARAM_KEY => true,
        KT_Admin_Columns::INDEX_PARAM_KEY => 2,
    ]);
}