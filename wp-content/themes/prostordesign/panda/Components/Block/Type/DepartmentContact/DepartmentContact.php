<?php

use Layouts\Block\BlockModel;
use Components\Block\Type\DepartmentContact\DepartmentContactFactory;
use Components\PersonQuery\PersonQueryFactory;
use Utils\Image;

$DepartmentContact = DepartmentContactFactory::create();
$PageId = get_queried_object_id();
$PagePost = get_post($PageId);
$PageBlock = new BlockModel($PagePost);

$FirstPersonQuery = PersonQueryFactory::create($DepartmentContact->getFirstDeptPersons());
$SecondPersonQuery = PersonQueryFactory::create($DepartmentContact->getSecondDeptPersons());
?>

<section class="base-section  contact-persons-section <?= $DepartmentContact->renderSectionSettingsClass(); ?>">
    <div class="container ">
        <div class="row">
            <div class="col-lg-6">
                <div class="department-contact">

                    <?php if ($DepartmentContact->isFirstDeptTitle()) { ?>
                        <h3 class="article-heading department-contact__heading">
                            <?= $DepartmentContact->getFirstDeptTitle(); ?>
                        </h3>
                    <?php } ?>

                    <?php if ($DepartmentContact->isFirstDeptPhone() || $DepartmentContact->isFirstDeptEmail()) { ?>
                        <ul class="contacts">

                            <?php if ($DepartmentContact->isFirstDeptPhone()) { ?>
                                <li class="contacts__contact">
                                    <span>
                                        <?php _e("Zavolejte nám:", "PD_ADMIN_DOMAIN"); ?>
                                    </span>
                                    <a class="contacts__link" href="tel:<?= $DepartmentContact->getFirstDeptPhoneClean(); ?>">
                                        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                                        <?= $DepartmentContact->getFirstDeptPhoneFancy(); ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ($DepartmentContact->isFirstDeptEmail()) { ?>
                                <li class="contacts__contact">
                                    <span>
                                        <?php _e("Napište nám:", "PD_ADMIN_DOMAIN"); ?>
                                    </span>
                                    <a class="contacts__link" href="mailto:<?= $DepartmentContact->getFirstDeptEmail(); ?>">
                                        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/mail.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                                        <?= $DepartmentContact->getFirstDeptEmail(); ?>
                                    </a>
                                </li>
                            <?php } ?>

                        </ul>
                    <?php } ?>

                </div>

                <?php if ($FirstPersonQuery->hasPosts()) { ?>
                    <ul class="">
                        <?= $FirstPersonQuery->thePosts(); ?>
                    </ul>
                <?php } ?>

            </div>
            <div class="col-lg-6">
                <div class="department-contact">

                    <?php if ($DepartmentContact->isSecondDeptTitle()) { ?>
                        <h3 class="article-heading department-contact__heading">
                            <?= $DepartmentContact->getSecondDeptTitle(); ?>
                        </h3>
                    <?php } ?>

                    <?php if ($DepartmentContact->isSecondDeptPhone() || $DepartmentContact->isSecondDeptEmail()) { ?>
                        <ul class="contacts">

                            <?php if ($DepartmentContact->isSecondDeptPhone()) { ?>
                                <li class="contacts__contact">
                                    <span>
                                        <?php _e("Zavolejte nám:", "PD_ADMIN_DOMAIN"); ?>
                                    </span>
                                    <a class="contacts__link" href="tel:<?= $DepartmentContact->getSecondDeptPhoneClean(); ?>">
                                        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/phone.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                                        <?= $DepartmentContact->getSecondDeptPhoneFancy(); ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ($DepartmentContact->isSecondDeptEmail()) { ?>
                                <li class="contacts__contact">
                                    <span>
                                        <?php _e("Napište nám:", "PD_ADMIN_DOMAIN"); ?>
                                    </span>
                                    <a class="contacts__link" href="mailto:<?= $DepartmentContact->getSecondDeptEmail(); ?>">
                                        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/mail.svg"); ?>" alt="" aria-hidden="true" draggable="false">
                                        <?= $DepartmentContact->getSecondDeptEmail(); ?>
                                    </a>
                                </li>
                            <?php } ?>

                        </ul>
                    <?php } ?>

                </div>

                <?php if ($SecondPersonQuery->hasPosts()) { ?>
                    <ul class="">
                        <?= $SecondPersonQuery->thePosts(); ?>
                    </ul>
                <?php } ?>

            </div>
            </li>
            </ul>
        </div>
    </div>
    </div>
</section>
