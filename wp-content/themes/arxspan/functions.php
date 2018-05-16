<?php
add_action( 'after_setup_theme', 'bloodmoon_setup' );
function bloodmoon_setup() {
    load_theme_textdomain( 'bloodmoon', get_template_directory() . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );

    global $content_width;

    if ( ! isset( $content_width ) ) $content_width = 640;

    register_nav_menus(
        array( 'main-menu' => __( 'Main Menu', 'bloodmoon' ) )
    );
}

add_filter( 'the_title', 'bloodmoon_title' );
function bloodmoon_title( $title ) {
    if ( $title == '' ) {
        return '&rarr;';
    } else {
        return $title;
    }
}

add_filter( 'wp_title', 'bloodmoon_filter_wp_title' );
function bloodmoon_filter_wp_title( $title ) {
    return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_action( 'widgets_init', 'bloodmoon_widgets_init' );
function bloodmoon_widgets_init() {
    register_sidebar( array (
        'name' => __( 'Sidebar Widget Area', 'bloodmoon' ),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}

// Wordpress Ajax
function wordpress_ajaxurl() { ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
<?php }
add_action('wp_head','wordpress_ajaxurl');

//allow svg uploads in back end
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// add special class to products nav item
function my_special_nav_class( $classes, $item ) {

    if ( $item->title == 'Products' ) {
        $classes[] = 'highlight';
    }

    return $classes;

}

add_filter( 'nav_menu_css_class', 'my_special_nav_class', 10, 2 );

// allow excerpt pulling from advanced custom fields
function advanced_custom_field_excerpt($text) {
    global $post;
//	$text = get_field('your_field_name');
    if ( '' != $text ) {
        $text = strip_shortcodes( $text );
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        $excerpt_length =35; // 35 words
        $excerpt_more = apply_filters('excerpt_more', ' ' . '...');
        $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
    }
    return apply_filters('the_excerpt', $text);
}

//Add this line in your template
//echo advanced_custom_field_excerpt();

// remove default wysiwyg
function remove_editor() {
    remove_post_type_support('page', 'editor');
    remove_post_type_support('product', 'editor');
    remove_post_type_support('industry', 'editor');
    remove_post_type_support('solution', 'editor');
    remove_post_type_support('event', 'editor');
    remove_post_type_support('career', 'editor');
    remove_post_type_support('news', 'editor');
    remove_post_type_support('whitepaper', 'editor');
    remove_post_type_support('mktflyer', 'editor');
}
add_action('admin_init', 'remove_editor');


//OPTIMIZATION

// remove wp-embed.min.js
function my_deregister_scripts(){
    wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

// remove wp-emoji-release.min.js
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// BUTTON FUNCTION
function button($buttonLabel, $buttonUrl){ // placeholders, can change name if want, sequence matters more

    $html =     '<div class="btn-wrapper">';
    $html .=    '<a class="btn" href="'. $buttonUrl .'">';
    $html .=    '<span>';
    $html .=    $buttonLabel;
    $html .=    '</span>';
    $html .=    '<svg viewbox="0 0 10 16"><use xlink:href="#button-arrow"></use></svg>';
    $html .=    '</a><!-- .btn -->';
    $html .=    '</div><!-- .btn-wrapper -->';

    echo $html;
}

// Wrap registration mark in <sup>
add_filter( 'acf/load_value', 'wrapRegistration', 10, 4 );
add_filter( 'the_title', 'wrapRegistration', 10, 4 );
function wrapRegistration($content) {
    $patt = '/(®)/';
    $content = preg_replace($patt, '<sup>®</sup>', $content);

    return $content;
}

add_filter( 'acf/load_value/type=wysiwyg', 'remove_shortcode_p', 10, 3 );
function remove_shortcode_p( $value, $post_id, $field ) {
    $content = apply_filters('the_content',$value);
    $patt = '/<p>&nbsp;<\/p>/';
    $content = preg_replace( $patt, '', $content );

    return $content;
}

// SHORTCODE

// wysiwyg cols shortcode
function row($params, $content = null) {

    extract(shortcode_atts(array(
        'cols' => 'two'
    ), $params));

    return '<div class="row ' . $cols . '">' . do_shortcode($content) . '</div>';
}
add_shortcode('row','row');


function col( $atts, $content = null ){
    return '<div class="col">'. $content .'</div>';
}
add_shortcode( 'col', 'col' );


// slider shortcode
function shortcodeSlider( $atts ){

    extract(shortcode_atts(array(
        'ids' => ''
    ), $atts));

    if( !empty($atts['ids'] )){

        $imagesArr = explode(', ', $atts['ids']);
        $imagesArr = array_slice($imagesArr, 0, 10);

        $args = array(
            'post__in'          => $imagesArr,
            'post_type'         => 'attachment',
            'posts_per_page'    => 10,
            'post_status'	    => 'inherit',
            'orderby'           => 'post__in'
        );

        $images = new WP_Query( $args );

        if( $images->have_posts()):

            $iteration = 0;
            $slides;
            $navItems;

            while($images->have_posts()) : $images->the_post();

                $active = ($iteration == 0) ? 'active' : '';

                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $images->post->ID ), 'full');
                $caption = get_the_excerpt($images->post->ID);

                $slides .= '<li class="'. $active .'"><img src="'. $image[0] .'" />';
                if($caption){
                    $slides .= '<span class="wp-caption-text">'. $caption .'</span>';
                }
                $slides .= '</li>';

                $navItems .= '<button></button>';

                $iteration++;

            endwhile;

            $html = '<div class="slider-wrapper">';
            $html .= '<ul class="slider">';
            $html .= $slides;
            $html .= '</ul><!-- .slider-->';
            $html .= '<nav class="slider-nav">';
            $html .= $navItems;
            $html .= '</nav>';
            $html .= '</div><!-- .slider-wrapper-->';

        endif;
        wp_reset_query();
        return $html;
    }
}

// in wysiwyg the text should look like [slider ids="269, 268, 267"][/slider]

add_shortcode('slider', 'shortcodeSlider');


// get shortcode to stop spitting out so many p tags


// ADD BUTTONS FOR SHORTCODE

require('inc/custom-editor-buttons/mce-buttons.php');


// CUSTOM POST TYPES  //

// Products Custom Post Type
function product_init() {
    // set up product labels
    $labels = array(
        'name' => 'Products',
        'singular_name' => 'Product',
        'add_new' => 'Add New Product',
        'add_new_item' => 'Add New Product',
        'edit_item' => 'Edit Product',
        'new_item' => 'New Product',
        'all_items' => 'All Products',
        'view_item' => 'View Product',
        'search_items' => 'Search Products',
        'not_found' =>  'No Products Found',
        'not_found_in_trash' => 'No Products found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Products',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'product'),
        'query_var' => true,
        'menu_icon' => 'dashicons-cart',
        'hierarchical' => true,
        'supports' => array(
            'title'
        )
    );
    register_post_type( 'product', $args );

    // register taxonomy
    register_taxonomy('product_category', 'product', array('hierarchical' => true, 'label' => 'Product', 'query_var' => true, 'rewrite' => array( 'slug' => 'product-category' )));
}
add_action( 'init', 'product_init' );

// Industries Custom Post Type
function industry_init() {
    // set up product labels
    $labels = array(
        'name' => 'Industries',
        'singular_name' => 'Industry',
        'add_new' => 'Add New Industry',
        'add_new_item' => 'Add New Industry',
        'edit_item' => 'Edit Industry',
        'new_item' => 'New Industry',
        'all_items' => 'All Industries',
        'view_item' => 'View Industry',
        'search_items' => 'Search Industries',
        'not_found' =>  'No Industries Found',
        'not_found_in_trash' => 'No Industries found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Industries',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'industry'),
        'query_var' => true,
        'menu_icon' => 'dashicons-building',
        'hierarchical' => true,
        'supports' => array(
            'title'
        )
    );
    register_post_type( 'industry', $args );

    // register taxonomy
    register_taxonomy('industry_category', 'industry', array('hierarchical' => true, 'label' => 'Industry', 'query_var' => true, 'rewrite' => array( 'slug' => 'industry-category' )));
}
add_action( 'init', 'industry_init' );


