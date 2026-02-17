<?php

use Components\ThemeSettings\ThemeSettingsFactory;

$Theme = ThemeSettingsFactory::create();
if (function_exists("yoast_breadcrumb") && !(is_front_page() || is_404())) : ?>
    <div class="breadcrumbs-container container">
        <div class="breadcrumbs <?php if (is_page() && !is_page_template()) { ?>__left-side --col-8<?php } ?> <?php if (is_search()) { ?>__left-side --col-12<?php } ?>  <?php if (is_page_template("pages/page-cart.php")) { ?>__left-side --col-10<?php } ?> <?php if (is_page_template("pages/page-checkout.php")) { ?>__left-side --col-10<?php } ?>">
            <?php yoast_breadcrumb(); ?>
        </div>
    </div>
<?php endif; ?>
