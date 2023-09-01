<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$wbgiUploadMsg = '';
$wbg_api_from = 'gb';
if ( isset( $_POST['saveSettings'] ) ) {
    
    if ( !isset( $_POST['wbg_api_import_nonce_field'] ) || !wp_verify_nonce( $_POST['wbg_api_import_nonce_field'], 'wbg_api_import_action' ) ) {
        print 'Sorry, your nonce did not verify.';
        exit;
    } else {
        
        if ( '' !== $_POST['wbg_api_isbn'] ) {
            $wbg_api_from = $_POST['wbg_api_from'];
            $isbns = @explode( ",", $_POST['wbg_api_isbn'] );
            if ( count( $isbns ) > 0 ) {
                foreach ( $isbns as $isbn ) {
                    $isbn = trim( $isbn );
                    if ( 'gb' === $wbg_api_from ) {
                        $url = "https://www.googleapis.com/books/v1/volumes?q=isbn:{$isbn}";
                    }
                    if ( 'ol' === $wbg_api_from ) {
                        //$url = "https://openlibrary.org/isbn/{$isbn}.json";
                        //$url = "https://openlibrary.org/api/books?bibkeys=ISBN:{$isbn}";
                        $url = "http://openlibrary.org/api/books?bibkeys=ISBN:{$isbn}&jscmd=details&format=json";
                    }
                    $call_api = wp_remote_get( $url );
                    //0689816138
                    $data = (array) json_decode( wp_remote_retrieve_body( $call_api ) );
                    //echo '<pre>';
                    //print_r( $data );
                    if ( 'gb' === $wbg_api_from ) {
                        
                        if ( isset( $data['items'] ) ) {
                            $data = (array) $data['items'][0];
                            $data = (array) $data['volumeInfo'];
                            $title = ( isset( $data['title'] ) ? sanitize_text_field( $data['title'] ) : '' );
                            $authors = ( isset( $data['authors'][0] ) ? sanitize_text_field( $data['authors'][0] ) : '' );
                            $categories = ( isset( $data['categories'][0] ) ? sanitize_text_field( $data['categories'][0] ) : '' );
                            $publisher = ( isset( $data['publisher'] ) ? sanitize_text_field( $data['publisher'] ) : '' );
                            $publishedDate = ( isset( $data['publishedDate'] ) ? sanitize_text_field( $data['publishedDate'] ) : '' );
                            $pageCount = ( isset( $data['pageCount'] ) ? sanitize_text_field( $data['pageCount'] ) : '' );
                            $imageLink = ( isset( $data['imageLinks']->thumbnail ) ? sanitize_text_field( $data['imageLinks']->thumbnail ) : '' );
                            $isbn13 = ( isset( $data['industryIdentifiers'][0]->identifier ) ? sanitize_text_field( $data['industryIdentifiers'][0]->identifier ) : '' );
                            $language = ( isset( $data['language'] ) ? sanitize_text_field( $data['language'] ) : '' );
                            $description = ( isset( $data['description'] ) ? sanitize_text_field( $data['description'] ) : '' );
                            $language = ( 'en' === $language ? 'English' : $language );
                            $publishedDate = ( 4 === strlen( $publishedDate ) ? $publishedDate . '-01-01' : $publishedDate );
                        }
                    
                    }
                    if ( 'ol' === $wbg_api_from ) {
                        //echo '<pre>';
                        //print_r( $data );
                        
                        if ( isset( $data["ISBN:{$isbn}"] ) ) {
                            $data = (array) $data["ISBN:{$isbn}"];
                            $data = (array) $data['details'];
                            $title = ( isset( $data['title'] ) ? sanitize_text_field( $data['title'] ) : '' );
                            $description = ( isset( $data['description'] ) ? sanitize_text_field( $data['description'] ) : '' );
                            $authors = ( isset( $data['authors'][0]->name ) ? sanitize_text_field( $data['authors'][0]->name ) : '' );
                            $categories = ( isset( $data['subjects'] ) ? sanitize_text_field( $data['subjects'][0] ) : '' );
                            $publisher = ( isset( $data['publishers'][0] ) ? sanitize_text_field( $data['publishers'][0] ) : '' );
                            $publishedDate = ( isset( $data['publish_date'] ) ? sanitize_text_field( $data['publish_date'] ) : '' );
                            $pageCount = ( isset( $data['number_of_pages'] ) ? sanitize_text_field( $data['number_of_pages'] ) : '' );
                            $imageLink = sanitize_url( "http://covers.openlibrary.org/b/isbn/{$isbn}-M.jpg" );
                            $isbn13 = ( isset( $data['isbn_13'][0] ) ? sanitize_text_field( $data['isbn_13'][0] ) : '' );
                            $language = ( isset( $data['languages'][0]->key ) ? sanitize_text_field( $data['languages'][0]->key ) : '' );
                            $language = ( '/languages/eng' === $language ? 'English' : $language );
                            $publishedDate = ( 4 === strlen( $publishedDate ) ? $publishedDate . '-01-01' : date( 'Y-m-d', strtotime( $publishedDate ) ) );
                            /*
                            echo "Title = " . $title . '<br>';
                            echo "Authors = " . $authors . '<br>'; //@implode(",", $data['authors']) . '<br>';
                            echo "Categories = " . $categories . '<br>';
                            echo "Publisher = " . $publisher . '<br>';
                            echo "Published Date = " . $publishedDate . '<br>';
                            echo "Pages = " . $pageCount . '<br>';    
                            echo "Images = " . $imageLink . '<br>';   
                            echo "ISBN-13 = " . $isbn13 . '<br>';    
                            echo "Language = " . $language . '<br>';  
                            echo "Description = " . $description . '<br>';
                            */
                        }
                    
                    }
                    
                    if ( '' !== $title ) {
                        $post_arr = array(
                            'post_type'    => 'books',
                            'post_title'   => $title,
                            'post_content' => $description,
                            'post_status'  => 'publish',
                            'post_author'  => get_current_user_id(),
                            'meta_input'   => array(
                            'wbg_status'         => 'active',
                            'wbg_author'         => $authors,
                            'wbg_publisher'      => $publisher,
                            'wbg_published_on'   => $publishedDate,
                            'wbg_isbn'           => $isbn,
                            'wbg_pages'          => $pageCount,
                            'wbg_country'        => '',
                            'wbg_language'       => $language,
                            'wbg_dimension'      => '',
                            'wbg_filesize'       => '',
                            'wbg_download_link'  => '',
                            'wbgp_buy_link'      => '',
                            'wbg_co_publisher'   => '',
                            'wbg_isbn_13'        => $isbn13,
                            'wbgp_regular_price' => '',
                            'wbgp_sale_price'    => '',
                            'wbg_item_weight'    => '',
                            'wbgp_img_url'       => $imageLink,
                        ),
                        );
                        $post_exists = post_exists(
                            $title,
                            '',
                            '',
                            'books'
                        );
                        
                        if ( !$post_exists ) {
                            $post_id = wp_insert_post( $post_arr );
                            
                            if ( !is_wp_error( $post_id ) ) {
                                wp_set_object_terms( $post_id, [ $categories ], 'book_category' );
                                $wbgiUploadMsg = __( 'Books Imported Successfully', 'wp-books-gallery' );
                            } else {
                                $wbgiUploadMsg = $post_id->get_error_message();
                            }
                        
                        } else {
                            $wbgiUploadMsg = __( 'Books Already Imported!', 'wp-books-gallery' );
                        }
                    
                    } else {
                        $wbgiUploadMsg = __( "ISBN {$isbn} not found!", 'wp-books-gallery' );
                    }
                
                }
            }
        } else {
            $wbgiUploadMsg = __( 'No ISBN Provided!', 'wp-books-gallery' );
        }
    
    }

}
?>
<div id="wph-wrap-all" class="wrap wbg-settings-page">

    <div class="settings-banner">
        <h2><i class="fa fa-download" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Import Books From API', 'wp-books-gallery' );
