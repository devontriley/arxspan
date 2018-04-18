<?php

$postSelection = get_sub_field('tab_module');
$activeTab = $_GET['activeTab'];

?>

<div class="tab-module">
    <div class="inner">

        <div class="wrapper">
            <p class="header">ArxLab® Products</p>
            <div class="tabs"> <?php
                $iteration = 0;

                foreach($postSelection as $tabPost){
                    //vars
                    $abbreviation = get_field('tab_abbreviation', $tabPost->ID);
                    ?>
                    <button class="tablinks <?php if($activeTab == $iteration){echo 'active';} ?>" id="iteration-<?php echo $iteration?>"><?php echo $abbreviation ?></button> <?php
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
                    <div class="tabcontent <?php if($activeTab == $iteration){echo 'active'; }?>" id="<?php echo $name ?>">
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
    require(['page/tab-module']);
</script>

<script>
    // // change into class - in constructor make 2 vars, 1 will be getTabModule 1 will be getActiveTab (can rework names) -
    // // try adding tab js here
    // function openProduct(evt, tabName){
    //     //vars
    //     var i, tabcontent, tablinks;
    //
    //     //get tabcontent and hide
    //     tabcontent = document.getElementsByClassName('tabcontent');
    //     for (i = 0; i < tabcontent.length; i++ ){
    //         tabcontent[i].style.display = 'none';
    //     }
    //
    //     // get tablinks and remove class active
    //     tablinks = document.getElementsByClassName('tablinks');
    //     for (i = 0; i < tablinks.length; i++ ){
    //         tablinks[i].className = tablinks[i].className.replace('active', '');
    //     }
    //
    //     // show current tab and add active class to button that opened it
    //     document.getElementById(tabName).style.display = 'flex';
    //     evt.currentTarget.className += ' active';
    // }
    //
    // // activate first tab on load
    // var firstTab = document.getElementById('iteration-0');
    // firstTab.click();

</script>
