<?php
use Components\PopUpSettings\PopUpSettingsFactory;

$PopUpSettings = PopUpSettingsFactory::create();
?>

<div class="pd-exit" id="pdExit" aria-hidden="true">
    <div class="pd-exit__backdrop" data-pd-close></div>

    <div class="pd-exit__dialog pd-exit__dialog--media" role="dialog" aria-modal="true" aria-labelledby="pdExitTitle">
        <button class="pd-exit__x" type="button" aria-label="Zavřít" data-pd-close>×</button>

        <?php if ($PopUpSettings->isPopUpTitle()) { ?>
            <h2 class="pd-exit__title" id="pdExitTitle"><?= $PopUpSettings->getPopUpTitle(); ?></h2>
        <?php } ?>
        <?php if ($PopUpSettings->isPopUpDescription()) { ?>
            <div class="entry-content">
                <?= $PopUpSettings->getPopUpDescription(); ?>
            </div>
        <?php } ?>

        <?php if ($PopUpSettings->isPopUpButton()) { ?>
            <div class="pd-exit__actions">
                <a class="pd-exit__btn btn --primary" href="<?= $PopUpSettings->getPopUpButtonUrl(); ?>" <?php if ($PopUpSettings->isPopUpButtonTarget()) { ?>target="_blank"<?php } ?>>
                    <?= $PopUpSettings->getPopUpButtonText(); ?>
                </a>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    (() => {
        const KEY = "pd_exit_intent_shown_v1";
        const el = document.getElementById("pdExit");
        if (!el) return;

        let isOpen = false;

        const open = () => {
            if (isOpen) return;
            if (sessionStorage.getItem(KEY) === "1") return;

            sessionStorage.setItem(KEY, "1");
            el.setAttribute("aria-hidden", "false");
            document.documentElement.style.overflow = "hidden";
            isOpen = true;

            // focus na zavírací tlačítko (ať je to přístupné)
            const closeBtn = el.querySelector("[data-pd-close]");
            closeBtn && closeBtn.focus();
        };

        const close = () => {
            if (!isOpen) return;
            el.setAttribute("aria-hidden", "true");
            document.documentElement.style.overflow = "";
            isOpen = false;
        };

        // Zavírání klikem / ESC
        el.addEventListener("click", (e) => {
            if (e.target && e.target.hasAttribute("data-pd-close")) close();
        });

        window.addEventListener("keydown", (e) => {
            if (e.key === "Escape") close();
        });

        // Exit intent: kurzor vyjede nahoře mimo okno (směr k tabům/adresnímu řádku)
        document.addEventListener("mouseout", (e) => {
            // relatedTarget === null bývá, když kurzor opouští document/viewport
            if (e.relatedTarget !== null) return;
            if (e.clientY <= 0) open();
        });

    })();
</script>