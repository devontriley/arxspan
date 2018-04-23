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
                    }?>
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
                <p class="header">
                    <?php echo $gridTitle; ?>
                </p><?php
            } ?>

            <div class="posts-container"> <?php
                foreach($whitepapers as $whitepaperPost){ ?>
                    <div class="post-container">
                        <div class="inner">
                            <div class="top">
                                <svg viewBox="0 0 271 271">
                                    <use xlink:href="#whitepaper-icon"></use>
                                </svg>
                            </div>

                            <p class="title">
                                <?php echo $whitepaperPost->post_title; ?>
                            </p>

                            <div class="blurb">
                                <?php echo the_field('grid_description', $whitepaperPost->ID); ?>
                            </div>

                            <a class="learn-more" href="<?php echo get_permalink($whitepaperPost->ID); ?>">
                                Learn More
                            </a>

                            <?php
                            //learn more link ?>
                        </div><!-- .inner -->
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
                        <div class="inner">
                            <p class="title">
                                <?php echo $newsEventsPost->post_title; ?>
                            </p>

                            <p class="date">
                                <?php echo get_the_date('d/m/y', $newsEventsPost->ID); ?>
                            </p>

                            <div class="blurb">
                                <?php echo the_field('grid_description', $newsEventsPost->ID); ?>
                            </div>

                            <a class="view-more" href="<?php echo get_permalink($newsEventsPost->ID); ?>">
                                View More
                                <svg viewbox="0 0 10 16"><use xlink:href="#button-arrow"></use></svg>
                            </a>
                        </div>
                    </div><!--.post-container--><?php
                } ?>
            </div><!-- .posts-container --><?php
        }?>

    </div><!-- .post-grid-wrapper --> <?php
} // if post grid