<?php

use Layouts\TechnologyPage\TechnologyPageFactory;

$TechnologyPage = TechnologyPageFactory::create();
?>

<div class="popup-form --requestPopup">
    <div class="popup-form__block">
        <div class="contact-form__block">
            <?php get_template_part(COMPONENTS_PATH . "Form/Form"); ?>
        </div>
        <span class="popup-form__cross"></span>
    </div>
</div>
