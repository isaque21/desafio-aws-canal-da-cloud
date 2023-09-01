<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wbgDetailsContent );
foreach ( $wbgDetailsContent as $option_name => $option_value ) {
    if ( isset( $wbgDetailsContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wbg_detail_settings_form" role="form" class="form-horizontal" method="post" action="" id="wbg-detail-settings-form">
<?php 
wp_nonce_field( 'wbg_detail_content_action', 'wbg_detail_content_nonce_field' );
?>
    <table class="wbg-details-settings-table">
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_subtitle"><?php 
_e( 'Display Sub-Title', WBG_TXT_DOMAIN );
?></label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Upgrade to Professional!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="6" style="text-align:left;">
                <hr><span>&nbsp;<?php 
_e( 'Book Information', WBG_TXT_DOMAIN );
?>&nbsp;</span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_format"><?php 
_e( 'Display Format', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Format Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_series"><?php 
_e( 'Display Series', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Series Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_reading_age"><?php 
_e( 'Display Reading Age', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Reading Age Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_grade_level"><?php 
_e( 'Display Grade Level', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Grade Level Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <?php 
?>
                    <span><?php 
echo  '<a href="' . wbg_fs()->get_upgrade_url() . '">' . __( 'Please Upgrade Now!', WBG_TXT_DOMAIN ) . '</a>' ;
?></span>
                    <?php 
?>
            </td>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_author_info"><?php 
_e( 'Display Author', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_author_info" id="wbg_author_info" value="1" <?php 
echo  ( $wbg_author_info ? 'checked' : null ) ;
?>>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Author Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_author_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_author_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_author_label );
?>">
            </td>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_category"><?php 
_e( 'Display Category', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_category" id="wbg_display_category" value="1" <?php 
echo  ( $wbg_display_category ? 'checked' : null ) ;
?>>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Category Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_category_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_category_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_category_label );
?>">
            </td>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_publisher"><?php 
_e( 'Display Publisher', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_publisher" id="wbg_display_publisher" value="1" <?php 
echo  ( $wbg_display_publisher ? 'checked' : null ) ;
?>>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Publisher Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_publisher_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_publisher_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_publisher_label );
?>">
            </td>
        </tr>
        <?php 
?>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_publish_date"><?php 
_e( 'Display Publish Date', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_publish_date" id="wbg_display_publish_date" value="1" <?php 
echo  ( $wbg_display_publish_date ? 'checked' : null ) ;
?>>
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Publish Date Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_publish_date_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_publish_date_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_publish_date_label );
?>">
            </td>
            <th scope="row" style="text-align: right;">
                <label for="wbg_publish_date_format"><?php 
_e( 'Date Format', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="radio" name="wbg_publish_date_format" id="wbg_publish_date_format_full" value="full" <?php 
echo  ( 'year' !== $wbg_publish_date_format ? 'checked' : '' ) ;
?> >
                <label for="wbg_publish_date_format_full"><span></span><?php 
_e( 'Full', WBG_TXT_DOMAIN );
?></label>
                    &nbsp;&nbsp;
                <input type="radio" name="wbg_publish_date_format" id="wbg_publish_date_format_year" value="year" <?php 
echo  ( 'year' === $wbg_publish_date_format ? 'checked' : '' ) ;
?> >
                <label for="wbg_publish_date_format_year"><span></span><?php 
_e( 'Only Year', WBG_TXT_DOMAIN );
?></label>
            </td>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_isbn"><?php 
_e( 'Display ISBN', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_isbn" id="wbg_display_isbn" value="1" <?php 
echo  ( $wbg_display_isbn ? 'checked' : null ) ;
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'ISBN Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_isbn_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_isbn_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_isbn_label );
?>">
            </td>
        </tr>
        <?php 
?>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_page"><?php 
_e( 'Display Pages', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_page" id="wbg_display_page" value="1" <?php 
echo  ( $wbg_display_page ? 'checked' : null ) ;
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Pages Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_page_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_page_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_page_label );
?>">
            </td>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_country"><?php 
_e( 'Display Country', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_country" id="wbg_display_country" value="1" <?php 
echo  ( $wbg_display_country ? 'checked' : null ) ;
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Country Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_country_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_country_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_country_label );
?>">
            </td>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_language"><?php 
_e( 'Display Language', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_language" id="wbg_display_language" value="1" <?php 
echo  ( $wbg_display_language ? 'checked' : null ) ;
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Language Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_language_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_language_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_language_label );
?>">
            </td>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_dimension"><?php 
_e( 'Display Dimension', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_dimension" id="wbg_display_dimension" value="1" <?php 
echo  ( $wbg_display_dimension ? 'checked' : null ) ;
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Dimension Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_dimension_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_dimension_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_dimension_label );
?>">
            </td>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_filesize"><?php 
_e( 'Display File Size', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_filesize" id="wbg_display_filesize" value="1" <?php 
echo  ( $wbg_display_filesize ? 'checked' : null ) ;
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'File Size Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_filesize_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_filesize_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_filesize_label );
?>">
            </td>
        </tr>      
        <?php 
?>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_description"><?php 
_e( 'Display Description', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_description" id="wbg_display_description" value="1" <?php 
echo  ( $wbg_display_description ? 'checked' : null ) ;
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Description Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_description_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_description_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_description_label );
?>">
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="6">
                <hr>
            </th>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_download_button"><?php 
_e( 'Hide Download Button', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_download_button" id="wbg_display_download_button" value="1" <?php 
echo  ( $wbg_display_download_button ? 'checked' : null ) ;
?> >
            </td>
            <?php 
?>
        </tr>
        <!-- Hide Other Books From / Author Panel -->
        <?php 
?>
        <!-- Hide Back Button -->
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_hide_back_button"><?php 
_e( 'Hide Back Button', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_hide_back_button" id="wbg_hide_back_button" value="1" <?php 
echo  ( $wbg_hide_back_button ? 'checked' : null ) ;
?> >
            </td>
            <th scope="row" style="text-align: right;">
                <label><?php 
_e( 'Back Button Label', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input type="text" name="wbg_back_button_label" class="medium-text" placeholder="<?php 
esc_attr_e( $wbg_back_button_label );
?>"
                    value="<?php 
esc_attr_e( $wbg_back_button_label );
?>">
            </td>
        </tr>
        <tr>
            <th scope="row" style="text-align: right;">
                <label for="wbg_display_sidebar"><?php 
_e( 'Display Sidebar', WBG_TXT_DOMAIN );
?>?</label>
            </th>
            <td>
                <input type="checkbox" name="wbg_display_sidebar" id="wbg_display_sidebar" value="1" <?php 
echo  ( $wbg_display_sidebar ? 'checked' : null ) ;
?> >
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateDetailsContent" name="updateDetailsContent" class="button button-primary wbg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', WBG_TXT_DOMAIN );
?>
        </button>
    </p>
</form>