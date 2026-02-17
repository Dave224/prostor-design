<?php

use Components\Technology\TechnologyFactory;

$Technology = TechnologyFactory::create();
?>

<?php if ($Technology->isTechnickalParamsContent()) { ?>
    <section class="parameters-table-section base-section">
        <div class="container">
            <div class="parameters-table-section__content entry-content">
                <?= $Technology->getTechnickalParamsContentFancy(); ?>
            </div>
        </div>
    </section>
<?php } ?>