?></h2>
    </div>

    <?php 
if ( $wbgiUploadMsg ) {
    $this->wbg_display_notification( 'info', $wbgiUploadMsg );
}
?>
    <br>
    <div class="wbg-wrap">

        <div class="wbg_personal_wrap wbg_personal_help" style="width: 75%; float: left;">
        
            <form name="wbg_api_import_form" role="form" class="form-horizontal" method="post" action="" id="wbg-api-import-form">
            <?php 
wp_nonce_field( 'wbg_api_import_action', 'wbg_api_import_nonce_field' );
?>
            <table class="wbg-general-settings-table">
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Import From', 'wp-books-gallery' );
?></label>
                    </th>
                    <td colspan="3">
                        <input type="radio" name="wbg_api_from" id="wbg_api_from_ol" value="ol" <?php 
echo  ( 'gb' !== $wbg_api_from ? 'checked' : '' ) ;
?>>
                        <label for="wbg_api_from_ol"><span></span><?php 
_e( 'Open Library', 'wp-books-gallery' );
?></label>
                        &nbsp;&nbsp;
                        <input type="radio" name="wbg_api_from" id="wbg_api_from_gb" value="gb" <?php 
echo  ( 'gb' === $wbg_api_from ? 'checked' : '' ) ;
?>>
                        <label for="wbg_api_from_gb"><span></span><?php 
_e( 'Google Books', 'wp-books-gallery' );
?></label>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label><?php 
_e( 'Provide Your ISBN', 'wp-books-gallery' );
?>:</label>
                    </th>
                    <td>
                    <?php 
?>
                            <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>' ;
?></span>
                            <?php 
?>
                    </td>
                </tr>
            </table>
            <p class="submit"><input type="submit" id="saveSettings" name="saveSettings"
                    class="button button-primary wbg-button" value="<?php 
_e( 'Import Books', 'wp-books-gallery' );
?>"></p>
            </form>

        </div>

        <?php 
include_once 'partial/admin-sidebar.php';
?> 

    </div>

</div>