<?php
use Utils\uString;
use Layouts\Block\BlockFactory;

$PageBlock = BlockFactory::create();

?>

<section class="heading-section base-section <?php if (!$PageBlock->hasExcerpt()) { ?>heading-section-has-no-perex<?php } ?>">
    <div class="container">
        <header>
            <?= $PageBlock->renderHeadline("title", uString::wrapWithSpan($PageBlock->getTitle()), "base-heading"); ?>

            <?php if ($PageBlock->hasExcerpt()) { ?>
                <?= $PageBlock->getExcerpt(); ?>
            <?php } ?>
        </header>
    </div>
</section>
