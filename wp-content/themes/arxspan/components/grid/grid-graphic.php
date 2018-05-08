<?php

//GENERAL
$graphicGridLayout = get_sub_field('graphic_grid_layout');

$gridTitle = get_sub_field('grid_title');
$gridSubtitle = get_sub_field('grid_subtitle');
$gridContent = get_sub_field('grid_content');
//$gridExcerpt = advanced_custom_field_excerpt(//add field here);
$gridSecondaryContent = get_sub_field('grid_secondary_content');

$button = get_sub_field('button');
$buttonLabel = $button['button_label'];
$buttonUrl = $button['button_url'];

//ICON GRID
$industryIcons = get_sub_field('industry_icons');


if($graphicGrid){ ?>
    <div class="graphic-grid-wrapper <?php echo $graphicGridLayout; if(! $gridTitle){echo ' no-title';}?>"> <?php

        if($gridTitle || $gridSubtitle || $gridContent || $gridSecondaryContent){ ?>
            <div class="text-container"> <?php
        }

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
            }

        if($gridTitle || $gridSubtitle || $gridContent || $gridSecondaryContent){ ?>
            </div><!-- .text-container --> <?php
        } ?>


        <div class="icons-container"> <?php
            foreach($industryIcons as $icon){ ?>

                <a href="<?php echo get_permalink($icon->ID); ?>">
                    <div class="icon-container">
                        <img src="<?php echo the_field('grid_photo', $icon->ID); ?>"/>

                        <p class="title">
                            <?php echo $icon->post_title; ?>
                        </p>
                </a>

                    <div class="content">
                        <?php echo the_field('grid_description', $icon->ID); ?>
                    </div>
                    <?php
                    //path for clickable
                    ?>
                </div><!-- .icon-container --><?php
            } ?>
        </div><!-- .icons-container -->
        <?php if($buttonLabel){ button($buttonLabel, $buttonUrl); } ?>

    </div> <!-- .graphic-grid-wrapper --><?php
}

?>