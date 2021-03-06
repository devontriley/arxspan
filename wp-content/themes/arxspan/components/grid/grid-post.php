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
$buttonUrl = get_permalink(20);
$buttonLabel = 'View All Solutions';

//WHITEPAPERS GRID
$whitepapers = get_sub_field('whitepapers');

//NEWS AND EVENTS
if(is_page(78)) {
    $args = array(
        'post_type' => array('event', 'news'),
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 8,
        'post_status' => 'publish'
    );
    $newsEvents = new WP_Query($args);
    $newsEventsFound = $newsEvents->found_posts;
    $newsEvents = $newsEvents->posts;
} else {
    $is_slider = true;
    $newsEvents = get_sub_field('news_events');
}


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
                    }

//                    button($buttonLabel, $buttonUrl); ?>
                </div><!-- .text-container --><?php
            }

            //POST QUERY ?>
            <div class="posts-container <?php if(!$withCopyType){ echo ' no-copy';}?>">
                <?php
                foreach($solutions as $solutionPost){ ?>

                    <div class="post-container">
                        <a class="post-link" href="<?php echo get_permalink($solutionPost->ID); ?>"></a>
                        <p class="title">
                            <?php echo $solutionPost->post_title; ?>
                        </p> <?php

                        if(have_rows('components', $solutionPost->ID)):
                            while(have_rows('components', $solutionPost->ID)) : the_row();

                                if( get_row_layout() == 'text_module' ):
                                    $textModule = get_sub_field('wysiwyg');
                                    $textExcerpt = advanced_custom_field_excerpt($textModule); ?>

                                    <div class="blurb">
                                        <?php echo $textExcerpt; ?>
                                    </div> <?php
                                endif;

                            endwhile;
                        endif; ?>

                        <p class="learn-more">
                            Learn More <svg viewBox="0 0 10 16"><use xlink:href="#button-arrow"></use></svg>
                        </p>
                    </div><!-- .post-container --><?php
                } //endforeach ?>
            </div> <!-- .posts-container --> <?php

        }

        //WHITEPAPERS GRID
        if($whitepapersLayout){

            echo get_template_part('components/backgrounds/whitepapers-bg');

            if($gridTitle){ ?>
                <p class="header">
                <?php echo $gridTitle; ?>
                </p><?php
            } ?>

            <div class="posts-container total-<?php echo count($whitepapers); ?>"> <?php
                $iteration = 0;
                foreach($whitepapers as $whitepaperPost){ ?>
                    <div class="post-container">
                        <div class="inner">
                            <?php if(get_post_type($whitepaperPost) == 'mktflyer') { ?>

                                <a class="post-link" href="<?php the_field('pdf_download', $whitepaperPost->ID); ?>" target="_blank"></a>

                            <?php } else { ?>

                                <a class="post-link" href="<?php echo get_permalink($whitepaperPost->ID); ?>"></a>

                            <?php } ?>

                            <div class="top">
                                <svg class="circle" viewBox="0 0 200 200">
                                      <circle cx="100" cy="100" r="100"/>
                                </svg>

                                <svg class="whitepaper" viewBox="0 0 271 271">
                                    <use xlink:href="#whitepaper-icon"></use>
                                </svg>
                            </div>

                            <?php if($whitepaperPost->post_title) { ?>
                                <p class="title">
                                    <?php echo wrapRegistration($whitepaperPost->post_title); ?>
                                </p> <?php
                            } ?>

                            <div class="blurb">
                                <?php echo the_field('grid_description', $whitepaperPost->ID); ?>
                            </div>

                            <a class="learn-more" href="<?php echo get_permalink($whitepaperPost->ID); ?>">
                                Learn More <svg viewBox="0 0 10 16"><use xlink:href="#button-arrow"></use></svg>
                            </a>

                            <?php
                            //learn more link ?>
                        </div><!-- .inner -->
                    </div><!-- .post-container --><?php
                    $iteration++;
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

            <div class="posts-container <?php if($is_slider){echo 'is-slider';} ?>">
                <div class="grid-inner" data-found="<?php echo $newsEventsFound ?>"><?php

                    if($is_slider){
                        $postIteration = 0;
                        $postCount = 1;
                        $postsTotal = count($newsEvents);
                        $navItems;

                        echo '<ul class="post-slider">';
                    }

                    foreach($newsEvents as $newsEventsPost){
                        $buttonLabel = 'View More';
                        $buttonUrl = get_permalink($newsEventsPost->ID);
                        ?>

                        <?php if($is_slider){
                            if($postIteration == 0){
                                echo '<li>';
                                $navItems .= ($postCount == 1 ) ? '<button class="active"></button>' : '<button></button>';
                            }
                        } ?>

                        <div class="post-container <?php if($is_slider){ echo $postIteration; }?>">
                            <a class="post-link" href="<?php echo $buttonUrl ?>"></a>
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

                                <?php button($buttonLabel, $buttonUrl); ?>
                            </div>
                        </div><!--.post-container--><?php

                        if($is_slider){
                            $postIteration++;
                            $postCount++;

                            if($postIteration == 2 || $postCount == $postsTotal) {
                                echo '</li>';
                                $postIteration = 0;
                            }
                        }
                    }

                    if($is_slider){
                        echo '</ul>';
                    }?>

                </div><!-- #grid-inner --> <?php

                if(is_page(78)){ ?>
                    <button class="btn" id="load-more">
                    <span id="load-text">Load More Articles</span>
                    <img id="loader-gif" alt="loading" src="<?php bloginfo('template_directory');?>/images/loading_spinner.gif"/>
                    </button> <!-- #load-more --> <?php
                } ?>

            </div><!-- .posts-container --><?php
        } //if news event layout ?>

    </div><!-- .post-grid-wrapper --> <?php
} // if post grid