<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wpsdGallerySettingsContent );
foreach ( $wpsdGallerySettingsContent as $option_name => $option_value ) {
    if ( isset( $wpsdGallerySettingsContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wbg_general_settings_form" role="form" class="form-horizontal" method="post" action="" id="wbg-general-settings-form">
    <?php 
wp_nonce_field( 'wbg_gallery_c_action', 'wbg_gallery_c_nonce_field' );
?>
    <table class="wbg-gallery-conent-settings-table">
        <!-- Gallery Template -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Gallery Template', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <select name="wbg_gallary_template" class="medium-text">
                    <option value="grid" <?php 
echo  ( 'grid' == $wbg_gallary_template ? 'selected' : '' ) ;
?> ><?php 
_e( 'Grid', 'wp-books-gallery' );
?></option>
                    <option value="list" <?php 
echo  ( 'list' == $wbg_gallary_template ? 'selected' : '' ) ;
?> ><?php 
_e( 'List', 'wp-books-gallery' );
?></option>
                    <option value="grid-classic" <?php 
echo  ( 'grid-classic' == $wbg_gallary_template ? 'selected' : '' ) ;
?> ><?php 
_e( 'Grid Classic', 'wp-books-gallery' );
?></option>
                </select>
            </td>
            <th scope="row">
                <label for="wbg_gallary_column"><?php 
_e( 'Gallery Columns', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <label for="wbg_gallary_column_mobile"><?php 
_e( 'Desktop', 'wp-books-gallery' );
?>:</label>
                <select name="wbg_gallary_column" class="medium-text">
                    <?php 
for ( $dc = 1 ;  $dc < 6 ;  $dc++ ) {
    ?>
                        <option value="<?php 
    esc_attr_e( $dc );
    ?>" <?php 
    echo  ( $dc == $wbg_gallary_column ? 'selected' : '' ) ;
    ?> ><?php 
    printf( '%d', $dc );
    ?></option>
                        <?php 
}
?>
                </select>
                &nbsp;&nbsp;&nbsp;
                <label for="wbg_gallary_column_mobile"><?php 
_e( 'Mobile', 'wp-books-gallery' );
?>:</label>
                <select name="wbg_gallary_column_mobile" class="medium-text">
                    <option value="1" <?php 
echo  ( '1' == $wbg_gallary_column_mobile ? 'selected' : '' ) ;
?> ><?php 
_e( '1', 'wp-books-gallery' );
?></option>
                    <option value="2" <?php 
echo  ( '2' == $wbg_gallary_column_mobile ? 'selected' : '' ) ;
?> ><?php 
_e( '2', 'wp-books-gallery' );
?></option>
                </select>
            </td>
        </tr>
        <!-- Image Size -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Image Size', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <select name="wbg_book_cover_size" class="medium-text">
                    <option value="default" <?php 
echo  ( 'default' == $wbg_book_cover_size ? 'selected' : '' ) ;
?>><?php 
_e( 'Default - 200 x 0', 'wp-books-gallery' );
?></option>
                    <option value="thumbnail" <?php 
echo  ( 'thumbnail' == $wbg_book_cover_size ? 'selected' : '' ) ;
?>><?php 
_e( 'Thumbnail - 150 x 150', 'wp-books-gallery' );
?></option>
                    <option value="medium" <?php 
echo  ( 'medium' == $wbg_book_cover_size ? 'selected' : '' ) ;
?>><?php 
_e( 'Medium - 300 x 300', 'wp-books-gallery' );
?></option>
                    <option value="full" <?php 
echo  ( 'full' == $wbg_book_cover_size ? 'selected' : '' ) ;
?>><?php 
_e( 'Full - 500 x 0', 'wp-books-gallery' );
?></option>
                </select>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Image Animation', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <select name="wbg_book_image_animation" class="medium-text">
                    <option value=""><?php 
_e( 'None', 'wp-books-gallery' );
?></option>
                    <option value="rotate-360" <?php 
echo  ( 'rotate-360' === $wbg_book_image_animation ? 'selected' : '' ) ;
?> ><?php 
_e( 'Rotate 360', 'wp-books-gallery' );
?></option>
                    <?php 
?>
                </select>
            </td>
        </tr>
        <!-- Books Sorting By -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Books Sorting By', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <select name="wbg_gallary_sorting" class="medium-text">
                    <option value="">--<?php 
_e( 'Select One', 'wp-books-gallery' );
?>--</option>
                    <option value="title" <?php 
echo  ( 'title' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Name', 'wp-books-gallery' );
?></option>
                    <option value="name" <?php 
echo  ( 'name' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Slug/Url', 'wp-books-gallery' );
?></option>
                    <option value="wbg_author" <?php 
echo  ( 'wbg_author' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Author', 'wp-books-gallery' );
?></option>
                    <option value="date" <?php 
echo  ( 'date' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Post Date', 'wp-books-gallery' );
?></option>
                    <option value="wbg_publisher" <?php 
echo  ( 'wbg_publisher' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Publisher', 'wp-books-gallery' );
?></option>
                    <option value="wbg_published_on" <?php 
echo  ( 'wbg_published_on' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Book Published Date', 'wp-books-gallery' );
?></option>
                    <option value="wbg_language" <?php 
echo  ( 'wbg_language' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Language', 'wp-books-gallery' );
?></option>
                    <option value="wbg_country" <?php 
echo  ( 'wbg_country' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Country', 'wp-books-gallery' );
?></option>
                    <option value="rand" <?php 
echo  ( 'rand' === $wbg_gallary_sorting ? 'selected' : '' ) ;
?> ><?php 
_e( 'Rand', 'wp-books-gallery' );
?></option>
                </select>
            </td>
            <th scope="row">
                <label for="wbg_books_order"><?php 
_e( 'Order By', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="radio" name="wbg_books_order" id="wbg_books_order_a" value="ASC" <?php 
echo  ( 'DESC' !== $wbg_books_order ? 'checked' : '' ) ;
?> >
                <label for="wbg_books_order_a"><span></span><?php 
_e( 'Ascending', 'wp-books-gallery' );
?></label>
                    &nbsp;&nbsp;
                <input type="radio" name="wbg_books_order" id="wbg_books_order_d" value="DESC" <?php 
echo  ( 'DESC' === $wbg_books_order ? 'checked' : '' ) ;
?> >
                <label for="wbg_books_order_d"><span></span><?php 
_e( 'Descending', 'wp-books-gallery' );
?></label>
            </td>
        </tr>
        <!-- Disable Book Details Page -->
        <tr>
            <th scope="row">
                <label for="wbg_display_details_page"><?php 
_e( 'Disable Book Details Page', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_details_page" id="wbg_display_details_page" value="1"
                    <?php 
echo  ( $wbg_display_details_page ? 'checked' : '' ) ;
?> >
            </td>
            <th scope="row">
                <label for="wbg_details_is_external"><?php 
_e( 'Open in New Tab', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_details_is_external" id="wbg_details_is_external" value="1"
                    <?php 
echo  ( $wbg_details_is_external ? 'checked' : '' ) ;
?> >
            </td>
        </tr>
        <tr class="wbg_title_length">
            <th scope="row">
                <label for="wbg_title_length"><?php 
_e( 'Title Word Length', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <input type="number" name="wbg_title_length" class="medium-text" min="1" max="50" step="1" value="<?php 
esc_attr_e( $wbg_title_length );
?>">
            </td>
        </tr>
        <tr class="wbg_display_category">
            <th scope="row">
                <label for="wbg_display_category"><?php 
_e( 'Display Category', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_category" class="wbg_display_category" id="wbg_display_category" value="1"
                    <?php 
echo  ( $wbg_display_category ? 'checked' : '' ) ;
?> >
            </td>
            <th scope="row">
                <label for="wbg_cat_label_txt"><?php 
_e( 'Category Label Text', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_cat_label_txt" placeholder="<?php 
_e( 'Category', 'wp-books-gallery' );
?>:" class="medium-text"
                    value="<?php 
esc_attr_e( $wbg_cat_label_txt );
?>">
            </td>
        </tr>
        <!-- Display Author -->
        <tr class="wbg_display_author">
            <th scope="row">
                <label for="wbg_display_author"><?php 
_e( 'Display Author', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_author" class="wbg_display_author" id="wbg_display_author" value="1"
                    <?php 
echo  ( $wbg_display_author ? 'checked' : '' ) ;
?> >
            </td>
            <th scope="row">
                <label for="wbg_author_label_txt"><?php 
_e( 'Author Label Text', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_author_label_txt" placeholder="<?php 
_e( 'By:', 'wp-books-gallery' );
?>" class="medium-text"
                    value="<?php 
esc_attr_e( $wbg_author_label_txt );
?>">
            </td>
        </tr>
        <!-- Edition -->
        <tr>
            <th scope="row">
                <label for="wbg_display_edition_gallery"><?php 
_e( 'Display Edition', 'wp-books-gallery' );
?>?</label>
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
            <th scope="row">
                <label><?php 
_e( 'Edition Label Text', 'wp-books-gallery' );
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
        <!-- Publish Date -->
        <tr>
            <th scope="row">
                <label for="wbg_display_publish_date_gallery"><?php 
_e( 'Display Publish Date', 'wp-books-gallery' );
?>?</label>
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
            <th scope="row">
                <label><?php 
_e( 'Publish Date Label Text', 'wp-books-gallery' );
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
        <!-- Display Description -->
        <tr class="wbg_display_description">
            <th scope="row">
                <label for="wbg_display_description"><?php 
_e( 'Display Description', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_description" class="wbg_display_description" id="wbg_display_description" value="1"
                    <?php 
echo  ( $wbg_display_description ? 'checked' : '' ) ;
?> >
            </td>
            <th scope="row">
                <label for="wbg_description_length"><?php 
_e( 'Description Word Length', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="number" name="wbg_description_length" class="medium-text" min="1" max="100" step="1" value="<?php 
esc_attr_e( $wbg_description_length );
?>">
            </td>
        </tr>
        <tr class="wbg_display_buynow">
            <th scope="row">
                <label for="wbg_display_buynow"><?php 
_e( 'Display Download Button', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_buynow" class="wbg_display_buynow" id="wbg_display_buynow" value="1"
                    <?php 
echo  ( $wbg_display_buynow ? 'checked' : '' ) ;
?> >
            </td>
            <th scope="row">
                <label for="wbg_buynow_btn_txt"><?php 
_e( 'Button Text', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_buynow_btn_txt" placeholder="<?php 
_e( 'Download', 'wp-books-gallery' );
?>" class="medium-text"
                    value="<?php 
esc_attr_e( $wbg_buynow_btn_txt );
?>">
            </td>
        </tr>
        <tr class="wbg_display_buy_now">
            <th scope="row">
                <label for="wbg_display_buy_now"><?php 
_e( 'Display Buy Now Button', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', 'wp-books-gallery' ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
            <th scope="row">
                <label for="wbg_buy_now_btn_txt"><?php 
_e( 'Button Text', 'wp-books-gallery' );
?>:</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', 'wp-books-gallery' ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr class="wbg_display_total_books">
            <th scope="row">
                <label for="wbg_display_total_books"><?php 
_e( 'Display Total Books', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_total_books" class="wbg_display_total_books" id="wbg_display_total_books" value="1"
                    <?php 
echo  ( $wbg_display_total_books ? 'checked' : '' ) ;
?> >
            </td>
            <th scope="row">
                <label for="wbg_display_sorting"><?php 
_e( 'Display Front Sorting', 'wp-books-gallery' );
?>?</label>
            </th>
            <td colspan="3">
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Books Per Page', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
$wbg_max_book = 500;
$wbg_max_book = 20;
?>
                <input type="number" min="1" max="<?php 
esc_attr_e( $wbg_max_book );
?>" step="1" name="wbg_books_per_page" class="wbg_books_per_page" value="<?php 
esc_attr_e( $wbg_books_per_page );
?>">
                    
            </td>
            <th scope="row">
                <label for="wbg_display_pagination"><?php 
_e( 'Display Pagination', 'wp-books-gallery' );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', 'wp-books-gallery' ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <!-- Currency -->
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Currency', 'wp-books-gallery' );
?>:</label>
            </th>
            <td colspan="3">
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', 'wp-books-gallery' ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <!-- Button Alignment -->
        <tr>
            <th scope="row">
                <label for="wbg_gallery_button_bottom_align"><?php 
_e( 'Button Bottom Align', 'wp-books-gallery' );
?>?</label>
            </th>
            <td colspan="3">
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <!-- Display Rating -->
        <tr>
            <th scope="row">
                <label for="wbg_display_rating"><?php 
_e( 'Display Rating', 'wp-books-gallery' );
?>?</label>
            </th>
            <td colspan="3">
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', 'wp-books-gallery' ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>

        <?php 
do_action( 'wbg_admin_general_settings_after_display_total_books' );
?>

        <tr class="wbg_shortcode">
            <th scope="row">
                <label for="wbg_shortcode"><?php 
_e( 'Shortcode:', 'wp-books-gallery' );
?></label>
            </th>
            <td colspan="3">
                <input type="text" name="wbg_shortcode" id="wbg_shortcode" class="medium-text" value="[wp_books_gallery]" readonly />
                <br>
                <code><?php 
_e( 'Copy this shortcode and apply it to any page to display books gallery.', 'wp-books-gallery' );
?></code>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateGalleryContentSettings" name="updateGalleryContentSettings" class="button button-primary wbg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', 'wp-books-gallery' );
?>
        </button>
    </p>
</form>