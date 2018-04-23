<?php
$bannerTitle = get_sub_field('banner_title');
$buttonLabel = get_sub_field('button_label');
$buttonUrl = get_sub_field('button_url');
?>

<div class="cta-banner">
    <div class="inner">
        <p class="banner-text">
            <?php echo $bannerTitle; ?>
        </p>

        <?php button($buttonLabel, $buttonUrl); ?>
    </div><!-- .inner -->
</div><!-- .cta-banner -->
