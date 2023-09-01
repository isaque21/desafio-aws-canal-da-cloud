<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Author
if ( $wbg_author_info ) {
    
    if ( !empty($wbgAuthor) ) {
        ?>
        <span>
            <b><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_author_label );
        ?>:</b>
            <a href="<?php 
        echo  esc_url( home_url( '/' . $wbg_gallery_page_slug . '/?wbg_author_s=' . urlencode( $wbgAuthor ) ) ) ;
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
// Category

if ( $wbg_display_category ) {
    ?>
    <span>
        <b><i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;<?php 
    esc_html_e( $wbg_category_label );
    ?>:</b>
        <?php 
    $wbgCatArray = array();
    foreach ( $wbgCategory as $cat ) {
        $wbgCatArray[] = "<a href='" . esc_url( home_url( '/book-category/' . urlencode( $cat->slug ) ) ) . "' class='wbg-single-link'>" . $cat->name . "</a>";
    }
    echo  implode( ', ', $wbgCatArray ) ;
    ?>
    </span>
    <?php 
}

// Publisher
if ( $wbg_display_publisher ) {
    
    if ( !empty($wbgPublisher) ) {
        ?>
        <span>
            <b><i class="fa fa-building" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_publisher_label );
        ?>:</b>
            <?php 
        esc_html_e( $wbgPublisher );
        ?>
        </span>
        <?php 
    }

}
// Publish Date
if ( $wbg_display_publish_date ) {
    
    if ( !empty($wbgPublished) ) {
        ?>
        <span>
            <b><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_publish_date_label );
        ?>:</b>
            <?php 
        
        if ( 'full' === $wbg_publish_date_format ) {
            //echo date('d M, Y', strtotime( $wbgPublished ) );
            echo  date_i18n( get_option( 'date_format' ), strtotime( $wbgPublished ) ) ;
        } else {
            echo  date( 'Y', strtotime( $wbgPublished ) ) ;
        }
        
        ?>
        </span>
    <?php 
    }

}
// ISBN
if ( $wbg_display_isbn ) {
    
    if ( !empty($wbgIsbn) ) {
        ?>
        <span>
            <b><i class="fa fa-barcode" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_isbn_label );
        ?>:</b>
            <?php 
        esc_html_e( $wbgIsbn );
        ?>
        </span>
        <?php 
    }

}
// Pages
if ( $wbg_display_page ) {
    
    if ( !empty($wbgPages) ) {
        ?>
    <span>
        <b><i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_page_label );
        ?>:</b>
        <?php 
        esc_html_e( $wbgPages );
        ?>
    </span>
    <?php 
    }

}
if ( $wbg_display_country ) {
    
    if ( !empty($wbgCountry) ) {
        ?>
    <span>
        <b><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_country_label );
        ?>:</b>
        <?php 
        esc_html_e( $wbgCountry );
        ?>
    </span>
    <?php 
    }

}
if ( $wbg_display_language ) {
    
    if ( !empty($wbgLanguage) ) {
        ?>
        <span>
            <b><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_language_label );
        ?>:</b>
            <?php 
        esc_html_e( $wbgLanguage );
        ?>
        </span>
        <?php 
    }

}
if ( $wbg_display_dimension ) {
    
    if ( !empty($wbgDimension) ) {
        ?>
        <span>
            <b><i class="fa fa-arrows" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_dimension_label );
        ?>:</b>
            <?php 
        esc_html_e( $wbgDimension );
        ?>
        </span>
        <?php 
    }

}
// Filesize
if ( $wbg_display_filesize ) {
    
    if ( !empty($wbgFilesize) ) {
        ?>
        <span>
            <b><i class="fa fa-file" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_filesize_label );
        ?>:</b>
            <?php 
        esc_html_e( $wbgFilesize );
        ?>
        </span>
        <?php 
    }

}
do_action( 'wbg_front_single_load_custom_fields_data' );