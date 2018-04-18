<?php
$bannerTitle = get_sub_field('banner_title');

?>

<div class="cta-banner">
    <div class="inner">
        <?php
        echo $bannerTitle;

        include('button.php');
        ?>
    </div><!-- .inner -->
</div><!-- .cta-banner -->
