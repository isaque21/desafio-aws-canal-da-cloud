<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// loading header
include 'single/header.php';
$post = get_post( $post_id );
?>
<style type="text/css">
    <?php 
?>
</style>
<div class="wbg-book-single-section clearfix modal">
    <div class="wbg-details-column wbg-details-wrapper" style="width: 100%; padding: 20px;">
        <?php 
include 'single/before-title.php';
?>
            <h1 class="wbg-details-book-title"><?php 
echo  $post->post_title ;
?></h1>
            <?php 
include 'single/before-tags.php';
$wbgPostTags = get_the_tags( $post_id );
$wbgTagsSeparator = ' | ';
$wgbOutput = '';

if ( !empty($wbgPostTags) ) {
    $wgbOutput .= "<span><b><i class='fa-solid fa-tags'></i>&nbsp;" . __( 'Tags', WBG_TXT_DOMAIN ) . ":</b>";
    foreach ( $wbgPostTags as $tag ) {
        $wgbOutput .= '<a href="' . get_tag_link( $tag->term_id ) . '" class="wbg-single-link">' . $tag->name . '</a>' . $wbgTagsSeparator;
    }
    $wgbOutput .= '</span>';
    echo  trim( $wgbOutput, $wbgTagsSeparator ) ;
}

?>
        </div>
        <div class="wbg-details-description">
            <?php 
if ( $wbg_display_description ) {
    
    if ( !empty($post->post_content) ) {
        ?>
                    <div class="wbg-details-description-title">
                        <b><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;<?php 
        esc_html_e( $wbg_description_label );
        ?>:</b>
                        <hr>
                    </div>
                    <div class="wbg-details-description-content">
                        <?php 
        echo  $post->post_content ;
        ?>
                    </div>
                    <?php 
    }

}
?>
        </div>
    </div>
</div>