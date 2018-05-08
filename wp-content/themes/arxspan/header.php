<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php wp_title( ' | ', true, 'right' ); ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
    <link rel="stylesheet" href="https://use.typekit.net/rva7var.css">

    <script type="text/javascript">
        window.mobilecheck = function() {
            var check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        };
        window.mobileDetected = window.mobilecheck();
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<script>
    if(mobileDetected) document.body.classList.add('is-mobile');
</script>

<?php include('inc/master-svg.svg'); ?>
<?php include('components/page-backgrounds.php') ?>

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
                    <svg width="30" viewBox="0 0 30 30">
                        <use xlink:href="#hamburger-icon"></use>
                    </svg>

<!--                    <svg width="22" viewBox="0 0 30 21">-->
<!--                        <use xlink:href="#close"></use>-->
<!--                    </svg>-->
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
        <div id="barba-wrapper">
            <div class="barba-container" data-namespace="<?php if(is_front_page()){ echo 'homepage'; }?>"> <!-- put string for each module, comma separated and convert into arrow -->