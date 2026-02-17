<?php

use Utils\Image;
use Utils\Svg;

?>

<section class="base-section  error-404-section">
    <div class="container ">

        <header class="base-header -mb-base -center error-404-section__header">
            <h1>
                <?= Svg::renderSvg("404"); ?>
            </h1>
            <h2 class="base-subheading base-header__heading">
                <?php _e("Je nám líto, ale požadovaná adresa na webu neexistuje. Byla buď smazána nebo přesunuta na jinou adresu.", "ELV_DOMAIN"); ?>
            </h2>
            <p>
                <?php _e("Nenašli jste co jste hledali? Pokračujte na úvodní stránku.", "ELV_DOMAIN"); ?>
            </p>
        </header>

        <a class="btn  --primary" href="<?= get_home_url(); ?>">
            <span>
                <?php _e("Úvodní stránka", "ELV_DOMAIN"); ?>
            </span>
        </a>

    </div>
</section>