// Solutions Custom Post Type
function solution_init() {
    // set up product labels
    $labels = array(
        'name' => 'Solutions',
        'singular_name' => 'Solution',
        'add_new' => 'Add New Solution',
        'add_new_item' => 'Add New Solution',
        'edit_item' => 'Edit Solution',
        'new_item' => 'New Solution',
        'all_items' => 'All Solutions',
        'view_item' => 'View Solution',
        'search_items' => 'Search Solutions',
        'not_found' =>  'No Solutions Found',
        'not_found_in_trash' => 'No Solutions found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Solutions',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'solution'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-tools',
        'hierarchical' => true,
        'supports' => array(
            'title'
        )
    );
    register_post_type( 'solution', $args );

    // register taxonomy
    register_taxonomy('solution_category', 'solution', array('hierarchical' => true, 'label' => 'Solution', 'query_var' => true, 'rewrite' => array( 'slug' => 'solution-category' )));
}
add_action( 'init', 'solution_init' );

// Events Custom Post Type
function event_init() {
    // set up product labels
    $labels = array(
        'name' => 'Events',
        'singular_name' => 'Event',
        'add_new' => 'Add New Event',
        'add_new_item' => 'Add New Event',
        'edit_item' => 'Edit Event',
        'new_item' => 'New Event',
        'all_items' => 'All Events',
        'view_item' => 'View Event',
        'search_items' => 'Search Events',
        'not_found' =>  'No Events Found',
        'not_found_in_trash' => 'No Events found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Events',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'event'),
        'query_var' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'hierarchical' => true,
        'supports' => array(
            'title'
        )
    );
    register_post_type( 'event', $args );

    // register taxonomy
    register_taxonomy('event_category', 'event', array('hierarchical' => true, 'label' => 'Event', 'query_var' => true, 'rewrite' => array( 'slug' => 'event-category' )));
}
add_action( 'init', 'event_init' );

