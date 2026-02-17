<?php

use Utils\Svg;
use Utils\Image;
use Components\ThemeSettings\ThemeSettingsFactory;

$Theme = ThemeSettingsFactory::create();
?>

<div class="footer-bottom row">
    <div class="col-lg-7">
        <span class="footer-copy">
            &copy; <?= date("Y"); ?> <?= get_bloginfo('name'); ?>— <?php _e("All rights reserved.", "PD_DOMAIN"); ?></span>
    </div>
    <div class="col-lg-5">
        <?php if ($Theme->isSocials()) { ?>
            <div class="footer-social">
                <?php if ($Theme->isSocialFacebook()) { ?>
                    <a href="<?= $Theme->getSocialFacebook() ?>" target="_blank" rel="nofollow">
                        <?= Svg::renderSvg("facebook"); ?>
                    </a>
                <?php } ?>
                <?php if ($Theme->isSocialInstagram()) { ?>
                    <a href="<?= $Theme->getSocialInstagram() ?>" target="_blank" rel="nofollow">
                        <?= Svg::renderSvg("instagram"); ?>
                    </a>
                <?php } ?>
                <?php if ($Theme->isSocialLinkedin()) { ?>
                    <a href="<?= $Theme->getSocialLinkedin() ?>" target="_blank" rel="nofollow">
                        <?= Svg::renderSvg("linkedin"); ?>
                    </a>
                <?php } ?>
                <?php if ($Theme->isSocialWhatsapp()) { ?>
                    <a href="<?= $Theme->getSocialWhatsapp() ?>" target="_blank" rel="nofollow">
                        <?= Svg::renderSvg("whatsapp"); ?>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>

    </div>
</div>
