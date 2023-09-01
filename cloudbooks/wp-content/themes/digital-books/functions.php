<?php
/**
 * Digital Books functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Digital Books
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Digital_Books_Loader.php' );

$digital_books_loader = new \WPTRT\Autoload\Digital_Books_Loader();

$digital_books_loader->digital_books_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$digital_books_loader->digital_books_register();

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function digital_books_setup() {

	add_theme_support( 'responsive-embeds' );

	add_theme_support( 'woocommerce' );

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

	add_image_size('digital-books-featured-header-image', 2000, 660, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary','digital-books' ),
		'footer'=> esc_html__( 'Footer Menu','digital-books' ),
	) );

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
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

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

	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'digital_books_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function digital_books_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'digital_books_content_width', 1170 );
}
add_action( 'after_setup_theme', 'digital_books_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function digital_books_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'digital-books' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'digital-books' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'digital-books' ),
		'id'            => 'digital-books-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'digital-books' ),
		'id'            => 'digital-books-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'digital-books' ),
		'id'            => 'digital-books-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'digital_books_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function digital_books_scripts() {

		require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

		wp_enqueue_style(
		'ubuntu',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap' ),
		array(),
		'1.0'
		);

		wp_enqueue_style(
			'libre-baskerville',
			wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap' ),
			array(),
			'1.0'
		);

	wp_enqueue_style( 'digital-books-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

	// load bootstrap css
    wp_enqueue_style( 'bootstrap-css',get_template_directory_uri() . '/assets/css/bootstrap.css');

    // Theme stylesheet.
	wp_enqueue_style( 'digital-books-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom-option.php' );
	wp_add_inline_style( 'digital-books-style',$digital_books_theme_css );

	wp_enqueue_style( 'digital-books-style', get_stylesheet_uri() );

	wp_style_add_data('digital-books-style', 'rtl', 'replace');

	// fontawesome
	wp_enqueue_style( 'fontawesome-css',get_template_directory_uri().'/assets/css/fontawesome/css/all.css' );

	wp_enqueue_style( 'owl.carousel-css',get_template_directory_uri().'/assets/css/owl.carousel.css' );

    wp_enqueue_script('owl.carousel-js',get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '', true );

    wp_enqueue_script('digital-books-theme-js',get_template_directory_uri() . '/assets/js/theme-script.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	
}
add_action( 'wp_enqueue_scripts', 'digital_books_scripts' );

/**
 * Enqueue theme color style.
 */
