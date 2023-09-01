<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/*
Template Name: Wbg Books Single
Template Post Type: books
*/
get_header();
// loading header
include 'single/header.php';
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        ?>
    <div id="post-<?php 
        the_ID();
        ?>" <?php 
        post_class( 'wbg-book-single-section clearfix' );
        ?>>

        <div class="wbg-details-column wbg-details-wrapper">
            <?php 
        include 'single/before-title.php';
        ?>
                <h1 class="wbg-details-book-title"><?php 
        the_title();
        ?></h1>
                <?php 
        include 'single/before-tags.php';
        $wbgPostTags = get_the_tags();
        $wbgTagsSeparator = ' |';
        $wgbOutput = '';
        
        if ( !empty($wbgPostTags) ) {
            $wgbOutput .= "<span><b><i class='fa-solid fa-tags'></i>&nbsp;" . __( 'Tags', WBG_TXT_DOMAIN ) . ":</b>";
            foreach ( $wbgPostTags as $tag ) {
                $wgbOutput .= '&nbsp;<a href="' . get_tag_link( $tag->term_id ) . '" class="wbg-single-link">' . $tag->name . '</a>' . $wbgTagsSeparator;
            }
            $wgbOutput .= '</span>';
            echo  trim( $wgbOutput, $wbgTagsSeparator ) ;
        }
        
        ?>
                <span class="wbg-single-button-container">
                    <?php 
        // Download Button
        if ( !$wbg_display_download_button ) {
            if ( !empty($wbgLink) ) {
                
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
                        
                        /*
                        else {
                        ?>
                        <a href="<?php echo esc_url( '#' ); ?>" class="button wbg-btn"><?php _e('Login to Download', WBG_TXT_DOMAIN); ?></a>
                        <?php
                        }
                        */
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
                </span>

            </div>
            
            <div class="wbg-details-description">
                <?php 
        // Description
        if ( $wbg_display_description ) {
            
            if ( !empty(get_the_content()) ) {
                ?>
                        <div class="wbg-details-description-title">
                            <b><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_description_label );
                ?>:</b>
                            <hr>
                        </div>
                        <div class="wbg-details-description-content">
                            <?php 
                the_content();
                ?>
                        </div>
                        <?php 
            }
        
        }
        // Back Button
        
        if ( !$wbg_hide_back_button ) {
            
            if ( '' !== $wbg_gallery_page_slug ) {
                ?>
                        <a href="<?php 
                echo  esc_url( home_url( '/' . $wbg_gallery_page_slug ) ) ;
                ?>" class="button wbg-btn-back">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_back_button_label );
                ?>
                        </a>
                        <?php 
            }
            
            
            if ( '' === $wbg_gallery_page_slug ) {
                ?>
                        <a href="#" onclick="javascript:history.back();" class="button wbg-btn-back">
                            <i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;<?php 
                esc_html_e( $wbg_back_button_label );
                ?>
                        </a>
                        <?php 
            }
        
        }
        
        ?>
            </div>
            
            <?php 
        //echo do_shortcode('[WPCR_SHOW POSTID="' . $post->ID . '" NUM="10"]');
        ?>
        </div>
        <?php 
        // Sidebar
        
        if ( $wbg_display_sidebar ) {
            ?>
            <div class="wbg-details-column wbg-sidebar-right">
                <?php 
            
            if ( function_exists( 'register_sidebar' ) ) {
                //$wbg_sidebar = reset($wp_registered_sidebars);
                dynamic_sidebar( 'Books Gallery Sidebar' );
                //echo '<pre>';
                //echo key( $wp_registered_sidebars );
            }
            
            ?>
            </div>
            <?php 
        }
        
        ?>

    </div>

    <?php 
    }
}
//if ( have_posts() ) { while ( have_posts() )
// Action After Main Wrapper
do_action( 'wbg_front_single_parent_section_after' );
get_footer();