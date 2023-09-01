<?php
/**
 * Digital Books Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Digital Books
 */

if ( ! defined( 'DIGITAL_BOOKS_URL' ) ) {
    define( 'DIGITAL_BOOKS_URL', esc_url( 'https://www.themagnifico.net/themes/book-store-wordpress-theme/', 'digital-books') );
}
if ( ! defined( 'DIGITAL_BOOKS_TEXT' ) ) {
    define( 'DIGITAL_BOOKS_TEXT', __( 'Digital Books Pro','digital-books' ));
}
if ( ! defined( 'DIGITAL_BOOKS_BUY_TEXT' ) ) {
    define( 'DIGITAL_BOOKS_BUY_TEXT', __( 'Buy Digital Books Pro','digital-books' ));
}

use WPTRT\Customize\Section\Digital_Books_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Digital_Books_Button::class );

    $manager->add_section(
        new Digital_Books_Button( $manager, 'digital_books_pro', [
            'title'       => esc_html( DIGITAL_BOOKS_TEXT,'digital-books' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'digital-books' ),
            'button_url'  => esc_url( DIGITAL_BOOKS_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'digital-books-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'digital-books-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function digital_books_customize_register($wp_customize){

     // Pro Version
    class Digital_Books_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( DIGITAL_BOOKS_BUY_TEXT,'digital-books' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Digital_Books_sanitize_custom_control( $input ) {
        return $input;
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        // Site title
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector' => '.site-title',
            'render_callback' => 'digital_books_customize_partial_blogname',
        ));
    }

     //Logo
    $wp_customize->add_setting('digital_books_logo_max_height',array(
        'default'   => '24',
        'sanitize_callback' => 'digital_books_sanitize_number_absint'
    ));
    $wp_customize->add_control('digital_books_logo_max_height',array(
        'label' => esc_html__('Logo Width','digital-books'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));


    // General Settings
     $wp_customize->add_section('digital_books_general_settings',array(
        'title' => esc_html__('General Settings','digital-books'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('digital_books_preloader_hide', array(
        'default' => 0,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'digital-books' ),
        'section'        => 'digital_books_general_settings',
        'settings'       => 'digital_books_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'digital_books_preloader_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'digital_books_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','digital-books'),
        'section' => 'digital_books_general_settings',
        'settings' => 'digital_books_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'digital_books_preloader_dot_1_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'digital_books_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','digital-books'),
        'section' => 'digital_books_general_settings',
        'settings' => 'digital_books_preloader_dot_1_color'
    )));

    $wp_customize->add_setting( 'digital_books_preloader_dot_2_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'digital_books_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','digital-books'),
        'section' => 'digital_books_general_settings',
        'settings' => 'digital_books_preloader_dot_2_color'
    )));

    $wp_customize->add_setting('digital_books_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'digital-books' ),
        'section'        => 'digital_books_general_settings',
        'settings'       => 'digital_books_sticky_header',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_scroll_hide', array(
        'default' => false,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'digital-books' ),
        'section'        => 'digital_books_general_settings',
        'settings'       => 'digital_books_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'digital_books_sanitize_choices'
    ));
    $wp_customize->add_control('digital_books_scroll_top_position',array(
        'type' => 'radio',
        'section' => 'digital_books_general_settings',
        'choices' => array(
            'Right' => __('Right','digital-books'),
            'Left' => __('Left','digital-books'),
            'Center' => __('Center','digital-books')
        ),
    ) );

    // Product Columns
    $wp_customize->add_setting( 'digital_books_products_per_row' , array(
        'default'           => '3',
        'transport'         => 'refresh',
        'sanitize_callback' => 'digital_books_sanitize_select',
    ) );

    $wp_customize->add_control('digital_books_products_per_row', array(
        'label' => __( 'Product per row', 'digital-books' ),
        'section'  => 'digital_books_general_settings',
        'type'     => 'select',
        'choices'  => array(
            '2' => '2',
            '3' => '3',
            '4' => '4',
        ),
    ) );

    $wp_customize->add_setting('digital_books_product_per_page',array(
        'default'   => '9',
        'sanitize_callback' => 'digital_books_sanitize_float'
    ));
    $wp_customize->add_control('digital_books_product_per_page',array(
        'label' => __('Product per page','digital-books'),
        'section'   => 'digital_books_general_settings',
        'type'      => 'number'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_general_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_general_setting', array(
        'section'     => 'digital_books_general_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

    // Post Settings
     $wp_customize->add_section('digital_books_post_settings',array(
        'title' => esc_html__('Post Settings','digital-books'),
        'priority'   =>40,
    ));

    $wp_customize->add_setting('digital_books_single_post_thumb',array(
        'sanitize_callback' => 'digital_books_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_single_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Thumbnail', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable post thumbnail on single post.', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_single_post_meta',array(
        'sanitize_callback' => 'digital_books_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_single_post_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Meta', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable single post meta such as post date, author, category, comment etc.', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_single_post_title',array(
            'sanitize_callback' => 'digital_books_sanitize_checkbox',
            'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_single_post_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Title', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable title on single post.', 'digital-books'),
    ));

    // Theme Color
    $wp_customize->add_section('digital_books_color_option',array(
        'title' => esc_html__('Theme Color','digital-books'),
        'priority'   => 10,
    ));

    $wp_customize->add_setting( 'digital_books_theme_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'digital_books_theme_color', array(
        'label' => esc_html__('First Color Option','digital-books'),
        'section' => 'digital_books_color_option',
        'settings' => 'digital_books_theme_color'
    )));

    $wp_customize->add_setting( 'digital_books_theme_color_2', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'digital_books_theme_color_2', array(
        'label' => esc_html__('Second Color Option','digital-books'),
        'section' => 'digital_books_color_option',
        'settings' => 'digital_books_theme_color_2'
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_color_option', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_color_option', array(
        'section'     => 'digital_books_color_option',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

    // Social Link
    $wp_customize->add_section('digital_books_social_link',array(
        'title' => esc_html__('Social Links','digital-books'),
    ));

    $wp_customize->add_setting('digital_books_social_on_of_setting', array(
        'default' => 0,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_social_on_of_setting',array(
        'label'          => __( 'Show Social Icon', 'digital-books' ),
        'section'        => 'digital_books_social_link',
        'settings'       => 'digital_books_social_on_of_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_facebook_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_facebook_icon',array(
        'label' => esc_html__('Add Facebook Icon','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_facebook_icon',
        'type'  => 'text',
        'default' => 'fab fa-facebook-f',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-facebook-f','digital-books')
    ));

    $wp_customize->add_setting('digital_books_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('digital_books_facebook_url',array(
        'label' => esc_html__('Facebook Link','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_facebook_url',
        'type'  => 'url'
    ));
    $wp_customize->add_setting('digital_books_twitter_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_twitter_icon',array(
        'label' => esc_html__('Add Twitter Icon','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_twitter_icon',
        'type'  => 'text',
        'default' => 'fab fa-twitter',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-twitter','digital-books')
    ));

    $wp_customize->add_setting('digital_books_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('digital_books_twitter_url',array(
        'label' => esc_html__('Twitter Link','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_twitter_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('digital_books_intagram_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_intagram_icon',array(
        'label' => esc_html__('Add Intagram Icon','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_intagram_icon',
        'type'  => 'text',
        'default' => 'fab fa-instagram',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-instagram','digital-books')
    ));

    $wp_customize->add_setting('digital_books_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('digital_books_intagram_url',array(
        'label' => esc_html__('Intagram Link','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('digital_books_linkedin_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_linkedin_icon',array(
        'label' => esc_html__('Add Linkedin Icon','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_linkedin_icon',
        'type'  => 'text',
        'default' => 'fab fa-linkedin-in',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-linkedin-in','digital-books')
    ));

    $wp_customize->add_setting('digital_books_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('digital_books_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_linkedin_url',
        'type'  => 'url'
    ));
    $wp_customize->add_setting('digital_books_pintrest_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_pintrest_icon',array(
        'label' => esc_html__('Add Pinterest Icon','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_pintrest_icon',
        'type'  => 'text',
        'default' => 'fab fa-pinterest-p',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-pinterest-p','digital-books')
    ));

    $wp_customize->add_setting('digital_books_pintrest_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('digital_books_pintrest_url',array(
        'label' => esc_html__('Pinterest Link','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_pintrest_url',
        'type'  => 'url'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_social_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_social_setting', array(
        'section'     => 'digital_books_social_link',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));


    //Slider
    $wp_customize->add_section('digital_books_top_slider',array(
        'title' => esc_html__('Slider Settings','digital-books'),
        'description' => esc_html__('Here you have to add 3 different pages in below dropdown. Note: Image Dimensions 1400 x 550 px','digital-books')
    ));

    $wp_customize->add_setting('digital_books_top_slider_section_setting', array(
        'default' => 1,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_top_slider_section_setting',array(
        'label'          => __( 'Enable Disable Slider', 'digital-books' ),
        'section'        => 'digital_books_top_slider',
        'settings'       => 'digital_books_top_slider_section_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_slider_loop', array(
        'default' => 0,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_slider_loop',array(
        'label'          => __( 'On Of Slider Loop', 'digital-books' ),
        'section'        => 'digital_books_top_slider',
        'settings'       => 'digital_books_slider_loop',
        'type'           => 'checkbox',
    )));

    for ( $digital_books_count = 1; $digital_books_count <= 3; $digital_books_count++ ) {

        $wp_customize->add_setting( 'digital_books_top_slider_page' . $digital_books_count, array(
            'default'           => '',
            'sanitize_callback' => 'digital_books_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'digital_books_top_slider_page' . $digital_books_count, array(
            'label'    => __( 'Select Slide Page', 'digital-books' ),
            'section'  => 'digital_books_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    // Pro Version
    $wp_customize->add_setting( 'pro_version_slider_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_slider_setting', array(
        'section'     => 'digital_books_top_slider',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

    //Featured Product
    $wp_customize->add_section('digital_books_home_product_category',array(
        'title' => esc_html__('Featured Product','digital-books'),
        'description' => esc_html__('Here you have to select product category which will display perticular featured product in the home page.','digital-books')
    ));

    $wp_customize->add_setting('digital_books_product_section_setting', array(
        'default' => 1,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_product_section_setting',array(
        'label'          => __( 'Enable Disable Product', 'digital-books' ),
        'section'        => 'digital_books_home_product_category',
        'settings'       => 'digital_books_product_section_setting',
        'type'           => 'checkbox',
    )));

    $digital_books_args = array(
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
    $categories = get_categories( $digital_books_args );
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cats[$category->slug] = $category->name;
    }
    $wp_customize->add_setting('digital_books_home_product',array(
        'sanitize_callback' => 'digital_books_sanitize_select',
    ));
    $wp_customize->add_control('digital_books_home_product',array(
        'type'    => 'select',
        'choices' => $cats,
        'label' => __('Select Product Category','digital-books'),
        'section' => 'digital_books_home_product_category',
    ));

    for ( $i = 1; $i <= 4; $i++ ) {
        $wp_customize->add_setting('digital_books_home_product_number'.$i,array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('digital_books_home_product_number'.$i,array(
            'label' => esc_html__('Number','digital-books'),
            'description' => esc_html__('Add Counter Number','digital-books'),
            'section' => 'digital_books_home_product_category',
            'setting' => 'digital_books_home_product_number',
            'type'    => 'text'
        ));
        $wp_customize->add_setting('digital_books_home_product_text'.$i,array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('digital_books_home_product_text'.$i,array(
            'label' => esc_html__('Text','digital-books'),
            'description' => esc_html__('Add Counter Text','digital-books'),
            'section' => 'digital_books_home_product_category',
            'setting' => 'digital_books_home_product_text',
            'type'    => 'text'
        ));
    }

    // Pro Version
    $wp_customize->add_setting( 'pro_version_product_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_product_setting', array(
        'section'     => 'digital_books_home_product_category',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

    // Footer
    $wp_customize->add_section('digital_books_site_footer_section', array(
        'title' => esc_html__('Footer', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_show_hide_copyright',array(
        'default' => true,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control('digital_books_show_hide_copyright',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Copyright','digital-books'),
        'section' => 'digital_books_site_footer_section',
    ));

    $wp_customize->add_setting('digital_books_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('digital_books_footer_text_setting', array(
        'label' => esc_html__('Replace the footer text', 'digital-books'),
        'section' => 'digital_books_site_footer_section',
        'type' => 'text',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_footer_setting', array(
        'section'     => 'digital_books_site_footer_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));
}
add_action('customize_register', 'digital_books_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function digital_books_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function digital_books_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function digital_books_customize_preview_js(){
    wp_enqueue_script('digital-books-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'digital_books_customize_preview_js');


/*
** Load dynamic logic for the customizer controls area.
*/
function digital_books_panels_js() {
    wp_enqueue_style( 'digital-books-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'digital-books-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'digital_books_panels_js' );

