<?php

use Layouts\Page\PageFactory;
use Components\ThemeSettings\ThemeSettingsFactory;

$Theme = ThemeSettingsFactory::create();
$Page = PageFactory::create();
get_template_part(COMPONENTS_PATH . "Header/Header"); ?>
<?= get_template_part(COMPONENTS_PATH . "Breadcrumbs/Breadcrumbs"); ?>
<?php if (post_password_required()) {
    echo get_the_password_form();
} else { ?>
    <?php if (!$Page->isSettingsAside()) { ?>
        <section class="base-section --p-top-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="entry-content">
                            <h1><?= $Page->getTitle(); ?></h1>
                            <?= $Page->getContent(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } else if ($Page->isSettingsAside()) { ?>
        <div class="container">
            <div class="row content-w-aside">
                <div class="col-lg-7">
                    <div class="entry-content">
                        <h1><?= $Page->getTitle(); ?></h1>
                        <?= $Page->getContent(); ?>
                    </div>
                </div>
                <div class="row col-lg-4">
                    <aside class="aside-main">
                        <?php get_sidebar(); ?>
                    </aside>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<?php get_template_part(COMPONENTS_PATH . "Footer/Footer"); ?>
