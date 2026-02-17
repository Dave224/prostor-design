<?php

use Layouts\Page\PageFactory;

$Page = PageFactory::create();

get_template_part(COMPONENTS_PATH . "HeaderEshop/HeaderEshop");
get_template_part(COMPONENTS_PATH . "Breadcrumbs/Breadcrumbs");
?>

<div class="container">
    <div class="row">
        <section class="eshop-cart-section eshop-cart-step-1 eshop-cart-step-2 col-lg-10 mx-auto">

			<?php if ( empty( is_wc_endpoint_url('order-received') ) ) {
            get_template_part(LAYOUTS_PATH . "PageCart/partials/PageCartNavigation");
			} ?>
			
            <div class="entry-content">
				<?= $Page->getContent(); ?>
			</div>
		</section>
	</div>
</div>

<?php get_template_part(COMPONENTS_PATH . "Footer/Footer"); ?>