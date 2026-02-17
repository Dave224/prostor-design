<?php

use Utils\Util;
use Utils\uString;
use Components\User\UserModel;

// --- media: link & gallery ------------------------

add_filter("media_vieHookw_settings", "panda_media_view_settings_filter");
function panda_media_view_settings_filter($settings)
{
    $settings["galleryDefaults"]["link"] = "file";
    $settings["galleryDefaults"]["columns"] = 4;
    return $settings;
}


// --- Wordpress gallery styles disable

add_filter('use_default_gallery_style', '__return_false');


// --- yoast: disable JSON+LD ------------------------

add_filter("wpseo_json_ld_output", "__return_empty_array", 99);


// --- clear empty <b> strong p a and br from shortcode ------------------------

add_filter('the_content', 'panda_shortcode_empty_paragraph_callback');
function panda_shortcode_empty_paragraph_callback($content)
{

    $array = array(
        '<p>[' => '[',
        ']</p>' => ']',
        '<strong>[' => '[',
        ']</strong>' => ']',
        '<b>[' => '[',
        ']</b>' => ']',
        ']<br />' => ']'
    );
    return strtr($content, $array);
}


// --- Move Yoast Meta Box to bottom ------------------------

add_filter('wpseo_metabox_prio', 'panda_yoasttobottom');
function panda_yoasttobottom()
{
    return 'low';
}


// --- Remove Gutenberg blocks styles ------------------------

add_action('wp_print_styles', 'panda_deregister_styles', 100);
function panda_deregister_styles()
{
    wp_dequeue_style('wp-block-library');
}


// --- Rename Page slug

add_action('init', 'panda_page_slug', 1);
function panda_page_slug()
{
    global $wp_rewrite;
    $wp_rewrite->pagination_base = __("strana", "PD_DOMAIN"); //where new-slug is the slug you want to use
    $wp_rewrite->flush_rules();
}


// --- Breadcrumbs pagination page translate

add_filter("wpseo_breadcrumb_single_link", "panda_rename_page_text", 10, 2);
function panda_rename_page_text($link_output, $link)
{
    if (uString::stringStartsWith($link["text"], "Page")) {
        $link_output = str_replace("Page", __("Strana", "PD_DOMAIN"), $link_output);
    }
    return $link_output;
}


// --- Remove p tag around img tag (usefull?)

add_filter('the_content', 'panda_filter_ptags_on_images');
function panda_filter_ptags_on_images($content)
{
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}


// --- EntryContent - wrap .table-responsive around <table> tag

add_filter('the_content', 'panda_table_wrap');
function panda_table_wrap($content)
{
    return preg_replace_callback('~<table.*?</table>~is', function ($match) {
        return '<div class="table-responsive">' . $match[0] . '</div>';
    }, $content);
}


// Load CDN Fancybox on pages where is gallery
add_action("wp_enqueue_scripts", "fancybox_method_enque_script_callback");
function fancybox_method_enque_script_callback()
{
    if (get_post_gallery() || has_block("gallery") || is_page_template("pages/page-blocks.php")) {
        wp_register_script("fancybox-js", "https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js", "", "", true);
        wp_enqueue_style("fancybox-style", "https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css");
        wp_enqueue_script("fancybox-js");
    }
}


function renderComments($postId, $parentId, &$number)
{
    $quotationMarksLabel = __("Uvozovky", "PD_DOMAIN");
    $quoteLabel = __("Odpovědět", "PD_DOMAIN");
    $comments = get_comments(["post_id" => $postId, "parent" => "$parentId", "orderby" => "date", "order" => get_option("comment_order") ?: KT_Repository::ORDER_ASC]);

    if (\KT::arrayIssetAndNotEmpty($comments)) {
        foreach ($comments as $comment) {
            if (Util::issetAndNotEmpty($comment->user_id)) {
                $User = new UserModel($comment->user_id);
            }
            $commentId = $comment->comment_ID;
            $commentDate = date("j. n. Y", strtotime($comment->comment_date));
            echo "<div id=\"comment-$commentId\" data-number=\"$number\" class=\"comments-item\">";
            echo "<div class=\"comments-item-head\">";
            if (Util::issetAndNotEmpty($comment->user_id)) {
                echo "
                    <div class=\"comment-author-img\">
                        <img src=\"\" data-src=\"{$User->getUserImage()}\" alt=\"{$comment->comment_author}\">
                    </div>";
            }
            echo "<div class=\"coments-item-author-content\">
                        <span class=\"comments-item-author\">{$comment->comment_author}</span>
                        <span class=\"comments-item-date\">$commentDate</span>
                    </div>
                  </div>";
            echo "<div class=\"comments-item-content\">
                        <p>{$comment->comment_content}</p>
                  </div>
                  <div class=\"comments-item-reply\" data-comment-id=\"$commentId\">
                    <span>{$quoteLabel}</span>
                  </div>";
            $number++;
            renderComments($postId, $commentId, $number);
            echo "</div>";
        }
    }
}

add_filter('comment_form_default_fields', 'placeholder_author_email_url_form_fields');

function placeholder_author_email_url_form_fields($fields)
{
    $replace_author = __('Jméno *', "PD_DOMAIN");
    $replace_email = __('E-mail *', "PD_DOMAIN");

    $fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __('Název', "PD_DOMAIN") . '</label> ' .
        '<input id="author" name="author" type="text" placeholder="' . $replace_author . '" value="" size="30" max-length="245" required /></p>';

    $fields['email'] = '<p class="comment-form-email"><label for="email">' . __('Email', "PD_DOMAIN") . '</label> ' .
        '<input id="email" name="email" type="email" placeholder="' . $replace_email . '" value=""
        size="30" maxlength="100" aria-describedby="email-notes" required /></p>';

    return $fields;
}

function placeholder_comment_form_field($fields)
{
    $replace_comment = __('Komentář *', "PD_DOMAIN");

    $fields['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . __('Komentář', "PD_DOMAIN") .
        '</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" placeholder="' . $replace_comment . '" required></textarea></p>';

    return $fields;
}
add_filter('comment_form_defaults', 'placeholder_comment_form_field');

add_filter("login_headerurl", "registerLoginLogoUrlFilterHome");

function registerLoginLogoUrlFilterHome()
{
    return "https://www.brilo.team";
}

// define the robots_txt callback

add_filter('robots_txt', 'filter_robots_txt', 10, 2);


function filter_robots_txt($output, $public)
{
    $output = "User-agent: *
Disallow: /wp-admin/
Allow: /wp-admin/admin-ajax.php

Sitemap: https://www.prostordesign.cz/sitemap_index.xml";
    return $output;
}


function briloGetSecondFall(string $value)
{
    $inflection = new Inflection();
    $inflected = $inflection->inflect($value);

    return $inflected[2];
}

add_action('wp_dashboard_setup', 'themeprefix_remove_dashboard_widget');
/**
 *  Remove Site Health Dashboard Widget
 *
 */
function themeprefix_remove_dashboard_widget()
{
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
}

add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);

function new_loop_shop_per_page($cols)
{
    $cols = 9;
    return $cols;
}

//manifest file
add_action('wp_head', 'inc_manifest_link');

// Creates the link tag
function inc_manifest_link()
{
    echo '<link rel="manifest" href="' . get_template_directory_uri() . '/manifest.json" crossorigin="use-credentials">';
}
