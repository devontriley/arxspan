<?php

// N E W S    E V E N T S    P A G E
if($newsEventsLayout) {
    if (is_page(78)) {
        // NEWS EVENTS PAGE

        $perPage = 4;
        $currentPage = $_POST['wrapper'];
        $currentOffset = 8 + ($currentPage * $perPage);

        $args = array(
            'post_type' => array('event', 'news'),
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $perPage,
            'offset' => $currentOffset,
            'post_status' => 'publish'
        );

        $newsEventQuery = new WP_Query($args);

        $totalPosts = ceil($newsEventQuery->found_posts / 8);

        if ($newsEventQuery->have_posts()) :

            echo '<div id="posts-container" data-total="' . $newsEventQuery->found_posts . '">';
            echo '<div class="grid-inner">';

            while ($newsEventQuery->have_posts()): $newsEventQuery->the_post();

                $title = get_the_title();
                $date = get_the_date('d/m/y');
                $blurb = get_field('grid_description');
                $buttonUrl = get_permalink();
                $buttonLabel = 'View';

                $output = '<div class="post-container">';
                $output .= '<a class="post-link" href="'. $buttonUrl .'"></a>';
                $output .= '<div class="inner">';
                $output .= '<p class="title">'. $title .'</p>';
                $output .= '<p class="date">'. $date .'</p>';
                $output .= '<div class="blurb">'. $blurb .'</div>';
                //$output .= button($buttonLabel, $buttonUrl);
                $output .= '</div> <!-- .inner -->';
                $output .= '</div> <!-- .post-container -->';

            endwhile; // newsEventQuery have posts

            wp_reset_postdata(); ?>

            </div> <!-- .grid inner -->

            <div id="page-counter"> <!-- change to button wrapper -->
                <div id="loader">
                    <img id="loader-gif" alt="loading"
                         src="<?php bloginfo('template_directory'); ?>/img/ajax-loader1.gif"/>
                    <span id="loader-text">Loading</span>
                </div><!-- .loader -->

                <button id="load-more">
                    <span id="load-text">Load More Articles</span>
                </button> <!-- #load-more -->
            </div>

            </div> <?php

        endif; // resourcequery have posts

    } else {
        // NEWS EVENTS SPOTLIGHT
        if ($gridTitle) { ?>
            <p class="header">
            <?php echo $gridTitle; ?>
            </p><?php
        } ?>

        <div class="posts-container"><?php
            foreach ($newsEvents as $newsEventsPost) {
                $buttonLabel = 'View More';
                $buttonUrl = get_permalink($newsEventsPost->ID);
                ?>

                <div class="post-container">
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
            } ?>
        </div><!-- .posts-container --><?php
    } // else news events spotlight module
} // if news events layout

?>
