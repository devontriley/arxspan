<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
);
}
add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function blankslate_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

// BUTTON FUNCTION
function button($buttonLabel, $internalType, $buttonPath, $internalPath, $buttonUrl){
    $buttonLabel = get_sub_field('button_label');
    $pathType = get_sub_field('path_type');
    $internalType = get_sub_field('path_type') == 'internal';
    $buttonPath = get_sub_field('button_path');
    $internalPath = get_permalink($buttonPath[0]);
    $buttonUrl = get_sub_field('button_url');

    $html =     '<div class="btn-wrapper">';
    $html .=    '<a class="btn" href="'. ($internalType ? $internalPath : $buttonUrl) .'">';
    $html .=    $buttonLabel;
    $html .=    '</a><!-- .btn -->';
    $html .=    '</div><!-- .btn-wrapper -->';

    echo $html;
}


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
            'menu_name' => 'Whitepapers',
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
            'supports' => array(
                'title'
            )
        );
        register_post_type( 'whitepaper', $args );

        // register taxonomy
        register_taxonomy('whitepaper_category', 'whitepaper', array('hierarchical' => true, 'label' => 'Whitepaper', 'query_var' => true, 'rewrite' => array( 'slug' => 'whitepaper-category' )));
    }
    add_action( 'init', 'whitepaper_init' );