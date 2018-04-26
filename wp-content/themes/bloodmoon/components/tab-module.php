<?php
$tabTitle = get_sub_field('tab_module_title');
$postSelection = get_sub_field('tab_module');
$activeTab = $_GET['activeTab'] ? $_GET['activeTab'] : 1;
?>

<div class="tab-module">
    <div class="inner">

        <div class="wrapper">
            <p class="header"><?php echo $tabTitle; ?></p>
            <div class="tabs"> <?php
                $iteration = 0;

                foreach($postSelection as $tabPost){
                    //vars
                    $abbreviation = get_field('tab_abbreviation', $tabPost->ID);
                    ?>
                    <button class="tablinks <?php if(($activeTab - 1) == $iteration){echo 'active';} ?>" id="iteration-<?php echo $iteration?>"><?php echo $abbreviation ?></button> <?php
                    $iteration++;
                } ?>
            </div>

                <?php
                $iteration = 0;

                foreach($postSelection as $tabPost){
                    //vars
                    $name = $tabPost->post_name;
                    $title = $tabPost->post_title;
                    $icon = get_field('product_icon', $tabPost->ID);
                    $iconFull = wp_get_attachment_image($icon, 'full');
                    $tabBlurb = get_field('tab_blurb', $tabPost->ID);
                    $link = get_permalink($tabPost->ID);
                    ?>
                    <div class="tabcontent <?php if(($activeTab - 1) == $iteration){echo 'active'; }?>" id="<?php echo $name ?>">
                        <div class="img-block">
                            <?php echo $iconFull ?>
                        </div> <!-- .img-block -->

                        <div class="text-block">
                            <div class="inner">
                                <p class="title"><?php echo $title; ?></p>
                                <?php echo $tabBlurb; ?>
                                <a class="learn-more" href="<?php echo $link; ?>">Learn More</a>
                            </div>
                        </div> <!-- .text-block -->
                    </div><!-- .tabcontent -->
                    <?php $iteration++;
                } ?>
            <a class="overview" href="<?php echo get_permalink('7') ?>">See Overview</a>
        </div>
    </div> <!-- .inner -->
</div> <!-- .tab-module -->

<script>
    // Load Module JS
    //require(['page/tab-module']);
</script>
