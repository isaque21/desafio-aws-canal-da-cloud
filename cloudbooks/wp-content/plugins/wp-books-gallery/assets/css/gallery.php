<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<style type="text/css">
  <?php 
?>
  .wbg-parent-wrapper {
    background: <?php 
esc_html_e( $wbg_container_bg_color );
?>;
    border: 1px solid <?php 
esc_html_e( $wbg_container_border_color );
?>;
    max-width: <?php 
echo  esc_html( $wbg_container_width ) . esc_html( $wbg_container_width_type ) ;
?>;
    margin-top: <?php 
esc_html_e( $wbg_container_margin_top );
?>px;
    margin-bottom: <?php 
esc_html_e( $wbg_container_margin_bottom );
?>px;
    padding: <?php 
esc_html_e( $wbg_loop_container_padding );
?>px;
    border-radius: <?php 
esc_html_e( $wbg_loop_container_radius );
?>px;
  }
  /* Search Panel */
  .wbg-search-container {
    background: <?php 
esc_html_e( $wbg_search_panel_bg_color );
?>;
    border: <?php 
esc_html_e( $wbg_search_panel_border_width );
?>px solid <?php 
esc_html_e( $wbg_search_panel_border_color );
?>;
    border-radius: <?php 
esc_html_e( $wbg_search_panel_border_radius );
?>px;
  }
  /* Search Input */
  .wbg-search-container .wbg-search-item input[type="text"],
  .selectize-control.single .selectize-input {
    background-color: <?php 
esc_html_e( $wbg_search_panel_input_bg_color );
?>;
  }
  /* Search Button */
  .wbg-search-container .wbg-search-item .submit-btn {
    background: <?php 
echo  esc_html( $wbg_btn_color ) ;
?>;
    border: 1px solid <?php 
echo  esc_html( $wbg_btn_border_color ) ;
?>;
    color: <?php 
echo  esc_html( $wbg_btn_font_color ) ;
?>;
  }
  .wbg-search-container .wbg-search-item .submit-btn:hover {
    background: <?php 
echo  esc_html( $wbg_search_btn_bg_color_hover ) ;
?>;
    color: <?php 
echo  esc_html( $wbg_search_font_color_hover ) ;
?>;
  }
  /* Search Reset Button */
  .wbg-search-container .wbg-search-item a#wbg-search-refresh {
    background: <?php 
echo  esc_html( $wbg_search_reset_bg_color ) ;
?>;
    border: 1px solid <?php 
echo  esc_html( $wbg_search_reset_border_color ) ;
?>;
    color: <?php 
echo  esc_html( $wbg_search_reset_font_color ) ;
?>;
  }
  .wbg-main-wrapper .wbg-item {
    border: 1px solid <?php 
esc_html_e( $wbg_loop_book_border_color );
?>;
    background-color: <?php 
esc_html_e( $wbg_loop_book_bg_color );
?>;
    white-space: normal;
    padding-top: 10px;
    padding-right: 10px;
    padding-left: 10px;
  }
  /*
  .wbg-main-wrapper .wbg-item img {
    width: <?php 
//echo ( 'full' === $wbg_book_cover_width ) ? '100%' : 'auto';
?>;
    height: <?php 
//echo ( 'full' === $wbg_book_cover_width ) ? 'auto' : '150px';
?>;
  }
  */
  .wbg-main-wrapper .wbg-item img:hover {
    <?php 
if ( 'rotate-360' === $wbg_book_image_animation ) {
    ?>
      -webkit-animation: rotation 0.8s  linear;
      <?php 
}
if ( 'flip' === $wbg_book_image_animation ) {
    ?>
      -webkit-transform: scaleX(-1);
      transform: scaleX(-1);
      <?php 
}
?>
  }
  .wbg-main-wrapper .wbg-item a.wbg-btn {
    background: <?php 
esc_html_e( $wbg_download_btn_color );
?>;
    color: <?php 
esc_html_e( $wbg_download_btn_font_color );
?>;
    font-size: <?php 
esc_html_e( $wbg_download_btn_font_size );
?>px;
  }
  .wbg-main-wrapper .wbg-item a.wbg-btn:hover {
    background: <?php 
esc_html_e( $wbg_download_btn_color_hvr );
?>;
    color: <?php 
esc_html_e( $wbg_download_btn_font_color_hvr );
?>;
  }
  .wbg-main-wrapper .wbg-item .wgb-item-link {
    color: <?php 
esc_html_e( $wbg_title_color );
?> !important;
    font-size: <?php 
esc_html_e( $wbg_title_font_size );
?>px !important;
  }
  .wbg-main-wrapper .wbg-item .wgb-item-link:hover {
    color: <?php 
esc_html_e( $wbg_title_hover_color );
?> !important;
  }
  .wbg-main-wrapper .wbg-item .wbg-description-content {
    font-size: <?php 
esc_html_e( $wbg_description_font_size );
?>px !important;
    color: <?php 
esc_html_e( $wbg_description_color );
?> !important;
  }
  <?php 
