<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( $wbg_hide_book_cover ) {
    $feat_image = '';
    echo  '<style type="text/css">.wbg-main-wrapper .wbg-item a.wgb-item-link { min-height:40px!important; padding-top: 20px; }</style>' ;
}

?>
<div class="wbg-item">
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
            <?php 
    echo  wp_trim_words( get_the_title(), $wbg_title_length, '...' ) ;
    ?>
        </a>
        <?php 
} else {
    echo  $feat_image ;
    ?>
        <h3 class="wgb-item-link" data-post_id="<?php 
    esc_attr_e( $post->ID );
    ?>"><?php 
    echo  wp_trim_words( get_the_title(), $wbg_title_length, '...' ) ;
    ?></h3>
        <?php 
}

// Book cover and title ended
// Description
if ( '1' == $wbg_display_description ) {
    
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
// Category

if ( '1' == $wbg_display_category ) {
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
            $wbgCatArray[] = '<a href="' . esc_url( home_url( '/book-category/' . urlencode( $cat->slug ) ) ) . '" class="wbg-list-author">' . $cat->name . '</a>';
        }
        echo  implode( ', ', $wbgCatArray ) ;
        ?>
            </span>
            <?php 
    }

}

// Author

if ( $wbg_display_author ) {
    $wbgAuthor = get_post_meta( $post->ID, 'wbg_author', true );
    
    if ( '' !== $wbgAuthor ) {
        $wbg_author_term = get_term_by( 'name', $wbgAuthor, 'book_author' );
        $wbg_author_slug = ( !empty($wbg_author_term) ? $wbg_author_term->slug : '' );
        ?>
            <span class="loop-author">
                <?php 
        esc_html_e( $wbg_author_label_txt );
        ?>
                <a href="<?php 
        echo  esc_url( home_url( '/book-author/' . $wbg_author_slug ) ) ;
        ?>" class="wbg-single-link">
                    <?php 
        esc_html_e( $wbgAuthor );
        ?>
                </a>
                <?php 
        ?>
            </span>
            <?php 
    }

}

do_action( 'wbg_front_list_load_price' );
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