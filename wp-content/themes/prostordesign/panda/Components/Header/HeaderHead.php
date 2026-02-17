<?php

use Utils\Util; ?>

<head>
    <meta charset="utf-8" />
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><![endif]-->
    <meta name="author" content="Brilo - https://www.brilo.cz" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover" />
    <meta name="format-detection" content="telephone=no" />

    <link rel="preconnect" href=" http://fonts.googleapis.com/" crossorigin="crossorigin">
    <link rel="preconnect" href="https://www.youtube.com">
    <link rel="preconnect" href="https://i.ytimg.com">
    <link rel="preconnect" href="https://i9.ytimg.com">
    <link rel=“preconnect“ href="https://connect.facebook.net/">

    <title><?php wp_title(); ?></title>

    <link href="<?= get_template_directory_uri(); ?>/images/favicon/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
    <link type="image/png" href="<?= get_template_directory_uri(); ?>/images/favicon/favicon-32x32.png" rel="icon" sizes="32x32">
    <link type="image/png" href="<?= get_template_directory_uri(); ?>/images/favicon/favicon-16x16.png" rel="icon" sizes="16x16">
    <?= inc_manifest_link(); ?>
    <link href="<?= get_template_directory_uri(); ?>/images/favicon/safari-pinned-tab.svg" rel="mask-icon" color="#ff4d4d">
    <meta name="msapplication-TileColor" content="#ff4d4d">
    <meta name="msapplication-config" content="<?= get_template_directory_uri(); ?>/images/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <?php Util::renderAnalyticsHeaderCode(); ?>

    <?php wp_head(); ?>

</head>
