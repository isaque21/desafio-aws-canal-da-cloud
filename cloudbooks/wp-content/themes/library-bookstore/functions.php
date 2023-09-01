<?php
/**
 * Library Bookstore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Library Bookstore
 */

if ( ! defined( 'DIGITAL_BOOKS_URL' ) ) {
    define( 'DIGITAL_BOOKS_URL', esc_url( 'https://www.themagnifico.net/themes/library-wordpress-theme/', 'library-bookstore') );
}
if ( ! defined( 'DIGITAL_BOOKS_TEXT' ) ) {
    define( 'DIGITAL_BOOKS_TEXT', __( 'Library Bookstore Pro','library-bookstore' ));
}
if ( ! defined( 'DIGITAL_BOOKS_CONTACT_SUPPORT' ) ) {
define('DIGITAL_BOOKS_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/library-bookstore','library-bookstore'));
}
if ( ! defined( 'DIGITAL_BOOKS_REVIEW' ) ) {
define('DIGITAL_BOOKS_REVIEW',__('https://wordpress.org/support/theme/library-bookstore/reviews/#new-post','library-bookstore'));
}
if ( ! defined( 'DIGITAL_BOOKS_LIVE_DEMO' ) ) {
define('DIGITAL_BOOKS_LIVE_DEMO',__('https://themagnifico.net/demo/library-bookstore/','library-bookstore'));
}
if ( ! defined( 'DIGITAL_BOOKS_GET_PREMIUM_PRO' ) ) {
define('DIGITAL_BOOKS_GET_PREMIUM_PRO',__('https://www.themagnifico.net/themes/library-wordpress-theme/','library-bookstore'));
}
if ( ! defined( 'DIGITAL_BOOKS_PRO_DOC' ) ) {
define('DIGITAL_BOOKS_PRO_DOC',__('https://www.themagnifico.net/eard/wathiqa/library-bookstore-doc/','library-bookstore'));
}
if ( ! defined( 'DIGITAL_BOOKS_BUY_TEXT' ) ) {
    define( 'DIGITAL_BOOKS_BUY_TEXT', __( 'Buy Library Bookstore Pro','library-bookstore' ));
}

function library_bookstore_enqueue_styles() {
    wp_enqueue_style( 'flatly-css', esc_url(get_template_directory_uri()) . '/assets/css/flatly.css');
    $parentcss = 'digital-books-style';
    $theme = wp_get_theme(); wp_enqueue_style( $parentcss, get_template_directory_uri() . '/style.css', array(), $theme->parent()->get('Version'));
    wp_enqueue_style( 'library-bookstore-style', get_stylesheet_uri(), array( $parentcss ), $theme->get('Version'));

    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );  

    wp_enqueue_script('library-bookstore-custom-js',get_theme_file_uri() . '/assets/js/custom-script.js', array('jquery'), '', true );
}
add_action( 'wp_enqueue_scripts', 'library_bookstore_enqueue_styles' );
function library_bookstore_admin_scripts() {
    // demo CSS
    wp_enqueue_style( 'library-bookstore-demo-css', get_theme_file_uri( 'assets/css/demo.css' ) );
}
add_action( 'admin_enqueue_scripts', 'library_bookstore_admin_scripts' );

function library_bookstore_customize_register($wp_customize){

     // Pro Version
    class Library_Bookstore_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( DIGITAL_BOOKS_BUY_TEXT,'library-bookstore' ) .'<strong></a>';
            echo '</a>';
        }
    }

    //Latest Product
    $wp_customize->add_section('library_bookstore_latest_product',array(
        'title' => esc_html__('Latest Product','library-bookstore'),
        'description' => esc_html__('Here you have to select product category which will display perticular latest product in the home page.','library-bookstore'),
    ));

    $wp_customize->add_setting('library_bookstore_latest_product_title', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('library_bookstore_latest_product_title', array(
        'label' => __('Section Title', 'library-bookstore'),
        'section' => 'library_bookstore_latest_product',
        'priority' => 1,
        'type' => 'text',
    ));
    $wp_customize->add_setting('library_bookstore_latest_product_sub_title', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('library_bookstore_latest_product_sub_title', array(
        'label' => __('Section Sub Title', 'library-bookstore'),
        'section' => 'library_bookstore_latest_product',
        'priority' => 2,
        'type' => 'text',
    ));
    $wp_customize->add_setting('library_bookstore_latest_number', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('library_bookstore_latest_number', array(
        'label' => __('Product Count', 'library-bookstore'),
        'section' => 'library_bookstore_latest_product',
        'priority' => 2,
        'type' => 'number',
    ));

    $args = array(
       'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
    $categories = get_categories( $args );
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        } 
        $cats[$category->slug] = $category->name;
    }
    $wp_customize->add_setting('library_bookstore_latest_product',array(
        'sanitize_callback' => 'digital_books_sanitize_select',
    ));
    $wp_customize->add_control('library_bookstore_latest_product',array(
        'type'    => 'select',
        'choices' => $cats,
        'label' => __('Select Product Category','library-bookstore'),
        'section' => 'library_bookstore_latest_product',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_feature_product_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Library_Bookstore_Customize_Pro_Version ( $wp_customize,'pro_version_feature_product_setting', array(
        'section'     => 'library_bookstore_latest_product',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'library-bookstore' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

}
add_action('customize_register', 'library_bookstore_customize_register');

if ( ! function_exists( 'library_bookstore_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function library_bookstore_setup() {

        add_theme_support( 'responsive-embeds' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        add_image_size('library-bookstore-featured-header-image', 2000, 660, true);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'digital_books_custom_background_args', array(
            'default-color' => '',
            'default-image' => '',
        ) ) );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 50,
            'flex-width'  => true,
        ) );

        add_editor_style( array( '/editor-style.css' ) );

        add_theme_support( 'align-wide' );

        add_theme_support( 'wp-block-styles' );
    }
endif;
add_action( 'after_setup_theme', 'library_bookstore_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function library_bookstore_widgets_init() {
        register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'library-bookstore' ),
        'id'            => 'sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'library-bookstore' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ) );
}
add_action( 'widgets_init', 'library_bookstore_widgets_init' );
