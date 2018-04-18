<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( ' | ', true, 'right' ); ?></title>

<script data-main="<?php echo get_bloginfo('template_directory')?>/scripts/main.js" src="<?php echo get_bloginfo('template_directory')?>/scripts/plugins/node_modules/requirejs/require.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
<header id="primary-header" role="banner">
    <div id="header-inner">
        <div class="logo">
            <a href="<?php echo get_permalink('5')?>">
                LOGO HERE
            </a>
        </div> <!-- .logo -->

        <nav id="nav" role="navigation">
            <?php wp_nav_menu('default-menu'); ?>
        </nav>

        <div class="demo-btn">
            Request A Demo
        </div> <!-- .demo-btn -->

    </div> <!-- .header-inner -->
</header>
<div id="container">

    <div id="body-content">
        <div id="barba-wrapper">
            <div class="barba-container">