<?php

use Components\ThemeSettings\ThemeSettingsFactory;

$Theme = ThemeSettingsFactory::create();
$config = new KT_WP_Configurator();

$config->setDisplayLogo()
    ->setPostArchiveMenu()
    ->setAllowCookieStatement()
    ->setAllowSession(false);

$config->addThemeSupport(KT_WP_THEME_SUPPORT_POST_THUMBNAILS_KEY);

$config->addPostTypeSupport(KT_WP_POST_TYPE_SUPPORT_EXCERPT_KEY, [KT_WP_PAGE_KEY]);

$config->setExcerptText("...");

$config->pageRemover()
    ->removeComments()
    ->removeSubPage("edit.php", "edit-tags.php")
    ->removeSubPage("edit.php", "edit-tags.php?taxonomy=post_tag")
    ->removeSubPage("themes.php", "theme-editor.php");

$config->metaboxRemover()
    ->removeMetabox("tagsdiv-news-type", KT_WP_POST_KEY, "normal")
    ->removeRevisionsMetabox();


$config->setImagesLazyLoading(true)
    ->setImagesLinkClasses(true);

// --- styly ---------------------------

$config->assetsConfigurator()
    ->addStyle("google-font", "https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;700&display=swap")
    ->setEnqueue();

$config->assetsConfigurator()
    ->addStyle("theme-style", get_template_directory_uri() . "/style.css")
    ->setVersion(20231101)
    ->setEnqueue();

$config->assetsConfigurator()
    ->addStyle("custom-added-style", get_template_directory_uri() . "/panda/Css/custom-style.css")
    ->setVersion(2026021702)
    ->setEnqueue();

// --- scripty ------------------------------

$config->assetsConfigurator()
    ->addScript("cdn-jquery", "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js")
    ->setInFooter(true)
    ->setEnqueue();

$config->assetsConfigurator()
    ->addScript("theme-functions-script", get_template_directory_uri() . "/index.js")
    ->addLocalizationData("myAjax", ["ajaxurl" => admin_url("admin-ajax.php")])
    ->setInFooter(true)
    ->setVersion("2025-26-06")
    ->setEnqueue();

$config->assetsConfigurator()
    ->addScript("product-main-script", PANDA_MAIN_JS_URL . "/main.js")
    ->setVersion("20260205")
    ->setInFooter(true)
    ->setEnqueue();

$config->assetsConfigurator()
    ->addScript("js-honey-script", get_template_directory_uri() . "/panda/Js/honey.js")
    ->setInFooter(true)
    ->setEnqueue();
// --- menu ---------------------------

$config->addWpMenu(NAVIGATION_MAIN_MENU, __("Menu v hlavičce", "PD_DOMAIN"));
$config->addWpMenu(NAVIGATION_FOOTER_MENU, __("Menu v patičce", "PD_DOMAIN"));

// --- sidebars ------------------------------
$config->addSidebar(SIDEBAR_MAIN)
    ->setName(__("Hlavní sidebar", "PD_ADMIN_DOMAIN"))
    ->setDescription(__("Hlavní sidebar", "PD_ADMIN_DOMAIN"))
    ->setBeforeWidget('<div id="%1$s" class="widget %2$s">')
    ->setAfterWidget("</div>");

// --- dashboard ------------------------------

$config->metaboxRemover()->clearWordpressDashboard(true)
    ->removeDashboardMetabox("icl_dashboard_widget")
    ->removeDashboardMetabox("wpseo-dashboard-overview");

// --- widgety ------------------------------

$config->widgetRemover()
    ->removeCalendarWidget()
    ->removeArchivesWidget()
    ->removeLinksWidget()
    ->removeMetaWidget()
    ->removeRecentPostsWidget()
    ->removeRecentCommentsWidget()
    ->removeRssWidget()
    ->removeMediaAudioWidget()
    ->removeMediaVideoWidget()
    ->removeMediaGalleryWidget()
    //->removeAllSystemWidgets(true, true, true)
    ->removeWidget("bcn_widget");

// --- head ------------------------------

$config->headRemover()->removeRecommendSystemHeads();

// --- Stránka s theme options ------------------------------

$config->setThemeSettingsPage();

// --- aktivace dynamickych fieldsetu ------------------------------

$config->setEnableDynamicFieldsets();


// --- incializace ------------------------------

$config->initialize();

KT_Termmeta::activate();

// --- Podstránka Nastavení Popupu

$popUpSubpage = new \KT_Custom_Metaboxes_Subpage("themes.php", __("Nastavení PopUp okna", "KT_CORE_DOMAIN"), __("Nastavení PopUp okna", "KT_CORE_DOMAIN"), "update_core", POPUP_SETTINGS_PAGE);
$popUpSubpage->setRenderSaveButton()->register();

// --- Podstránka Nastavení hlavičky a patičky

$headerFooterSubpage = new \KT_Custom_Metaboxes_Subpage("themes.php", __("Hlavička a patička", "KT_CORE_DOMAIN"), __("Hlavička a patička", "KT_CORE_DOMAIN"), "update_core", FOOTER_HEADER_SETTINGS_PAGE);
$headerFooterSubpage->setRenderSaveButton()->register();

// --- Podstránka Nastavení bloků pro statické stránky
$staticPagesBlockSubpage = new \KT_Custom_Metaboxes_Subpage("themes.php", __("Bloky pro statické stránky", "KT_CORE_DOMAIN"), __("Bloky pro statické stránky", "KT_CORE_DOMAIN"), "update_core", BLOCK_STATIC_LAYOUTS_PAGE);
$staticPagesBlockSubpage->setRenderSaveButton()->register();