// Careers Custom Post Type
function career_init() {
    // set up product labels
    $labels = array(
        'name' => 'Careers',
        'singular_name' => 'Career',
        'add_new' => 'Add New Career',
        'add_new_item' => 'Add New Career',
        'edit_item' => 'Edit Career',
        'new_item' => 'New Career',
        'all_items' => 'All Careers',
        'view_item' => 'View Career',
        'search_items' => 'Search Careers',
        'not_found' =>  'No Careers Found',
        'not_found_in_trash' => 'No Careers found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Careers',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'career'),
        'query_var' => true,
        'menu_icon' => 'dashicons-businessman',
        'hierarchical' => true,
        'supports' => array(
            'title'
        )
    );
    register_post_type( 'career', $args );

    // register taxonomy
    register_taxonomy('career_category', 'career', array('hierarchical' => true, 'label' => 'Career', 'query_var' => true, 'rewrite' => array( 'slug' => 'career-category' )));
}
add_action( 'init', 'career_init' );


// News Custom Post Type
function news_init() {
    // set up product labels
    $labels = array(
        'name' => 'News Articles',
        'singular_name' => 'News Article',
        'add_new' => 'Add New News Article',
        'add_new_item' => 'Add New News Article',
        'edit_item' => 'Edit News Article',
        'new_item' => 'New News Article',
        'all_items' => 'All News Articles',
        'view_item' => 'View News Article',
        'search_items' => 'Search News Articles',
        'not_found' =>  'No News Articles Found',
        'not_found_in_trash' => 'No News Articles found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'News Articles',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'news'),
        'query_var' => true,
        'menu_icon' => 'dashicons-megaphone',
        'hierarchical' => true,
        'supports' => array(
            'title'
        )
    );
    register_post_type( 'news', $args );

    // register taxonomy
    register_taxonomy('news_category', 'news', array('hierarchical' => true, 'label' => 'News', 'query_var' => true, 'rewrite' => array( 'slug' => 'news-category' )));
}
add_action( 'init', 'news_init' );

// Whitepapers Custom Post Type
function whitepaper_init() {
    // set up product labels
    $labels = array(
        'name' => 'Whitepapers',
        'singular_name' => 'Whitepaper',
        'add_new' => 'Add New Whitepaper',
        'add_new_item' => 'Add New Whitepaper',
        'edit_item' => 'Edit Whitepaper',
        'new_item' => 'New Whitepaper',
        'all_items' => 'All Whitepapers',
        'view_item' => 'View Whitepaper',
        'search_items' => 'Search Whitepapers',
        'not_found' =>  'No Whitepapers Found',
        'not_found_in_trash' => 'No Whitepapers found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Whitepapers'
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'whitepaper'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-page',
        'hierarchical' => true,
        'supports' => array(
            'title'
        )
    );
    register_post_type( 'whitepaper', $args );

    // register taxonomy
    register_taxonomy('whitepaper_category', 'whitepaper', array('hierarchical' => true, 'label' => 'Whitepaper', 'query_var' => true, 'rewrite' => array( 'slug' => 'whitepaper-category' )));
}
add_action( 'init', 'whitepaper_init' );

//  Marketing Flyers Custom Post Type
function mktflyer_init() {
    // set up product labels
    $labels = array(
        'name' => 'Marketing Flyers',
        'singular_name' => 'Marketing Flyer',
        'add_new' => 'Add New Marketing Flyer',
        'add_new_item' => 'Add New Marketing Flyer',
        'edit_item' => 'Edit Marketing Flyer',
        'new_item' => 'New Marketing Flyer',
        'all_items' => 'All Marketing Flyers',
        'view_item' => 'View Marketing Flyer',
        'search_items' => 'Search Marketing Flyer',
        'not_found' =>  'No Marketing Flyers Found',
        'not_found_in_trash' => 'No Marketing Flyers found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Marketing Flyers',
    );

    // register post type
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'mktflyer'),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-page',
        'hierarchical' => true,
        'supports' => array(
            'title'
        )
    );
    register_post_type( 'mktflyer', $args );

    // register taxonomy
    register_taxonomy('mktflyer_category', 'mktflyer', array('hierarchical' => true, 'label' => 'Marketing Flyer', 'query_var' => true, 'rewrite' => array( 'slug' => 'mktflyer-category' )));
}
add_action( 'init', 'mktflyer_init' );

