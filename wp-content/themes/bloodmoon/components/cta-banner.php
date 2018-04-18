<?php
$bannerTitle = get_sub_field('banner_title');

?>

<div class="cta-banner">
    <div class="inner">
        <p class="banner-text">
            <?php echo $bannerTitle; ?>
        </p>

        <?php include('button.php'); ?>
    </div><!-- .inner -->
</div><!-- .cta-banner -->
