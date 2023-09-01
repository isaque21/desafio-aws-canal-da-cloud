<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

$wbg_sale_sources = $this->wbg_mss_items();

foreach ( $wbg_sale_sources as $source ) {
    $var_s = 'wbg_mss_' . str_replace(' ', '_', strtolower($source));
    ${''. $var_s} = get_post_meta( $post->ID, $var_s, true );
}
?>
<table class="form-table">
    <?php
    foreach ( $wbg_sale_sources as $source ) {
        $var = 'wbg_mss_' . str_replace(' ', '_', strtolower($source));
        ?>
        <tr>
            <th scope="row">
                <label><?php esc_html_e( $source ); ?></label>
            </th>
            <td>
                <input type="text" name="<?php esc_attr_e( $var ); ?>" value="<?php esc_attr_e( ${''. $var} ); ?>" class="widefat">
            </td>
        </tr>
        <?php
    }
    ?>
</table>