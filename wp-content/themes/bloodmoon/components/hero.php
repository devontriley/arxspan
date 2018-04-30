<?php

// custom field variables - add
$heroHeader = get_sub_field('hero_header');
$heroSubheader = get_sub_field('hero_subheader');
$textAlignment = get_sub_field('text_alignment');
$heroGraphic = get_sub_field('hero_graphic');
$heroGraphicFull = wp_get_attachment_image($heroGraphic, 'full');
$ctaOption = get_sub_field('cta_option');
$button = get_sub_field('button');
$buttonLabel = $button['button_label'];
$buttonUrl = $button['button_url'];
$introCopy = get_sub_field('intro_copy');

?>

<div class="hero <?php echo $textAlignment; if($heroGraphic){ echo ' graphic';}?>">
    <div class="inner">

        <?php if($heroGraphic) echo $heroGraphicFull; ?>

        <div class="text-wrapper <?php echo $textAlignment ?>">

            <?php

            if($heroHeader){ ?>
                <p class="header trigger_fade <?php if($heroSubheader){ echo ' has-subheader';}?>"><?php echo $heroHeader ?></p> <?php
            }

            if($heroSubheader){ ?>
                <p class="subheader"><?php echo $heroSubheader ?></p> <?php
            }

            if($ctaOption){
                button($buttonLabel, $buttonUrl);
            }

            if($introCopy){ ?>
                <div class="copy-container"> <?php
                    if($introCopy) echo $introCopy;?>
                </div><!-- .copy-container --> <?php
             } ?>

        </div> <!-- .text-wrapper -->
    </div> <!-- .inner -->
</div> <!-- .hero -->
