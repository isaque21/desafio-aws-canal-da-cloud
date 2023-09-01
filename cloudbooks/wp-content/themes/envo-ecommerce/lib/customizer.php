<?php
/**
 * Envo eCommerce Theme Customizer
 *
 * @package Envo eCommerce
 */

$envo_ecommerce_sections = array( 'info', 'demo' );

foreach( $envo_ecommerce_sections as $section ){
    require get_template_directory() . '/lib/customizer/' . $section . '.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
}

function envo_ecommerce_customizer_scripts() {
    wp_enqueue_style( 'envo-ecommerce-customize',get_template_directory_uri().'/lib/customizer/css/customize.css', '', 'screen' );
    wp_enqueue_script( 'envo-ecommerce-customize', get_template_directory_uri() . '/lib/customizer/js/customize.js', array( 'jquery' ), '20170404', true );
}
add_action( 'customize_controls_enqueue_scripts', 'envo_ecommerce_customizer_scripts' );
