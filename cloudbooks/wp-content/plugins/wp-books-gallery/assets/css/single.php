<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<style type="text/css">
    .wbg-details-wrapper {
        <?php 

if ( $wbg_display_sidebar ) {
    ?>
            width: -webkit-calc(100% - 340px);
            width: -moz-calc(100% - 340px);
            width: calc(100% - 340px);
            <?php 
} else {
    ?>
            width: 100%;
            <?php 
}

?>
        min-height: 100px;
    }
    .wbg-single-subtitle {
        margin-bottom: 10px;
        font-size: 18px;
        font-style: italic;
    }
    a.wbg-single-link {
        color: #242424;
        text-decoration: none;
    }
    a.wbg-single-link:hover {
        color: #CC0000;
    }
    .wbg-details-summary span a.wbg-btn,
    a.wbg-btn-back {
        display: inline-block;
    }
    .wbg-details-summary span a.wbg-btn:hover {
        background: <?php 
esc_attr_e( $wbg_download_btn_color_hvr );
?> !important;
        color: <?php 
esc_attr_e( $wbg_download_btn_font_color_hvr );
?> !important;
    }
    .wbg-details-wrapper .wbg-details-summary span b .fa,
    .wbg-details-wrapper .wbg-details-summary span b .fa-solid {
        width: 25px;
        text-align: center;
    }
    <?php 
?>

    @media only screen and (max-width: 1024px) and (min-width: 768px) {
        .wbg-details-wrapper {
            width: 100%;
            float: none;
            padding-right: 0;
        }
    }

    @media only screen and (max-width: 767px) {
        .wbg-details-wrapper {
            width: 100%;
            float: none;
            padding-right: 0;
        }
        .wbg-sidebar-right {
            display: block;
            width: 300px;
            margin: 0 auto;
        }
    }

</style>