function digital_books_theme_color() {

    $digital_books_theme_color_css = '';
    $digital_books_theme_color = get_theme_mod('digital_books_theme_color');
    $digital_books_theme_color_2 = get_theme_mod('digital_books_theme_color_2');
    $digital_books_preloader_bg_color = get_theme_mod('digital_books_preloader_bg_color');
    $digital_books_preloader_dot_1_color = get_theme_mod('digital_books_preloader_dot_1_color');
    $digital_books_preloader_dot_2_color = get_theme_mod('digital_books_preloader_dot_2_color');
    $digital_books_logo_max_height = get_theme_mod('digital_books_logo_max_height');

	if(get_theme_mod('digital_books_logo_max_height') == '') {
		$digital_books_logo_max_height = '24';
	}
    if(get_theme_mod('digital_books_preloader_bg_color') == '') {
			$digital_books_preloader_bg_color = '#000';
		}
		if(get_theme_mod('digital_books_preloader_dot_1_color') == '') {
			$digital_books_preloader_dot_1_color = '#fff';
		}
		if(get_theme_mod('digital_books_preloader_dot_2_color') == '') {
			$digital_books_preloader_dot_2_color = '#1e3237';
		}

	$digital_books_theme_color_css = '
		.custom-logo-link img{
				max-height: '.esc_attr($digital_books_logo_max_height).'px;
			 }
		.sticky .entry-title::before,.main-navigation .sub-menu,#button,.sidebar input[type="submit"],.comment-respond input#submit,.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, .posts-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover,.woocommerce .woocommerce-ordering select,.woocommerce ul.products li.product .onsale, .woocommerce span.onsale,.pro-button a, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.wp-block-button__link,.serv-box:hover,.woocommerce-account .woocommerce-MyAccount-navigation ul li,.btn-primary,.sidebar h5,.toggle-nav i,span.onsale,.slide-btn a,.serach_inner [type="submit"],.counter_box1,.sidebar .tagcloud a:hover,.woocommerce a.added_to_cart,a.account-btn {
			background: '.esc_attr($digital_books_theme_color).';
		}
		a,.sidebar ul li a:hover,#colophon a:hover, #colophon a:focus,p.price, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price,.woocommerce-message::before, .woocommerce-info::before,.slider-inner-box a h2,.woocommerce .star-rating span::before,.product-home-box .star-rating span::before,#colophon a:hover, #colophon a:focus,.slider-inner-box h2 {
			color: '.esc_attr($digital_books_theme_color).';
		}
		a.rsswidget {
    color: '.esc_attr($digital_books_theme_color).'!important;
		}
		.woocommerce-message, .woocommerce-info,.wp-block-pullquote,.wp-block-quote, .wp-block-quote:not(.is-large):not(.is-style-large), .wp-block-pullquote,.btn-primary{
			border-color: '.esc_attr($digital_books_theme_color).';
		}
		span.cart-value,.slide-btn a:hover,.pro-button a:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.main-navigation .sub-menu,#button:hover,.top-info,.serach_inner,#top-slider,#colophon,.woocommerce-account .woocommerce-MyAccount-navigation ul li:hover,.main-navigation .sub-menu > li > a:hover, .main-navigation .sub-menu > li > a:focus:hover,.woocommerce a.added_to_cart:hover{
			background: '.esc_attr($digital_books_theme_color_2).';
		}
		.main-navigation .menu > li > a:hover,{
			color: '.esc_attr($digital_books_theme_color_2).';
		}
		.loading{
			background-color: '.esc_attr($digital_books_preloader_bg_color).';
		 }
		 @keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($digital_books_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($digital_books_preloader_dot_2_color).';
		  }
		}
	';
    wp_add_inline_style( 'digital-books-style',$digital_books_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'digital_books_theme_color' );

/**
 * Enqueue S Header.
 */
function digital_books_sticky_header() {

  $digital_books_sticky_header = get_theme_mod('digital_books_sticky_header');

  $digital_books_custom_style= "";

  if($digital_books_sticky_header != true){

    $digital_books_custom_style .='.stick_header{';

      $digital_books_custom_style .='position: static;';

    $digital_books_custom_style .='}';
  }

  wp_add_inline_style( 'digital-books-style',$digital_books_custom_style );

}
add_action( 'wp_enqueue_scripts', 'digital_books_sticky_header' );

function digital_books_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/*dropdown page sanitization*/
function digital_books_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function digital_books_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

function digital_books_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function digital_books_sanitize_checkbox( $input ) {
  // Boolean check
  return ( ( isset( $input ) && true == $input ) ? true : false );
}

 //Float
