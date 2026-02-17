<?php

use Layouts\Block\BlockModel;
use Components\Block\Type\ContactForm\ContactFormFactory;
use Utils\Image;

$ContactForm = ContactFormFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);
?>


<section class="base-section  contact-form-section --animated <?= $ContactForm->renderSectionSettingsClass(); ?>" id="kontaktni-formular">
    <div class="container ">
        <div class="row">
            <div class="col-lg-5">

                <?php if ($ContactForm->isParamsTitle() || $ContactForm->isParamsContent()) { ?>
                    <header class="base-header -mb-base">

                        <?php if ($ContactForm->isParamsTitle()) { ?>
                            <?= $PageBlock->renderHeadline($ContactForm->getPostId(), $ContactForm->getParamsTitle(), "base-header__heading base-heading"); ?>
                        <?php } ?>

                        <?php if ($ContactForm->isParamsContent()) { ?>
                            <p class="base-header__perex "><?= $ContactForm->getParamsContent(); ?></p>
                        <?php } ?>

                    </header>
                <?php } ?>

                <div class="contact-form-section__contacts">

                    <?php if ($ContactForm->isParamsPhone() || $ContactForm->isParamsEmail()) { ?>
                        <ul class="contacts">

                            <?php if ($ContactForm->isParamsPhone()) { ?>
                                <li class="contacts__contact">
                                    <span>
                                        <?php _e("Zavolejte nám:", "PD_ADMIN_DOMAIN"); ?>
                                    </span>
                                    <a class="contacts__link" href="tel:<?= $ContactForm->getParamsPhone(); ?>">
                                        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                                        <?= $ContactForm->getParamsPhoneFancy(); ?>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if ($ContactForm->isParamsEmail()) { ?>
                                <li class="contacts__contact">
                                    <span>
                                        <?php _e("Napište nám:", "PD_ADMIN_DOMAIN"); ?>
                                    </span>
                                    <a class="contacts__link" href="mailto:obchod@prostor-design.cz">
                                        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/mail.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                                        <?= $ContactForm->getParamsEmail(); ?>
                                    </a>
                                </li>
                            <?php } ?>

                        </ul>
                    <?php } ?>

                    <?php if ($ContactForm->isParamsLinkText() && $ContactForm->isParamsLinkUrl()) { ?>
                        <a href="<?= $ContactForm->getParamsLinkUrl(); ?>" class="link">
                            <span>
                                <?= $ContactForm->getParamsLinkText(); ?>
                            </span>
                            <img class="link__img--dotts" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-dotts.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                            <img class="link__img--arrow" src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                        </a>
                    <?php } ?>

                </div>

            </div>
            <div class="col-lg-7">

                <div class="contact-form__block">
                    <h3 class="base-subheading">
                        <?php if ($ContactForm->isFormTitle()) { ?>
                            <?= $ContactForm->getFormTitle(); ?>
                        <?php } else { ?>
                            <?php _e("Kontaktní formulář", "PD_ADMIN_DOMAIN"); ?>
                        <?php } ?>
                    </h3>
                    <p class="contact-form__perex">
                        <?php if ($ContactForm->isFormDescription()) { ?>
                            <?= $ContactForm->getFormDescription(); ?>
                        <?php } else { ?>
                            <?php _e("Máte zájem o naše služby? Napište nám a zbytek nechte na nás...", "PD_ADMIN_DOMAIN"); ?>
                        <?php } ?>
                    </p>
                    <?= get_template_part(COMPONENTS_PATH . "FormContact/FormContact"); ?>
                </div>

                <?php if ($ContactForm->isParamsImageId()) { ?>
                    <div class="contact-form-section__img-block">
                        <?= $ContactForm->renderParamsImageId(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    </div>
</section>