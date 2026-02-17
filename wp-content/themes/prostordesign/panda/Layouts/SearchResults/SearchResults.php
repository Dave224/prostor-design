<?php

use Presenters\QueryBase;


/** @var \WP_Query $wp_query */
global $wp_query;



get_template_part(COMPONENTS_PATH . "Header/Header");
get_template_part(COMPONENTS_PATH . "Breadcrumbs/Breadcrumbs"); ?>

<section class="base-section  search-result-section --p-top-0">
    <div class="container">
        <header>
            <h1 class="base-heading"><?php _e("Výsledky vyhledávání", "PD_DOMAIN"); ?></h1>
        </header>
        <div class="search-form__wrap">

            <?php get_template_part(LAYOUTS_PATH . "SearchResults/partials/SearchResultsForm"); ?>
        </div>

        <?php if (have_posts()) { ?>
            <div class="search-results-listing">
                <?php QueryBase::queryLoops($wp_query, "SearchResult"); ?>
            </div>
            <?= \KT::bootstrapPaginateLinks(true, null, $wp_query); ?>
        <?php } else { ?>
            <div class="search-results-listing">
                <p><?php _e("Nebyly nalezeny žádné výsledky.", "PD_DOMAIN"); ?></p>
            </div>
        <?php } ?>

    </div>
</section>

<?php get_template_part(COMPONENTS_PATH . "Footer/Footer");
