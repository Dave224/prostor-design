<?php

use Components\SchemaGenerator\SchemaGenerator;
use Components\ThemeSettings\ThemeSettingsFactory;

$Theme = ThemeSettingsFactory::create();
$PostCount = wp_count_posts(KT_WP_POST_KEY);
$PageCount = wp_count_posts(KT_WP_PAGE_KEY);

?>

</main>

<footer class="footer-main --animated">

    <div class="container">
        <?php get_template_part(COMPONENTS_PATH . "Footer/partials/FooterTop"); ?>
        <?php get_template_part(COMPONENTS_PATH . "Footer/partials/FooterMap"); ?>
    </div>
</footer>

<?php
get_template_part(COMPONENTS_PATH . "Footer/partials/FooterRecaptcha");
wp_footer();
SchemaGenerator::render(); ?>
</body>

</html>
