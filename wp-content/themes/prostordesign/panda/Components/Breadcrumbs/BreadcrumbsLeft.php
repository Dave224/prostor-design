<?php if (function_exists("yoast_breadcrumb") && !(is_front_page() || is_404())) : ?>
    <div class="breadcrumbs-container container">
        <div class="breadcrumbs __left-side --col-12">
            <?php yoast_breadcrumb(); ?>
        </div>
    </div>
<?php endif; ?>
