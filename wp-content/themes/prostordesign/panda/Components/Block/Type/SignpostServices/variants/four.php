<?php

use Utils\Util;
use Layouts\Block\BlockModel;
use Components\Block\Type\SignpostServices\SignpostServicesFactory;
use Utils\Image;

$SignpostServices = SignpostServicesFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
$FirstItem = reset($SignpostServices->getSingpostItemsFour());
$OtherItems = array_slice($SignpostServices->getSingpostItemsFour(), 1);
?>


<?php if ($SignpostServices->isSingpostItemsField()) { ?>
    <ul class="row g-1 posts-section__list-img-left">

        <li class="col-sm-12 col-lg-5 col-xl-6 posts-section__list-left-item">
            <article class="post-item">
                <div class="post-item__wrapper">
                    <a class="post-item__img-placeholder" href="<?= $FirstItem[4]; ?>">
                        <?= $FirstItem[2]; ?>
                    </a>
                    <div class="post-item__content">
                        <a class="post-item__header-link" href="<?= $FirstItem[4]; ?>">
                            <h3 class="post-item__title article-heading">
                                <?= $FirstItem[0]; ?>
                            </h3>
                        </a>
                        <p class="post-item__text">
                            <?= $FirstItem[1]; ?>
                        </p>

                        <div class="post-item__more-info">
                            <a class="btn --primary" href="<?= $FirstItem[4]; ?>">
                                <span>
                                    <?= $FirstItem[3]; ?>
                                </span>
                                <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-right.svg"); ?>" alt="" draggable="false" aria-hidden="true" />
                            </a>
                        </div>

                    </div>
                </div>
            </article>
        </li>

        <li class="posts-section__list-item col-sm-12 col-lg-7 col-xl-6">
            <?php foreach ($OtherItems as $Item) { ?>
                <article class="post-item --img-left">
                    <div class="post-item__wrapper">
                        <a class="post-item__img-placeholder" href="<?= $Item[4]; ?>">
                            <?= $Item[2]; ?>
                        </a>
                        <div class="post-item__content">

                            <a class="post-item__header-link" href="<?= $Item[4]; ?>">
                                <h3 class="post-item__title article-heading">
                                    <?= $Item[0]; ?>
                                </h3>
                            </a>
                            <p class="post-item__text">
                                <?= $Item[1]; ?>
                            </p>

                            <div class="post-item__more-info">

                                <a class="btn --primary" href="<?= $Item[4]; ?>">

                                    <span>
                                        <?= $Item[3]; ?>
                                    </span>
                                    <img class="btn__icon" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-right.svg"); ?>" alt="" draggable="false" aria-hidden="true" />
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </li>

    </ul>
<?php } ?>

</div>
</div>
</section>
