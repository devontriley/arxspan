<?php
// ADD COLS BUTTON HERE



////////////////// BX SLIDER BLOG GALLERY BUTTON ///////////////////////////////

add_shortcode('img-slider', 'customImgSlider');

function customImgSlider( $atts ){

    extract(shortcode_atts(array(
        'sliderimages' => ''
    ), $atts));

    if( !empty($atts['sliderimages'] )){

        $imagesArr = explode(', ', $atts['sliderimages']);
        $imagesArr = array_slice($imagesArr, 0, 10);

        $args = array(
            'post__in'       => $imagesArr,
            'post_type'      => 'attachment',
            'posts_per_page' => 10,
            'post_status'	   => 'inherit'
        );

        $images = new WP_Query( $args );

        if( $images->have_posts()):
            $html = '<div id="img-bxslider-wrapper">';
            $html .= '<ul class="img-bxslider">';

            while($images->have_posts()) : $images->the_post();

                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $images->post->ID ), 'full');
                $caption = get_the_excerpt($images->post->ID);

                $html .= '<li><div><img src="'. $image[0] .'" /></div>';
                if($caption){
                    $html .= '<span class="wp-caption-text">'. $caption .'</span>';
                }
                $html .= '</li>';
            endwhile;

            $html .= '</ul><!-- #img-bxslider-->';
            $html .= '</div><!-- #img-bxslider-wrapper-->';

        endif;
        wp_reset_query();
        return $html;
    }
}

?>
