<?php
use Utils\Util;
use Layouts\Block\BlockModel;
use Components\Block\Type\Faqs\FaqsFactory;

$Faqs = FaqsFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
$iterator = 0;
?>

<section class="base-section faqs-section <?= $Faqs->renderSectionSettingsClass(); ?> --bg-<?= $Faqs->getBackground(); ?>">
    <div class="container">

        <?php if ($Faqs->isParamsTitle() || $Faqs->isParamsContent()) { ?>
            <header class="-mb-base">
                <?php if ($Faqs->isParamsTitle()) { ?>
                    <?= $PageBlock->renderHeadline($Faqs->getPostId(), $Faqs->getParamsTitle(), "base-header__heading base-heading"); ?>
                <?php } ?>

                <?php if ($Faqs->isParamsContent()) { ?>
                    <p class="base-header__perex"><?= $Faqs->getParamsContent(); ?></p>
                <?php } ?>
            </header>
        <?php } ?>

        <?php if ($Faqs->isDynamicFaqsField()) { ?>
            <div class="faq">
                <?php foreach ($Faqs->getFaqsCollection() as $Faq) { ?>
                <div class="faq-item <?php if ($iterator == 0) { ?>active<?php } ?>">
                    <?php if (Util::issetAndNotEmpty($Faq[0])) { ?>
                        <button class="faq-question" type="button">
                            <span class="left">
                                <span class="icon">?</span>
                                    <?= $Faq[0]; ?>
                            </span>
                            <span class="arrow" aria-hidden="true">▾</span>
                        </button>
                    <?php } ?>

                    <?php if (Util::issetAndNotEmpty($Faq[1])) { ?>
                        <div class="faq-answer">
                            <div class="faq-answer-inner">
                                <?= $Faq[1]; ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php $iterator++; } ?>
            </div>
        <?php } ?>
    </div>
</section>

<script>
    document.querySelectorAll(".faq-item").forEach((item, idx) => {
        const btn = item.querySelector(".faq-question");
        const isOpen = item.classList.contains("active");
        btn.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });

    document.querySelectorAll(".faq-question").forEach(btn => {
        btn.addEventListener("click", () => {
            const item = btn.closest(".faq-item");
            const isOpen = item.classList.contains("active");

            // zavřít ostatní (pokud chceš jen jeden otevřený)
            document.querySelectorAll(".faq-item").forEach(i => {
                i.classList.remove("active");
                i.querySelector(".faq-question")?.setAttribute("aria-expanded","false");
            });

            // toggle aktuální
            if (!isOpen) {
                item.classList.add("active");
                btn.setAttribute("aria-expanded","true");
            }
        });
    });
</script>