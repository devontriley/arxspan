<?php
$tabTitle = get_sub_field('tab_module_title');
$postSelection = get_sub_field('tab_module');
$activeTab = $_GET['activeTab'] ? $_GET['activeTab'] : 1;
?>

<div class="tab-module">
    <div class="inner">

        <p class="header"><?php echo $tabTitle; ?></p>

        <?php
        $mobileIcons = array();
        $tabLinks = array();

        foreach($postSelection as $tabPost){
            $icon = get_field('product_icon', $tabPost->ID);
            $mobileIcons[] = $icon;

            $abbreviation = get_field('tab_abbreviation', $tabPost->ID);
            $tabLinks[] = $abbreviation;
        }

        if($mobileIcons) {
            $iteration = 0; ?>

            <div class="mobileIcons">
                <?php foreach($mobileIcons as $icon) { ?>
                    <div class="icon <?php if($iteration == $activeTab - 1) { echo 'active'; } ?>">
                        <?php
                        $img = wp_get_attachment_image($icon, 'full');
                        if($img) {
                            echo $img;
                        }
                        ?>
                    </div>
                <?php $iteration++;
                } ?>
            </div>

        <?php }

        if($tabLinks) {
        $iteration = 0; ?>

        <div class="tabs">
            <?php foreach($tabLinks as $tab) { ?>
                <button class="tablinks <?php if(($activeTab - 1) == $iteration){echo 'active';} ?>" id="iteration-<?php echo $iteration?>">
                    <?php echo $tab ?>
                </button>
                <?php $iteration++;
            } ?>
        </div>

        <?php } ?>

        <div class="tab-content-container">

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
                        <a class="text-block-link" href="<?php echo $link; ?>"></a>
                        <div class="inner">
                            <p class="title"><?php echo $title; ?></p>

                            <div class="blurb">
                                <?php echo $tabBlurb; ?>
                            </div><?php
//                            if(have_rows('components', $tabPost->ID)):
//
//                                $found = false;
//
//                                while(have_rows('components', $tabPost->ID)) : the_row();
//
//                                    if( get_row_layout() == 'text_module' && !$found ):
//                                        $found = true;
//                                        $textModule = get_sub_field('wysiwyg');
//                                        $textExcerpt = advanced_custom_field_excerpt($textModule); ?>
<!---->
<!--                                        <div class="blurb">-->
<!--                                            --><?php //echo $textExcerpt; ?>
<!--                                        </div> --><?php
//                                    endif;
//                                endwhile;
//                            endif;
                            ?>
                            <p class="learn-more">Learn More <svg viewBox="0 0 10 16"><use xlink:href="#button-arrow"></use></svg></p>
                        </div>
                    </div> <!-- .text-block -->
                </div><!-- .tabcontent -->
                <?php $iteration++;
            } ?>

        </div>

        <?php if(is_front_page()){ ?>
            <a class="overview" href="<?php echo get_permalink('7') ?>">See Overview <svg viewBox="0 0 10 16"><use xlink:href="#button-arrow"></use></svg></a> <?php
        }?>

    </div> <!-- .inner -->
</div> <!-- .tab-module -->

<script>
    // Load Module JS
    //require(['page/tab-module']);
</script>
