<?php

use Components\SchemaGenerator\SchemaGenerator;
use Components\ThemeSettings\ThemeSettingsFactory;
use Components\PopUpSettings\PopUpSettingsFactory;

$Theme = ThemeSettingsFactory::create();
$PostCount = wp_count_posts(KT_WP_POST_KEY);
$PageCount = wp_count_posts(KT_WP_PAGE_KEY);
$PopUpSettings = PopUpSettingsFactory::create();
?>

</main>

<footer class="footer-main --animated">

    <div class="container">
        <?php get_template_part(COMPONENTS_PATH . "Footer/partials/FooterTop"); ?>
        <?php get_template_part(COMPONENTS_PATH . "Footer/partials/FooterMap"); ?>
        <?php get_template_part(COMPONENTS_PATH . "Footer/partials/FooterBottom"); ?>

    </div>

</footer>

<?php
get_template_part(COMPONENTS_PATH . "Footer/partials/FooterRecaptcha");
wp_footer();
SchemaGenerator::render();

if ($PopUpSettings->isPopUpButtonShow()) {
    get_template_part(COMPONENTS_PATH . "Footer/partials/FooterPopUp");
}
?>
</body>

</html>