function digital_books_sanitize_float( $input ) {
    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

/*radio button sanitization*/
function digital_books_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/**
 * Get CSS
 */

function digital_books_getpage_css($hook) {
	if ( 'appearance_page_digital-books-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'digital-books-demo-style', get_template_directory_uri() . '/assets/css/demo.css' );
}
add_action( 'admin_enqueue_scripts', 'digital_books_getpage_css' );

add_action('after_switch_theme', 'digital_books_setup_options');

function digital_books_setup_options () {
	wp_redirect( admin_url() . 'themes.php?page=digital-books-info.php' );
}

if ( ! defined( 'DIGITAL_BOOKS_CONTACT_SUPPORT' ) ) {
define('DIGITAL_BOOKS_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/digital-books','digital-books'));
}
if ( ! defined( 'DIGITAL_BOOKS_REVIEW' ) ) {
define('DIGITAL_BOOKS_REVIEW',__('https://wordpress.org/support/theme/digital-books/reviews/#new-post','digital-books'));
}
if ( ! defined( 'DIGITAL_BOOKS_LIVE_DEMO' ) ) {
define('DIGITAL_BOOKS_LIVE_DEMO',__('https://www.themagnifico.net/demo/digital-books/','digital-books'));
}
if ( ! defined( 'DIGITAL_BOOKS_GET_PREMIUM_PRO' ) ) {
define('DIGITAL_BOOKS_GET_PREMIUM_PRO',__('https://www.themagnifico.net/themes/book-store-wordpress-theme/','digital-books'));
}
if ( ! defined( 'DIGITAL_BOOKS_PRO_DOC' ) ) {
define('DIGITAL_BOOKS_PRO_DOC',__('https://www.themagnifico.net/eard/wathiqa/book-store-pro-doc/','digital-books'));
}

add_action('admin_menu', 'digital_books_themepage');
function digital_books_themepage(){

	$digital_books_theme_test = wp_get_theme();

	$digital_books_theme_info = add_theme_page( __('Theme Options','digital-books'), __(' Theme Options','digital-books'), 'manage_options', 'digital-books-info.php', 'digital_books_info_page' );
}

function digital_books_info_page() {
	$digital_books_theme_user = wp_get_current_user();
	$digital_books_theme = wp_get_theme();
	?>
	<div class="wrap about-wrap digital-books-add-css">
		<div>
			<h1>
				<?php esc_html_e('Welcome To ','digital-books'); ?><?php echo esc_html( $digital_books_theme ); ?>
			</h1>
			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Contact Support", "digital-books"); ?></h3>
						<p><?php esc_html_e("Thank you for trying Digital Books , feel free to contact us for any support regarding our theme.", "digital-books"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( DIGITAL_BOOKS_CONTACT_SUPPORT ); ?>" class="button button-primary get">
							<?php esc_html_e("Contact Support", "digital-books"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Checkout Premium", "digital-books"); ?></h3>
						<p><?php esc_html_e("Our premium theme comes with extended features like demo content import , responsive layouts etc.", "digital-books"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( DIGITAL_BOOKS_GET_PREMIUM_PRO ); ?>" class="button button-primary get">
							<?php esc_html_e("Get Premium", "digital-books"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Review", "digital-books"); ?></h3>
						<p><?php esc_html_e("If You love Digital Books theme then we would appreciate your review about our theme.", "digital-books"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( DIGITAL_BOOKS_REVIEW ); ?>" class="button button-primary get">
							<?php esc_html_e("Review", "digital-books"); ?>
						</a></p>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<h2><?php esc_html_e("Free Vs Premium","digital-books"); ?></h2>
		<div class="digital-books-button-container">
			<a target="_blank" href="<?php echo esc_url( DIGITAL_BOOKS_PRO_DOC ); ?>" class="button button-primary get">
				<?php esc_html_e("Checkout Documentation", "digital-books"); ?>
			</a>
			<a target="_blank" href="<?php echo esc_url( DIGITAL_BOOKS_LIVE_DEMO ); ?>" class="button button-primary get">
				<?php esc_html_e("View Theme Demo", "digital-books"); ?>
			</a>
		</div>


		<table class="wp-list-table widefat">
			<thead class="table-book">
				<tr>
					<th><strong><?php esc_html_e("Theme Feature", "digital-books"); ?></strong></th>
					<th><strong><?php esc_html_e("Basic Version", "digital-books"); ?></strong></th>
					<th><strong><?php esc_html_e("Premium Version", "digital-books"); ?></strong></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php esc_html_e("Header Background Color", "digital-books"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Navigation Logo Or Text", "digital-books"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Hide Logo Text", "digital-books"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Premium Support", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Fully SEO Optimized", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Recent Posts Widget", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Easy Google Fonts", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Pagespeed Plugin", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Header Image On Front Page", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Show Header Everywhere", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Text On Header Image", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Full Width (Hide Sidebar)", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Upper Widgets On Front Page", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Replace Copyright Text", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Upper Widgets Colors", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Navigation Color", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Post/Page Color", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Blog Feed Color", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Footer Color", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Sidebar Color", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Background Color", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Importable Demo Content	", "digital-books"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
			</tbody>
		</table>
		<div class="digital-books-button-container">
			<a target="_blank" href="<?php echo esc_url( DIGITAL_BOOKS_GET_PREMIUM_PRO ); ?>" class="button button-primary get">
				<?php esc_html_e("Go Premium", "digital-books"); ?>
			</a>
		</div>
	</div>
	<?php
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'digital_books_shop_per_page', 9 );
function digital_books_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'digital_books_product_per_page', 9 );
	return $cols;
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'digital_books_loop_columns');
if (!function_exists('digital_books_loop_columns')) {
	function digital_books_loop_columns() {
		$columns = get_theme_mod( 'digital_books_products_per_row', 3 );
		return $columns; // 3 products per row
	}
}

