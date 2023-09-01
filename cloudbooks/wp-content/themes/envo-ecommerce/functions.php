<?php
/**
 * The current version of the theme.
 */
define('ENVO_ECOMMERCE_VERSION', '1.1.0');

add_action('after_setup_theme', 'envo_ecommerce_setup');

if (!function_exists('envo_ecommerce_setup')) :

    /**
     * Global functions
     */
    function envo_ecommerce_setup() {

        // Theme lang.
        load_theme_textdomain('envo-ecommerce', get_template_directory() . '/languages');

        // Add Title Tag Support.
        add_theme_support('title-tag');

        // Register Menus.
        register_nav_menus(
            array(
                'main_menu' => esc_html__('Main Menu', 'envo-ecommerce'),
            )
        );

        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(300, 300, true);
        add_image_size('envo-ecommerce-single', 1140, 641, true);
        add_image_size('envo-ecommerce-med', 720, 405, true);

        // Add Custom Background Support.
        $args = array(
            'default-color' => 'ffffff',
        );
        add_theme_support('custom-background', $args);

        add_theme_support('custom-logo', array(
            'height' => 60,
            'width' => 200,
            'flex-height' => true,
            'flex-width' => true,
            'header-text' => array('site-title', 'site-description'),
        ));

        // Adds RSS feed links to for posts and comments.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         */
        add_theme_support('title-tag');

        // Set the default content width.
        $GLOBALS['content_width'] = 1140;

        add_theme_support('custom-header', apply_filters('envo_ecommerce_custom_header_args', array(
            'width' => 2000,
            'height' => 200,
            'default-text-color'     => '',
            'wp-head-callback' => 'envo_ecommerce_header_style',
        )));

        // WooCommerce support.
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('html5', array('search-form'));
        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style(array('css/bootstrap.css', envo_ecommerce_fonts_url(), 'css/editor-style.css'));

        // Recommend plugins.
        add_theme_support('recommend-plugins', array(
            'woocommerce' => array(
                'name' => 'WooCommerce',
                'active_filename' => 'woocommerce/woocommerce.php',
                /* translators: %s plugin name string */
                'description' => sprintf(esc_attr__('To enable shop features, please install and activate the %s plugin.', 'envo-ecommerce'), '<strong>WooCommerce</strong>'),
            ),
            'elementor' => array(
                'name' => 'Elementor',
                'active_filename' => 'elementor/elementor.php',
                /* translators: %s plugin name string */
                'description' => sprintf(esc_attr__('To enable shop features, please install and activate the %s plugin.', 'envo-ecommerce'), '<strong>Elementor</strong>'),
            ),
            'envo-extra' => array(
                'name' => 'Envo Extra',
                'active_filename' => 'envo-extra/envo-extra.php',
                'description' => esc_html__('Save time by importing our demo data: your website will be set up and ready to be customized in minutes.', 'envo-ecommerce'),
            ),
        ));
    }

endif;

if (!function_exists('envo_ecommerce_header_style')) :

    /**
     * Styles the header image and text displayed on the blog.
     */
    function envo_ecommerce_header_style() {
        $header_image = get_header_image();
        $header_text_color = get_header_textcolor();
        if (get_theme_support('custom-header', 'default-text-color') !== $header_text_color || !empty($header_image)) {
            ?>
            <style type="text/css" id="envo-ecommerce-header-css">
            <?php
            // Has a Custom Header been added?
            if (!empty($header_image)) :
                ?>
                    .site-header {
                        background-image: url(<?php header_image(); ?>);
                        background-repeat: no-repeat;
                        background-position: 50% 50%;
                        -webkit-background-size: cover;
                        -moz-background-size:    cover;
                        -o-background-size:      cover;
                        background-size:         cover;
                    }
            <?php endif; ?>	
            <?php
            // Has the text been hidden?
            if ('blank' === $header_text_color) :
                ?>
                    .site-title,
                    .site-description {
                        position: absolute;
                        clip: rect(1px, 1px, 1px, 1px);
                    }
            <?php elseif ('' !== $header_text_color) : ?>
                    .site-title a, 
                    .site-title, 
                    .site-description {
                        color: #<?php echo esc_attr($header_text_color); ?>;
                    }
            <?php endif; ?>	
            </style>
            <?php
        }
    }

