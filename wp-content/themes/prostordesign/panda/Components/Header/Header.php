<?php

use Components\FastContactForm\FastContactFormFactory;
use Utils\Util;
use Components\Form\FormFactory;
use Components\FormContact\FormContactFactory;
use Components\SchemaGenerator\SchemaGenerator;

SchemaGenerator::addSite();

FormContactFactory::create();
FastContactFormFactory::create();
FormFactory::create();
?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<?php get_template_part(COMPONENTS_PATH . "Header/HeaderHead"); ?>

<body <?php body_class(); ?>>

    <?php Util::renderAnalyticsBodyCode(); ?>

    <?php get_template_part(COMPONENTS_PATH . "Header/HeaderMain"); ?>

    <main>
        <?php get_template_part(COMPONENTS_PATH . "ProjectNotices/ProjectNotices"); ?>
