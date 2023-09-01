<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$wbgFormat          = wp_get_post_terms( $post->ID, 'book_format', array('fields' => 'all') );
$wbgSeries          = wp_get_post_terms( $post->ID, 'book_series', array('fields' => 'all') );
$wbgCategory        = wp_get_post_terms( $post->ID, 'book_category', array('fields' => 'all') );
$reading_ages       = wp_get_post_terms( $post->ID, 'reading_age', array('fields' => 'all') );
$grade_levels       = wp_get_post_terms( $post->ID, 'grade_level', array('fields' => 'all') );
$wbgImgUrl          = get_post_meta( $post->ID, 'wbgp_img_url', true );
$wbg_sub_title      = get_post_meta( $post->ID, 'wbg_sub_title', true );
$wbgAuthor          = get_post_meta( $post->ID, 'wbg_author', true );
$wbgPublisher       = get_post_meta( $post->ID, 'wbg_publisher', true );
$wbg_co_publisher   = get_post_meta( $post->ID, 'wbg_co_publisher', true );
$wbgPublished       = get_post_meta( $post->ID, 'wbg_published_on', true );
$wbgIsbn            = get_post_meta( $post->ID, 'wbg_isbn', true );
$wbg_isbn_13        = get_post_meta( $post->ID, 'wbg_isbn_13', true );
$wbg_asin    	    = get_post_meta( $post->ID, 'wbg_asin', true );
$wbgPages           = get_post_meta( $post->ID, 'wbg_pages', true );
$wbgCountry         = get_post_meta( $post->ID, 'wbg_country', true );
$wbgLanguage        = get_post_meta( $post->ID, 'wbg_language', true );
$wbgDimension       = get_post_meta( $post->ID, 'wbg_dimension', true );
$wbgFilesize        = get_post_meta( $post->ID, 'wbg_filesize', true );
$wbgLink            = get_post_meta( $post->ID, 'wbg_download_link', true );
$wbg_item_weight    = get_post_meta( $post->ID, 'wbg_item_weight', true );
$wbg_edition        = get_post_meta( $post->ID, 'wbg_edition', true );
$wbg_illustrator    = get_post_meta( $post->ID, 'wbg_illustrator', true );
$wbg_translator     = get_post_meta( $post->ID, 'wbg_translator', true );

$wbg_img = ( '' !== $wbg_default_book_cover_url ) ? $wbg_default_book_cover_url : WBG_ASSETS . 'img/noimage.jpg';

if ( 'f' === $wbg_book_cover_priority ) {
    if ( has_post_thumbnail() ) {
        $wbg_img = get_the_post_thumbnail_url($post->ID,'full');
    } else {
        if ( $wbgImgUrl ) {
            $wbg_img = $wbgImgUrl;
        }
    }
} else {
    if ( $wbgImgUrl ) {
        $wbg_img = $wbgImgUrl;
    } else {
        if ( has_post_thumbnail() ) {
            $wbg_img = get_the_post_thumbnail_url($post->ID, 'full');
        }
    }
}
?>
<div class="wbg-details-image">
    <img src="<?php echo esc_url( $wbg_img ); ?>" alt="<?php _e( 'No Image Available', WBG_TXT_DOMAIN ); ?>">
</div>

<!-- Details Section Started -->
<div class="wbg-details-summary">