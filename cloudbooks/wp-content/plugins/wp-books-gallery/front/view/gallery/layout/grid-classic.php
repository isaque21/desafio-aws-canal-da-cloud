<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="wbg-item" style="box-shadow: none;">
    <?php 
// Book cover and title started

if ( !$wbg_display_details_page ) {
    ?>
    <a class="wgb-item-link" href="<?php 
    echo  esc_url( get_the_permalink( $post->ID ) ) ;
    ?>" <?php 
    esc_attr_e( $wbg_details_is_external );
    ?>>
        <?php 
    echo  $feat_image ;
    ?>
    </a>
    <?php 
} else {
    echo  $feat_image ;
}

// Book cover and title ended
?>

    <?php 
?>

    <?php 
?>

    <div class="wbg-button-container">
        <?php 

if ( $wbg_display_buynow ) {
    $wbgLink = get_post_meta( $post->ID, 'wbg_download_link', true );
    if ( $wbgLink !== '' ) {
        
        if ( $wbg_buynow_btn_txt !== '' ) {
            if ( $wbg_download_when_logged_in ) {
                
                if ( is_user_logged_in() ) {
                    ?>
                    <a href="<?php 
                    echo  esc_url( $wbgLink ) ;
                    ?>" class="button wbg-btn" <?php 
                    esc_attr_e( $wbg_dwnld_btn_url_same_tab );
                    ?>>
                    <i class="fa-solid fa-download"></i>&nbsp;<?php 
                    esc_html_e( $wbg_buynow_btn_txt );
                    ?>
                    </a>
                    <?php 
                }
            
            }
            
            if ( !$wbg_download_when_logged_in ) {
                ?>
                <a href="<?php 
                echo  esc_url( $wbgLink ) ;
                ?>" class="button wbg-btn" <?php 
                esc_attr_e( $wbg_dwnld_btn_url_same_tab );
                ?>>
                    <i class="fa-solid fa-download"></i>&nbsp;<?php 
                esc_html_e( $wbg_buynow_btn_txt );
                ?>
                </a>
                <?php 
            }
        
        }
    
    }
}

?>
    </div>
</div>