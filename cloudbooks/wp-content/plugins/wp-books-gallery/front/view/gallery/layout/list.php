<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<div class="wbg-item-list-wrapper">
    <div class="wbg-item-list-img">
        <?php 
echo  $feat_image ;
?>
    </div>
    <div class="wbg-item-list-detials">
        <div class="wbg-title">
            <?php 

if ( !$wbg_display_details_page ) {
    ?>
            <a class="wgb-item-link" href="<?php 
    echo  esc_url( get_the_permalink( $post->ID ) ) ;
    ?>" <?php 
    esc_attr_e( $wbg_details_is_external );
    ?>>
                <?php 
    echo  wp_trim_words( get_the_title(), $wbg_title_length, '...' ) ;
    ?>
            </a>
            <?php 
} else {
    ?>
            <h3 class="wgb-item-link" data-post_id="<?php 
    esc_attr_e( $post->ID );
    ?>"><?php 
    echo  wp_trim_words( get_the_title(), $wbg_title_length, '...' ) ;
    ?></h3>
            <?php 
}

?>
        </div>

        <div class="wbg-rating">
            <?php 
?>
        </div>
        <?php 
do_action( 'wbg_front_list_load_price' );
// Display Author

if ( $wbg_display_author ) {
    $wbgAuthor = get_post_meta( $post->ID, 'wbg_author', true );
    
    if ( '' !== $wbgAuthor ) {
        ?>
                <span class="loop-author">
                    <?php 
        echo  esc_html( $wbg_author_label_txt ) . '&nbsp;' . esc_html( $wbgAuthor ) ;
        ?>
                </span>
                <?php 
    }

}

// Display Category

if ( $wbg_display_category ) {
    $wbgCategory = wp_get_post_terms( $post->ID, 'book_category', array(
        'fields' => 'all',
    ) );
    
    if ( !empty($wbgCategory) ) {
        ?>
                <span class="loop-category">
                    <?php 
        echo  esc_html( $wbg_cat_label_txt ) ;
        ?>
                    <?php 
        $wbgCatArray = array();
        foreach ( $wbgCategory as $cat ) {
            $wbgCatArray[] = $cat->name . '';
        }
        echo  implode( ', ', $wbgCatArray ) ;
        ?>
                </span>
                <?php 
    }

}

// Display Description
if ( $wbg_display_description ) {
    
    if ( !empty(get_the_content()) ) {
        ?>
                <div class="wbg-description-content">
                    <?php 
        echo  wp_trim_words( get_the_content(), $wbg_description_length, '...' ) ;
        ?>
                </div>
                <?php 
    }

}
?>
        <div class="wbg-button-container-loop">
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
</div>