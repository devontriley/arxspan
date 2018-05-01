<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( ' | ', true, 'right' ); ?></title>

<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<link rel="stylesheet" href="https://use.typekit.net/rva7var.css">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">
<header id="primary-header" role="banner">
    <div id="header-inner">
        <div class="logo">
            <a href="<?php echo get_bloginfo('url') ?>">
                <svg viewBox="0 0 224 55">
                    <use xlink:href="#header-logo"></use>
                </svg>
            </a>
        </div>

        <div class="nav-container-container">
            <button id="hamburger">
                <svg width="22" viewbox="0 0 22 22">
                    <use xlink:href="#close"></use>
                </svg>
            </button>

            <div class="nav-container">
                <nav id="main-nav" role="navigation">
                    <?php
                    $menu_items = wp_get_nav_menu_items('Main Menu');
                    foreach( $menu_items as $menu_item ) {
                        if( $menu_item->menu_item_parent == 0 ) {
                            $parent = $menu_item->ID;
                            $menu_array = array();
                            foreach( $menu_items as $submenu ) {
                                if( $submenu->menu_item_parent == $parent ) {
                                    $bool = true;
                                    $menu_array[] = '<li><a href="' . $submenu->url . '">' . $submenu->title . '</a></li>' ."\n";
                                }
                            }
                            if( $bool == true && count( $menu_array ) > 0 ) {
                                $menu_list .= '<li class="dropdown" tabindex="0">' ."\n";
                                $menu_list .= '<span class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true">' . $menu_item->title . '</span>' ."\n"; // n is new line
                                $menu_list .= '<svg class="nav-arrow" viewBox="0 0 16 10">';
                                $menu_list .= '<defs></defs>';
                                $menu_list .= '<g id="Desktop-UI" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">';
                                $menu_list .= '<g id="Homepage" transform="translate(-1170.000000, -51.000000)" fill="#1F6FA4" fill-rule="nonzero">';
                                $menu_list .= '<g id="Group-29" transform="translate(1085.000000, 43.000000)">';
                                $menu_list .= '<path d="M97.8777153,8.38574014 C98.3794195,7.88403591 99.1928428,7.88403591 99.694547,8.38574014 C100.196251,8.88744437 100.196251,9.70086765 99.694547,10.2025719 L92.543062,17.3540569 L85.3766483,10.1934799 C84.8747398,9.69198013 84.8744084,8.87855692 85.3759082,8.37664834 C85.877408,7.87473975 86.6908312,7.87440837 87.1927398,8.37590817 L92.542322,13.7211334 L97.8777153,8.38574014 Z" id="Path-2-Copy"></path>';
                                $menu_list .= '</g>';
                                $menu_list .= '</g>';
                                $menu_list .= '</g>';
                                $menu_list .= '</svg>';
                                $menu_list .= '<ul class="dropdown-menu">' ."\n";
                                $menu_list .= implode( "\n", $menu_array );
                                $menu_list .= '</ul>' ."\n";
                            } else {
                                $menu_list .= '<li>' ."\n";
                                $menu_list .= '<a href="' . $menu_item->url . '">' . $menu_item->title . '</a>' ."\n";
                            }
                        }
                        $menu_list .= '</li>' ."\n";
                    }
                    ?>
                    <ul>
                        <?php echo $menu_list; ?>
                    </ul>
                </nav>

                <div class="demo-btn">
                    <div class="btn-wrapper center">
                        <a href="#" class="btn">Request A Demo</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</header>
<div id="container">

    <div id="body-content">
        <div id="barba-wrapper">
            <div class="barba-container" data-namespace="<?php if(is_front_page()){ echo 'homepage'; }?>"> <!-- put string for each module, comma separated and convert into arrow -->
                <?php include('components/page-backgrounds.php') ?>
                <?php include('inc/master-svg.svg'); ?>
