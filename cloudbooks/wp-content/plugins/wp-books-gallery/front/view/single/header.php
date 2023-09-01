<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Action Before Main Wrapper
do_action( 'wbg_front_single_parent_section_before' );

require_once WBG_PATH . 'front/' . WBG_CLS_PRFX . 'front.php';
$wbg_front_new = new WBG_Front(WBG_VERSION);

// Gallery Settings Content
$wpsdGallerySettingsContent = $wbg_front_new->wbg_get_gallery_settings_content();
//print_r( $wpsdGallerySettingsContent );
foreach ( $wpsdGallerySettingsContent as $gscKey => $gscValue ) {
    if ( isset( $wpsdGallerySettingsContent[$gscKey] ) ) {
        ${"" . $gscKey}  = $gscValue;
    }
}

// General Settings
$wbgCoreSettings = $wbg_front_new->wbg_get_core_settings();

foreach ( $wbgCoreSettings as $core_name => $core_value ) {
    if ( isset( $wbgCoreSettings[$core_name] ) ) {
        ${"" . $core_name} = $core_value;
    }
}

$wbgpCurrencySymbol =  $wbg_front_new->wbg_get_currency_symbol( $wbgp_currency );

// Gallery Settings Styling
$wbgGeneralStyling              = get_option('wbg_general_styles');
$wbg_download_btn_color         = isset( $wbgGeneralStyling['wbg_download_btn_color'] ) ? $wbgGeneralStyling['wbg_download_btn_color'] : '#0274be';
$wbg_download_btn_font_color    = isset( $wbgGeneralStyling['wbg_download_btn_font_color'] ) ? $wbgGeneralStyling['wbg_download_btn_font_color'] : '#FFFFFF';
$wbg_download_btn_color_hvr         = isset( $wbgGeneralStyling['wbg_download_btn_color_hvr'] ) ? $wbgGeneralStyling['wbg_download_btn_color_hvr'] : '#0274be';
$wbg_download_btn_font_color_hvr    = isset( $wbgGeneralStyling['wbg_download_btn_font_color_hvr'] ) ? $wbgGeneralStyling['wbg_download_btn_font_color_hvr'] : '#FFFFFF';

// Detail Content Settings
$wbgDetailsContent = $wbg_front_new->wbg_get_single_content_settings();
//print_r( $wbgDetailsContent );
foreach ( $wbgDetailsContent as $dc_name => $dc_value ) {
    if ( isset( $wbgDetailsContent[$dc_name] ) ) {
        ${"" . $dc_name} = $dc_value;
    }
}

// Single Style Settings
$wbgSingleStyles = $wbg_front_new->wbg_get_single_styles_settings();
//print_r( $wbgSingleStyles );
foreach ( $wbgSingleStyles as $ss_name => $ss_value ) {
    if ( isset( $wbgSingleStyles[$ss_name] ) ) {
        ${"" . $ss_name} = $ss_value;
    }
}

// General Settings
$wbg_gallery_page_slug  = ( '' != $wbg_gallery_page_slug ) ? $wbg_gallery_page_slug : 'books';
$wbg_dwnld_btn_url_same_tab = ( ! $wbg_dwnld_btn_url_same_tab ) ? 'target="_blank"' : '';

$wbg_detail_settings = get_option('wbg_detail_settings');

if ( empty( $wbg_detail_settings )) {
	$wbg_author_info = 1;
	$wbg_display_category = 1;
	$wbg_display_publisher = 1;
	$wbg_display_publish_date = 1;
	$wbg_display_isbn = 1;
	$wbg_display_description = 1;
}

// Load Styling
include WBG_PATH . 'assets/css/single.php';
?>