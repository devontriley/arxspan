<?php

$post_type = 'career';
$taxonomies = get_object_taxonomies( array( 'post_type' => $post_type ) );

?>

<div class="open-opps">
    <p class="header">Open Opportunities</p>

    <?php
    foreach( $taxonomies as $taxonomy ) :

        // Gets every "category" (term) in this taxonomy to get the respective posts
        $terms = get_terms( $taxonomy );

        foreach( $terms as $term ) :

            $args = array(
                'post_type' => $post_type,
                'posts_per_page' => -1,  //show all posts
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'slug',
                        'terms' => $term->slug,
                    )
                )

            );

            $posts = new WP_Query($args);

//            echo '<pre>';
//            print_r($posts);
//            echo '</pre>';
            // TODO: fix query to go through array print

            if( $posts->have_posts() ): ?>

            <div class="category-wrapper <?php echo $term->name ?>">

                <p class="title">
                    <?php echo $term->name; ?>
                </p> <?php

                while( $posts->have_posts() ) : $posts->the_post(); ?>

                    <a href="<?php echo get_the_permalink(); ?>">
                        <?php echo get_the_title(); ?>
                    </a> <?php

                endwhile;

                wp_reset_postdata(); ?>

            </div><!-- .category-wrapper --> <?php

            endif;

         endforeach;

    endforeach; ?>

</div> <!-- .open-opps -->