?>

  @-webkit-keyframes rotation {
    from {
      -webkit-transform: rotate(0deg);
    }
    to {
      -webkit-transform: rotate(360deg);
    }
  }

  /* List style */
  .wbg-main-wrapper.list .wbg-item-list-wrapper {
      border-bottom: 1px solid <?php 
esc_html_e( $wbg_loop_book_border_color );
?>;
      background-color: <?php 
esc_html_e( $wbg_loop_book_bg_color );
?>;
      white-space: normal;
  }
  .wbg-main-wrapper.list .wbg-item-list-wrapper .wbg-item-list-detials .wbg-title h3.wgb-item-link,
  .wbg-main-wrapper.list .wbg-item-list-wrapper .wbg-item-list-detials .wbg-title a.wgb-item-link {
      color: <?php 
esc_html_e( $wbg_title_color );
?> !important;
      font-size: <?php 
esc_html_e( $wbg_title_font_size );
?>px !important;
  }
  .wbg-main-wrapper.list .wbg-item-list-wrapper .wbg-item-list-detials .wbg-title h3.wgb-item-link:hover,
  .wbg-main-wrapper.list .wbg-item-list-wrapper .wbg-item-list-detials .wbg-title a.wgb-item-link:hover {
      color: <?php 
esc_html_e( $wbg_title_hover_color );
?> !important;
  }
  .wbg-main-wrapper.list .wbg-item-list-wrapper .wbg-item-list-detials .regular-price .wbgp-price {
    font-size: <?php 
esc_html_e( $wbg_price_font_size );
?>px;
  }
  .wbg-main-wrapper.list .wbg-item-list-wrapper .wbg-item-list-detials .regular-price .wbgp-price.price-after {
      color: <?php 
esc_attr_e( $wbg_rprice_font_color );
?>;
  }
  .wbg-main-wrapper.list .wbg-item-list-wrapper .wbg-item-list-detials .regular-price .wbgp-price.price-before {
      color: <?php 
esc_attr_e( $wbg_dprice_font_color );
?>;
  }
  .wbg-main-wrapper.list .wbg-item-list-wrapper .wbg-item-list-detials span.loop-author {
    color: <?php 
esc_attr_e( $wbg_loop_author_font_color );
?>;
    font-size: <?php 
esc_html_e( $wbg_loop_author_font_size );
?>px !important;
  }
  .wbg-main-wrapper.list .wbg-item-list-wrapper .wbg-item-list-detials span.loop-category {
    color: <?php 
esc_attr_e( $wbg_loop_cat_font_color );
?>;
    font-size: <?php 
esc_html_e( $wbg_loop_cat_font_size );
?>px !important;
  }
  .wbg-main-wrapper.list .wbg-item-list-wrapper .wbg-item-list-detials .wbg-description-content {
      font-size: <?php 
esc_html_e( $wbg_description_font_size );
?>px !important;
      color: <?php 
esc_html_e( $wbg_description_color );
?> !important;
  }
  .wbg-main-wrapper .wbg-item-list-wrapper a.wbg-btn {
      background: <?php 
esc_html_e( $wbg_download_btn_color );
?>;
      color: <?php 
esc_html_e( $wbg_download_btn_font_color );
?>;
      font-size: <?php 
esc_html_e( $wbg_download_btn_font_size );
?>px;
  }
  .wbg-main-wrapper .wbg-item-list-wrapper a.wbg-btn:hover {
      background: <?php 
esc_html_e( $wbg_download_btn_color_hvr );
?>;
      color: <?php 
esc_html_e( $wbg_download_btn_font_color_hvr );
?>;
  }
</style>