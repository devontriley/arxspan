<?php

//GENERAL
$postGridLayout = get_sub_field('post_grid_layout');
$solutionsLayout = get_sub_field('post_grid_layout') == 'solutions';
$whitepapersLayout = get_sub_field('post_grid_layout') == 'whitepapers';
$newsEventsLayout = get_sub_field('post_grid_layout') == 'newsevents';

$gridTitle = get_sub_field('grid_title');
$gridContent = get_sub_field('grid_content');

//SOLUTIONS GRID
$solutionsGridType = get_sub_field('solutions_grid_layout');
$withCopyType = get_sub_field('solutions_grid_layout') == 'with-copy';
$postsOnlyType = get_sub_field('solutions_grid_layout') == 'posts-only';

$solutions = get_sub_field('solutions');

//WHITEPAPERS GRID
$whitepapers = get_sub_field('whitepapers');

//NEWS AND EVENTS
$newsEvents = get_sub_field('news_events');


if($postGrid){ ?>
    <div class="post-grid-wrapper <?php echo $postGridLayout?>"><?php

        //SOLUTIONS GRID
        if($solutionsLayout){

            //WITH COPY
            if($withCopyType){ ?>
                <div class="text-container"> <?php
                    if($gridTitle){ ?>
                        <p class="header">
                            <?php echo $gridTitle; ?>
                        </p><?php
                    }

                    if($gridContent){ ?>
                        <div class="content">
                            <?php echo $gridContent; ?>
                        </div><?php
                    } ?>

                    <!-- ADD BUTTON -->
                </div><!-- .text-container --><?php
            }

            //POST QUERY ?>
            <div class="posts-container"> <?php
                foreach($solutions as $solutionPost){ ?>

                    <div class="post-container">
                        <p class="title">
                            <?php echo $solutionPost->post_title; ?>
                        </p>

                        <div class="blurb">
                            <?php echo the_field('grid_description', $solutionPost->ID); ?>
                        </div>

                        <a class="learn-more" href="<?php echo get_permalink($solutionPost->ID); ?>">
                            Learn More
                        </a>
                    </div><!-- .post-container --><?php
                } //endforeach ?>
            </div> <!-- .posts-container --> <?php

        }

        //WHITEPAPERS GRID
        if($whitepapersLayout){
            if($gridTitle){ ?>
                <p class="title">
                    <?php echo $gridTitle; ?>
                </p><?php
            } ?>

            <div class="posts-container"> <?php
                foreach($whitepapers as $whitepaperPost){ ?>
                    <div class="post-container"> <?php
                        echo $whitepaperPost->post_title;
                        // echo blurb
                        //learn more link ?>
                    </div><!-- .post-container --><?php
                } ?>
                <!-- add learn more link here -->
            </div><!-- .posts-container --><?php
        }

        //NEWS + EVENTS GRID
        if($newsEventsLayout){
            if($gridTitle){ ?>
                <p class="header">
                    <?php echo $gridTitle; ?>
                </p><?php
            } ?>

            <div class="posts-container"><?php
                foreach($newsEvents as $newsEventsPost){ ?>
                    <div class="post-container">
                        <p class="title">
                            <?php echo $newsEventsPost->post_title; ?>
                        </p>

                        <?php echo get_the_date('d/m/y', $newsEventsPost->ID); ?>

                        <div class="blurb">
                            <?php echo the_field('grid_description', $newsEventsPost->ID); ?>
                        </div>

                        <a class="view-more" href="<?php echo get_permalink($newsEventsPost->ID); ?>">
                            View More
                        </a><?php
                        //view more button?>
                    </div><!--.post-container--><?php
                } ?>
            </div><!-- .posts-container --><?php
        }?>

    </div><!-- .post-grid-wrapper --> <?php
} // if post grid