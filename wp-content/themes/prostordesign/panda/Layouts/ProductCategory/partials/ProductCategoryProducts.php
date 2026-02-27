<?php
use Utils\Util;
use Components\ProductQuery\ProductQueryFactory;
use Components\ThemeSettings\ThemeSettingsFactory;

$Theme = ThemeSettingsFactory::create();
$ProductQuery = ProductQueryFactory::create(9);
$ProductQueryAll = ProductQueryFactory::create(200);
$FiltrationItems = $Theme->getFiltration($ProductQueryAll->getPosts());
?>

<?php if (Util::arrayIssetAndNotEmpty($FiltrationItems)) { ?>
    <section class="base-section product-filtration-section --p-top-0 --p-bottom-0 pd-filter" aria-label="Filtrace produktů">
        <div class="container">
            <?php if ($Theme->isFiltrationHeader()) { ?>
                <header class="base-header -mb-base">
                <?php if ($Theme->isFiltrationTitle()) { ?>
                    <h2 class="base-header__heading base-heading"><?= $Theme->getFiltrationTitle(); ?></h2>
                <?php } ?>
                <?php if ($Theme->isFiltrationDescription()) { ?>
                    <p class="base-header__perex "><?= $Theme->getFiltrationDescription(); ?></p>
                <?php } ?>
                </header>
            <?php } ?>
            <form class="pd-filter__form" id="pdFilterForm">
                <div class="pd-filter__grid">
                    <input type="hidden" id="pdFilterCategory" value="<?= get_queried_object_id(); ?>">
                    <?php foreach ($FiltrationItems as $key => $FiltrationItem) { ?>
                        <div class="pd-filter__field">
                            <label class="pd-filter__label" for="filter_<?= $key; ?>"><?= $key; ?></label>
                            <select class="pd-filter__select" id="filter_<?= $key; ?>" name="<?= $key; ?>">
                                <option value="">Vše</option>
                                <?php foreach ($FiltrationItem as $item) { ?>
                                    <option value="<?= $item; ?>"><?= $item; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>

                    <div class="pd-filter__bar">

                        <div class="pd-filter__actions">
                            <a href="<?= get_term_link(get_queried_object_id(), 'product_cat'); ?>" type="button" class="btn --primary" id="pdFilterReset">
                                Reset filtrů
                            </a>
                        </div>
                    </div>
            </form>
        </div>
    </section>
<?php } ?>

<?php if ($ProductQuery->hasPosts()) { ?>
    <section class="base-section  product-detail-section <?php if (Util::arrayIssetAndNotEmpty($FiltrationItems)) { ?>--p-top-0<?php } ?>">
        <div class="container">
            <ul id="pdResults" class="row g-1 product-detail-section__list">
                <?php $ProductQuery->thePosts(9); ?>
            </ul>
            <?= Util::customBootstrapPaginateLinks(true, null, $ProductQuery->getQuery()); ?>
        </div>
    </section>
<?php } ?>

<!-- Fullscreen loader -->
<div class="pd-loader" id="pdLoader" aria-hidden="true" aria-live="polite">
    <div class="pd-loader__backdrop"></div>
    <div class="pd-loader__panel" role="status" aria-label="Načítání">
        <div class="pd-dots" aria-hidden="true">
            <span></span><span></span><span></span>
        </div>
        <div class="pd-loader__text"></div>
    </div>
</div>
