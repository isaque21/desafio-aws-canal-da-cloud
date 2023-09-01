<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
//print_r( $wbgSearchStyles );
foreach ( $wbgSearchStyles as $option_name => $option_value ) {
    if ( isset( $wbgSearchStyles[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="wbg_search_style_form" role="form" class="form-horizontal" method="post" action="" id="wbg-search-style-form">
<?php 
wp_nonce_field( 'wbg_search_style_action', 'wbg_search_style_nonce_field' );
?>
    <table class="wbg-search-style-settings-table">
        <!-- Search Panel -->
        <tr>
            <th scope="row" colspan="4" style="text-align:left;">
                <hr><span><?php 
_e( 'Search Panel', WBG_TXT_DOMAIN );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', WBG_TXT_DOMAIN );
?>:</label>
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
            <th scope="row">
                <label><?php 
_e( 'Border Color', WBG_TXT_DOMAIN );
?>:</label>
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
            <th scope="row">
                <label><?php 
_e( 'Border Radius', WBG_TXT_DOMAIN );
?>:</label>
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
            <th scope="row">
                <label><?php 
_e( 'Border Width', WBG_TXT_DOMAIN );
?>:</label>
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
        <!-- Input Fields -->
        <tr>
            <th scope="row" colspan="4" style="text-align:left;">
                <hr><span><?php 
_e( 'Input Fields', WBG_TXT_DOMAIN );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', WBG_TXT_DOMAIN );
?>:</label>
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
        <!-- Search Button -->
        <tr>
            <th scope="row" colspan="4" style="text-align:left;">
                <hr><span><?php 
_e( 'Search Button', WBG_TXT_DOMAIN );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_btn_color" id="wbg_btn_color" value="<?php 
esc_attr_e( $wbg_btn_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Border Color', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_btn_border_color" id="wbg_btn_border_color" value="<?php 
esc_attr_e( $wbg_btn_border_color );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Font Color', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_btn_font_color" id="wbg_btn_font_color" value="<?php 
esc_attr_e( $wbg_btn_font_color );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row" colspan="4" style="text-align:left;">
                <hr><span><?php 
_e( 'Search Button - Hover', WBG_TXT_DOMAIN );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_btn_bg_color_hover" id="wbg_search_btn_bg_color_hover" value="<?php 
esc_attr_e( $wbg_search_btn_bg_color_hover );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Font Color', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_font_color_hover" id="wbg_search_font_color_hover" value="<?php 
esc_attr_e( $wbg_search_font_color_hover );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <!-- Reset Button -->
        <tr>
            <th scope="row" colspan="4" style="text-align:left;">
                <hr><span><?php 
_e( 'Reset Button', WBG_TXT_DOMAIN );
?></span><hr>
            </th>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Background Color', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_reset_bg_color" id="wbg_search_reset_bg_color" value="<?php 
esc_attr_e( $wbg_search_reset_bg_color );
?>">
                <div id="colorpicker"></div>
            </td>
            <th scope="row">
                <label><?php 
_e( 'Border Color', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_reset_border_color" id="wbg_search_reset_border_color" value="<?php 
esc_attr_e( $wbg_search_reset_border_color );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label><?php 
_e( 'Font Color', WBG_TXT_DOMAIN );
?>:</label>
            </th>
            <td>
                <input class="wbg-wp-color" type="text" name="wbg_search_reset_font_color" id="wbg_search_reset_font_color" value="<?php 
esc_attr_e( $wbg_search_reset_font_color );
?>">
                <div id="colorpicker"></div>
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateSearchStyles" name="updateSearchStyles" class="button button-primary wbg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php 
_e( 'Save Settings', WBG_TXT_DOMAIN );
?>
        </button>
    </p>

</form>