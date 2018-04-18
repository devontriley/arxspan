<?php

if(have_rows('components')) :
    while(have_rows('components')) :
        the_row();

        switch(get_row_layout()){
            case 'hero':
            include('hero.php');
            break;

            case 'tab_module':
            include('tab-module.php');
            break;

            case 'grid':
            include('grid/grid.php');
            break;

            case 'cta_banner':
            include('cta-banner.php');
            break;
        }
    endwhile;
endif;

?>