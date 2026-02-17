<?php

use Layouts\Page\PageFactory;

$Page = PageFactory::create();

get_template_part(COMPONENTS_PATH . "HeaderEshop/HeaderEshop");
get_template_part(COMPONENTS_PATH . "Breadcrumbs/Breadcrumbs");

?>

<div class="container">
    <div class="row">
        <section class="eshop-cart-section col-lg-10 mx-auto">

            <?php get_template_part(LAYOUTS_PATH . "PageCart/partials/PageCartNavigation"); ?>

            <div class="entry-content">
                <h1><?= $Page->getTitle(); ?></h1>
                <?= $Page->getContent(); ?>
            </div>
        </section>
    </div>
</div>

<?php get_template_part(COMPONENTS_PATH . "Footer/Footer"); ?>
