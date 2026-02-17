<?php

use Utils\Util;
use Layouts\Block\BlockModel;
use Components\Block\Type\SignpostServices\SignpostServicesFactory;
use Utils\Image;

$SignpostServices = SignpostServicesFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);

$SlicedArray = array_slice($SignpostServices->getSingpostItemsTwo(), 0, 2)
?>

<?php if ($SignpostServices->isSingpostItemsField()) { ?>
    <ul class="row g-1 posts-section__list">
        <?php foreach ($SlicedArray as $Item) { ?>
            <li class="posts-section__list-item col-sm-12 col-md-6">

                <article class="post-item">
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

            </li>
        <?php } ?>
    </ul>
<?php } ?>