// Use same template for careers and events post types
add_filter( 'template_include', function( $template ) {
    // your custom post types
    $my_types = array( 'career', 'event', 'news' );

    // is the current request for a single page of one of your post types?
    if ( is_singular( $my_types ) ){
        // if it is return the common single template
        return get_stylesheet_directory() . '/single-careerevent.php';
    } else {
        // if not a match, return the $template that was passed in
        return $template;
    }
});



// LOAD MORE POSTS AJAX

function load_more_news_posts(){

    // This is how we can retrieve POST variables from ajax
    $data = json_decode(file_get_contents('php://input'));

    $perPage = 4;
    $currentPage = $data->currentPage;
    $currentOffset = 8 + ($currentPage * $perPage);

    $args = array(
        'post_type' => array('event', 'news'),
        'posts_per_page' => $perPage,
        'offset' => $currentOffset,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $ajax_query = new WP_Query( $args );

    if( $ajax_query->have_posts() ):

        $output;

        while( $ajax_query->have_posts() ): $ajax_query->the_post();

            $title = get_the_title();
            $date = get_the_date('d/m/y');
            $blurb = get_field('grid_description');
            $buttonUrl = get_permalink();
            $buttonLabel = 'Read More';

            $output .= '<div class="post-container">';
            $output .= '<a class="post-link" href="'. $buttonUrl .'"></a>';
            $output .= '<div class="inner">';
            $output .= '<p class="title">'. $title .'</p>';
            $output .= '<p class="date">'. $date .'</p>';
            $output .= '<div class="blurb">'. $blurb .'</div>';

            $output .=     '<div class="btn-wrapper">';
            $output .=    '<a class="btn" href="'. $buttonUrl .'"><span>'. $buttonLabel .'</span>';
            $output .=    '<svg viewbox="0 0 10 16"><use xlink:href="#button-arrow"></use></svg>';
            $output .=    '</a><!-- .btn -->';
            $output .=    '</div><!-- .btn-wrapper -->';

            $output .= '</div> <!-- .inner -->';
            $output .= '</div> <!-- .post-container -->';

        endwhile;

        wp_reset_postdata();
    endif;

    $dataOutput = array(
        'offset' => $ajax_query->post_count,
        'html' => $output
    );

    echo json_encode($dataOutput);

    exit;
}

add_action('wp_ajax_nopriv_load_more_news_posts', 'load_more_news_posts');
add_action('wp_ajax_load_more_news_posts', 'load_more_news_posts');


/*
 * Add data to body of main svg bg filename for javascript to use
 */

function set_main_bg() {
    $url = wp_get_referer();
    $id = url_to_postid($url);
    $postType = get_post_type($id);

    // This corresponds to the svg filename
    $filename = 'listing'; // default

    if( $id ==  5 )
    {
        $filename = 'homepage';
    }
    else if( $id == 7 )
    {
        $filename = 'product-overview';
    }
    else if( $postType == 'product' )
    {
        $filename = 'product';
    }
    else if( $id == 17 )
    {
        $filename = 'industry-overview';
    }
    else if( $postType == 'industry' )
    {
        $filename = 'industry';
    }
    else if( $id == 76 )
    {
        $filename = 'our-approach';
    }
    else if( $id == 80 || $id == 102 || $postType == 'career' || $postType == 'event' )
    {
        $filename = 'listing';
    }
    else if( $id == 78 )
    {
        $filename ='news-overview';
    }
    else if( $id == 20 )
    {
        $filename = 'solutions-overview';
    }
    else if( $postType == 'solution' )
    {
        $filename = 'solution';
    }
    else if( $id == 84 || $id == 328 || $postType == 'whitepaper' )
    {
        $filename = 'listing';
    }
    else if(is_404()){
        $filename = 'gradient';
    }

    echo get_bloginfo('template_directory') . '/images/backgrounds/' . $filename . '.svg';

    exit;
}

add_action('wp_ajax_nopriv_set_main_bg', 'set_main_bg');
add_action('wp_ajax_set_main_bg', 'set_main_bg');