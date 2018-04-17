<?php

//GENERAL
$graphicGridLayout = get_sub_field('graphic_grid_layout');
$iconGrid = get_sub_field('graphic_grid_layout') == 'icon';
$photoGrid = get_sub_field('graphic_grid_layout') == 'photo';

$gridTitle = get_sub_field('grid_title');
$gridSubtitle = get_sub_field('grid_subtitle');
$gridContent = get_sub_field('grid_content');
$gridSecondaryContent = get_sub_field('grid_secondary_content');

//ICON GRID
$industryIcons = get_sub_field('industry_icons');

//PHOTO GRID

if($graphicGrid){ ?>
    <div class="graphic-grid-wrapper <?php echo $graphicGridLayout ?>"> <?php

        //ICON GRID
        if($iconGrid){ ?>
            <div class="text-container"> <?php

                if($gridTitle){ ?>
                    <p class="header">
                        <?php echo $gridTitle; ?>
                    </p><?php
                }

                if($gridSubtitle){ ?>
                    <p class="subtitle">
                        <?php echo $gridSubtitle; ?>
                    </p><?php
                }

                if($gridContent){ ?>
                    <p class="content">
                        <?php echo $gridContent; ?>
                    </p><?php
                }

                if($gridSecondaryContent){ ?>
                    <p class="secondary-content">
                        <?php echo $gridSecondaryContent; ?>
                    </p><?php
                } ?>

            </div><!-- .text-container -->

            <div class="icons-container"> <?php
                foreach($industryIcons as $icon){ ?>
                    <div class="icon-container"> <?php
                        echo $icon->post_title;
                        //echo icon
                        //echo content
                        //path for clickable
                        ?>
                    </div><!-- .icon-container --><?php
                } ?>
            </div><!-- .icons-container -->

            <!-- add button here --><?php
        }

        //PHOTO GRID
        if($photoGrid){

        } ?>

    </div> <!-- .graphic-grid-wrapper --><?php
}

?>