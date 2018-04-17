<?php

// custom field variables - add
$heroHeader = get_sub_field('hero_header');
$heroSubheader = get_sub_field('hero_subheader');
$textAlignment = get_sub_field('text_alignment');
$heroGraphic = get_sub_field('hero_graphic');
$heroGraphicFull = wp_get_attachment_image($heroGraphic, 'full');
$ctaOption = get_sub_field('cta_option');
$ctaText = get_sub_field('cta_text');
$ctaPath = get_sub_field('cta_path');
$introCopy = get_sub_field('intro_copy');
$secondaryIntroCopy = get_sub_field('secondary_intro_copy');

?>

<div class="hero <?php echo $textAlignment; if($heroGraphic){ echo ' graphic'; }?>">
    <div class="inner">

        <?php if($heroGraphic) echo $heroGraphicFull; ?>

        <div class="text-wrapper">

            <?php

            if($heroHeader){ ?>
                <p class="header"><?php echo $heroHeader ?></p> <?php
            }

            if($heroSubheader){ ?>
                <p class="subheader"><?php echo $heroSubheader ?></p> <?php
            }

            if($ctaOption){ ?>
                <div class="button-container">
                    <a class="btn" href="<?php echo get_permalink($ctaPath) ?>">
                        <?php echo $ctaText ?>
                    </a>
                </div><!-- button-container --> <?php
            }

            if($introCopy || $secondaryIntroCopy){ ?>
                <div class="copy-container"> <?php
                    if($introCopy) echo $introCopy;
                    if($secondaryIntroCopy) echo $secondaryIntroCopy; ?>
                </div><!-- .copy-container --> <?php
             } ?>

        </div> <!-- .text-wrapper -->
    </div> <!-- .inner -->
</div> <!-- .hero -->
