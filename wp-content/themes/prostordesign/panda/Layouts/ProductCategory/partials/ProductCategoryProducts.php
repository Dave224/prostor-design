<?php
use Utils\Util;
use Components\ProductQuery\ProductQueryFactory;

$ProductQuery = ProductQueryFactory::create(9);
?>

<?php if ($ProductQuery->hasPosts()) { ?>
    <section class="base-section  product-detail-section">
        <div class="container">
            <ul class="row g-1 product-detail-section__list">
                <?php $ProductQuery->thePosts(9); ?>
            </ul>
            <?= Util::customBootstrapPaginateLinks(true, null, $ProductQuery->getQuery()); ?>
        </div>
    </section>
<?php } ?>