endif; // envo_ecommerce_header_style

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function envo_ecommerce_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'envo_ecommerce_pingback_header');

/**
 * Set Content Width
 */
function envo_ecommerce_content_width() {

    $content_width = $GLOBALS['content_width'];

    if (is_active_sidebar('envo-ecommerce-right-sidebar')) {
        $content_width = 750;
    } else {
        $content_width = 1040;
    }

    /**
     * Filter content width of the theme.
     */
    $GLOBALS['content_width'] = apply_filters('envo_ecommerce_content_width', $content_width);
}

add_action('template_redirect', 'envo_ecommerce_content_width', 0);

/**
 * Register custom fonts.
 */
function envo_ecommerce_fonts_url() {
    $fonts_url = '';

    /**
     * Translators: If there are characters in your language that are not
     * supported by Open Sans Condensed, translate this to 'off'. Do not translate
     * into your own language.
     */
    $font = _x('on', 'Open Sans Condensed font: on or off', 'envo-ecommerce');

    if ('off' !== $font) {
        $font_families = array();

        $font_families[] = 'Open Sans Condensed:300,500,700';

        $query_args = array(
            'family' => urlencode(implode('|', $font_families)),
            'subset' => urlencode('cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 */
function envo_ecommerce_resource_hints($urls, $relation_type) {
    if (wp_style_is('envo-ecommerce-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}

add_filter('wp_resource_hints', 'envo_ecommerce_resource_hints', 10, 2);

/**
 * Enqueue Styles (normal style.css and bootstrap.css)
 */
function envo_ecommerce_theme_stylesheets() {
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('envo-ecommerce-fonts', envo_ecommerce_fonts_url(), array(), null);
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.7');
    wp_enqueue_style('mmenu-light', get_template_directory_uri() . '/css/mmenu-light.css', array(), ENVO_ECOMMERCE_VERSION);
    // Theme stylesheet.
    wp_enqueue_style('envo-ecommerce-stylesheet', get_stylesheet_uri(), array('bootstrap'), ENVO_ECOMMERCE_VERSION);
    // Load Font Awesome css.
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0');
}

add_action('wp_enqueue_scripts', 'envo_ecommerce_theme_stylesheets');

/**
 * Register Bootstrap JS with jquery
 */
function envo_ecommerce_theme_js() {
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7', true);
    wp_enqueue_script('envo-ecommerce-theme-js', get_template_directory_uri() . '/js/customscript.js', array('jquery'), ENVO_ECOMMERCE_VERSION, true);
    wp_enqueue_script('mmenu', get_template_directory_uri() . '/js/mmenu-light.min.js', array('jquery'), ENVO_ECOMMERCE_VERSION, true);
}

add_action('wp_enqueue_scripts', 'envo_ecommerce_theme_js');

if (!function_exists('envo_ecommerce_is_pro_activated')) {

    /**
     * Query Envo eCommerce activation
     */
    function envo_ecommerce_is_pro_activated() {
        return defined('ENVO_ECOMMERCE_PRO_CURRENT_VERSION') ? true : false;
    }

}

/**
 * Register Custom Navigation Walker include custom menu widget to use walkerclass
 */
require_once( trailingslashit(get_template_directory()) . 'lib/wp_bootstrap_navwalker.php' );

/**
 * Register Theme Info Page
 */
require_once( trailingslashit(get_template_directory()) . 'lib/dashboard.php' );

/**
 * Customizer options
 */
require_once( trailingslashit(get_template_directory()) . 'lib/customizer.php' );

if (class_exists('WooCommerce')) {
    /**
     * Customizer options
     */
    require_once( trailingslashit(get_template_directory()) . 'lib/woocommerce.php' );
}

add_action('widgets_init', 'envo_ecommerce_widgets_init');

/**
 * Register the Sidebar(s)
 */
function envo_ecommerce_widgets_init() {
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'envo-ecommerce'),
            'id' => 'envo-ecommerce-right-sidebar',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title"><h3>',
            'after_title' => '</h3></div>',
        )
    );
    register_sidebar(
        array(
            'name' => esc_html__('Top Bar Section', 'envo-ecommerce'),
            'id' => 'envo-ecommerce-top-bar-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-4">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title"><h3>',
            'after_title' => '</h3></div>',
        )
    );
    register_sidebar(
        array(
            'name' => esc_html__('Header Section', 'envo-ecommerce'),
            'id' => 'envo-ecommerce-header-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title"><h3>',
            'after_title' => '</h3></div>',
        )
    );
    register_sidebar(
        array(
            'name' => esc_html__('Footer Section', 'envo-ecommerce'),
            'id' => 'envo-ecommerce-footer-area',
            'before_widget' => '<div id="%1$s" class="widget %2$s col-md-3">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-title"><h3>',
            'after_title' => '</h3></div>',
        )
    );
}

function envo_ecommerce_main_content_width_columns() {

    $columns = '12';

    if (is_active_sidebar('envo-ecommerce-right-sidebar')) {
        $columns = $columns - 4;
    }

    echo absint($columns);
}

if (!function_exists('envo_ecommerce_entry_footer')) :

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function envo_ecommerce_entry_footer() {

        // Get Categories for posts.
        $categories_list = get_the_category_list(' ');

        // Get Tags for posts.
        $tags_list = get_the_tag_list('', ' ');

        // We don't want to output .entry-footer if it will be empty, so make sure its not.
        if ($categories_list || $tags_list || get_edit_post_link()) {

            echo '<div class="entry-footer">';

            if ('post' === get_post_type()) {
                if ($categories_list || $tags_list) {

                    // Make sure there's more than one category before displaying.
                    if ($categories_list) {
                        echo '<div class="cat-links"><span class="space-right">' . esc_html__('Category', 'envo-ecommerce') . '</span>' . wp_kses_data($categories_list) . '</div>';
                    }

                    if ($tags_list) {
                        echo '<div class="tags-links"><span class="space-right">' . esc_html__('Tags', 'envo-ecommerce') . '</span>' . wp_kses_data($tags_list) . '</div>';
                    }
                }
            }

            edit_post_link();

            echo '</div>';
        }
    }

endif;

if (!function_exists('envo_ecommerce_generate_construct_footer')) :
    /**
     * Build footer
     */
    add_action('envo_ecommerce_generate_footer', 'envo_ecommerce_generate_construct_footer');

    function envo_ecommerce_generate_construct_footer() {
        ?>
        <div class="footer-credits-text text-center">
            <?php
            /* translators: %s: WordPress name with wordpress.org URL */
            printf(__('Proudly powered by %s', 'envo-ecommerce'), '<a href="' . esc_url(__('https://wordpress.org/', 'envo-ecommerce')) . '">WordPress</a>'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            ?>
            <span class="sep"> | </span>
            <?php
            /* translators: %1$s: Envo eCommerce name with envothemes.com URL */
            printf(esc_html__('Theme: %1$s', 'envo-ecommerce'), '<a href="' . esc_url('https://envothemes.com/free-envo-ecommerce/') . '">Envo eCommerce</a>');
            ?>
        </div> 
        <?php
    }

endif;


if (!function_exists('envo_ecommerce_widget_date_comments')) :

    /**
     * Returns date for widgets.
     */
    function envo_ecommerce_widget_date_comments() {
        ?>
        <span class="posted-date">
            <?php echo esc_html(get_the_date()); ?>
        </span>
        <span class="comments-meta">
            <?php
            if (!comments_open()) {
                esc_html_e('Off', 'envo-ecommerce');
            } else {
                ?>
                <a href="<?php the_permalink(); ?>#comments" rel="nofollow" title="<?php esc_attr_e('Comment on ', 'envo-ecommerce') . the_title_attribute(); ?>">
                    <?php echo absint(get_comments_number()); ?>
                </a>
            <?php } ?>
            <i class="fa fa-comments-o"></i>
        </span>
        <?php
    }

endif;

if (!function_exists('envo_ecommerce_excerpt_length')) :

    /**
     * Excerpt limit.
     */
    function envo_ecommerce_excerpt_length($length) {
        return 20;
    }

    add_filter('excerpt_length', 'envo_ecommerce_excerpt_length', 999);

endif;

if (!function_exists('envo_ecommerce_excerpt_more')) :

    /**
     * Excerpt more.
     */
    function envo_ecommerce_excerpt_more($more) {
        return '&hellip;';
    }

    add_filter('excerpt_more', 'envo_ecommerce_excerpt_more');

endif;

if (!function_exists('envo_ecommerce_thumb_img')) :

    /**
     * Returns widget thumbnail.
     */
    function envo_ecommerce_thumb_img($img = 'full', $col = '', $link = true, $single = false) {
        if (function_exists('envo_ecommerce_pro_thumb_img')) {
            envo_ecommerce_pro_thumb_img($img, $col, $link, $single);
        } elseif (( has_post_thumbnail() && $link == true)) {
            ?>
            <div class="news-thumb <?php echo esc_attr($col); ?>">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail($img); ?>
                </a>
            </div><!-- .news-thumb -->
        <?php } elseif (has_post_thumbnail()) { ?>
            <div class="news-thumb <?php echo esc_attr($col); ?>">
                <?php the_post_thumbnail($img); ?>
            </div><!-- .news-thumb -->	
            <?php
        }
    }

endif;

/**
 * Single previous next links
 */
if (!function_exists('envo_ecommerce_prev_next_links')) :

    function envo_ecommerce_prev_next_links() {
        the_post_navigation(
            array(
                'prev_text' => '<span class="screen-reader-text">' . __('Previous Post', 'envo-ecommerce') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Previous', 'envo-ecommerce') . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>%title</span>',
                'next_text' => '<span class="screen-reader-text">' . __('Next Post', 'envo-ecommerce') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Next', 'envo-ecommerce') . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></span>',
            )
        );
    }

endif;

/**
 * Post author meta funciton
 */
if (!function_exists('envo_ecommerce_author_meta')) :

    function envo_ecommerce_author_meta() {
        ?>
        <span class="author-meta">
            <span class="author-meta-by"><?php esc_html_e('By', 'envo-ecommerce'); ?></span>
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename'))); ?>">
                <?php the_author(); ?>
            </a>
        </span>
        <?php
    }

endif;

if ( ! function_exists( 'wp_body_open' ) ) :
    /**
     * Fire the wp_body_open action.
     *
     * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
     *
     */
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         *
         */
        do_action( 'wp_body_open' );
    }
endif;

if (!function_exists('envo_ecommerce_header_search')) {
    
    add_action('envo_ecommerce_header', 'envo_ecommerce_header_search', 10);

    function envo_ecommerce_header_search() {
            ?>
            <div class="search-heading col-md-6 col-xs-12">
                <?php if (class_exists('WooCommerce')) { ?>
                    <div class="header-search-form">
                        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                            <select class="header-search-select" name="product_cat">
                                <option value=""><?php esc_html_e('All Categories', 'envo-ecommerce'); ?></option> 
                                <?php
                                $categories = get_categories('taxonomy=product_cat');
                                foreach ($categories as $category) {
                                    $option = '<option value="' . esc_attr($category->category_nicename) . '">';
                                    $option .= esc_html($category->cat_name);
                                    $option .= ' (' . absint($category->category_count) . ')';
                                    $option .= '</option>';
                                    echo $option; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                }
                                ?>
                            </select>
                            <input type="hidden" name="post_type" value="product" />
                            <input class="header-search-input" name="s" type="text" placeholder="<?php esc_attr_e('Search products...', 'envo-ecommerce'); ?>"/>
                            <button class="header-search-button" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                <?php } ?>
                <?php if (is_active_sidebar('envo-ecommerce-header-area')) { ?>
                    <div class="site-heading-sidebar" >
                        <?php dynamic_sidebar('envo-ecommerce-header-area'); ?>
                    </div>
                <?php } ?>
            </div>
            <?php
    }

}