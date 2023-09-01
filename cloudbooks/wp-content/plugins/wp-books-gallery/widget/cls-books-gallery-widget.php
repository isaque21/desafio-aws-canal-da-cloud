<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
* Widget Master Class
*/
class Wbg_Widget extends WP_Widget
{
    //use Cab_Core, Hmcab_Personal_Settings, Hmcab_Social_Settings, Hmcab_Template_Settings, Hmcab_Styles_Post_Settings;
    function __construct()
    {
        parent::__construct( 'wbg-widget', __( 'Books Gallery', WBG_TXT_DOMAIN ), array(
            'description' => __( 'Books Gallery Widget', WBG_TXT_DOMAIN ),
        ) );
        add_action( 'load-widgets.php', array( &$this, 'wbg_color_picker_load' ) );
    }
    
    function wbg_color_picker_load()
    {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
    }
    
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    function widget( $args, $instance )
    {
        echo  $args['before_widget'] ;
        if ( !empty($instance['title']) ) {
            echo  $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'] ;
        }
        $wbg_wl_border_width = ( !empty($instance['wbg_wl_border_width']) && filter_var( $instance['wbg_wl_border_width'], FILTER_SANITIZE_NUMBER_INT ) ? $instance['wbg_wl_border_width'] : 0 );
        $wbg_wl_border_radius = ( !empty($instance['wbg_wl_border_radius']) && filter_var( $instance['wbg_wl_border_radius'], FILTER_SANITIZE_NUMBER_INT ) ? $instance['wbg_wl_border_radius'] : 0 );
        $wbg_wl_border_color = ( isset( $instance['wbg_wl_border_color'] ) ? sanitize_text_field( $instance['wbg_wl_border_color'] ) : '#DDDDDD' );
        $wbg_wl_bg_color = ( isset( $instance['wbg_wl_bg_color'] ) ? sanitize_text_field( $instance['wbg_wl_bg_color'] ) : '#FFFFFF' );
        $wbg_wl_container_padding = ( isset( $instance['wbg_wl_container_padding'] ) ? $instance['wbg_wl_container_padding'] : 0 );
        $wbg_wl_title_color = ( isset( $instance['wbg_wl_title_color'] ) ? sanitize_text_field( $instance['wbg_wl_title_color'] ) : '#242424' );
        $wbg_wl_title_font_size = ( isset( $instance['wbg_wl_title_font_size'] ) && filter_var( $instance['wbg_wl_title_font_size'], FILTER_SANITIZE_NUMBER_INT ) ? $instance['wbg_wl_title_font_size'] : 16 );
        $wbg_wl_category_color = ( isset( $instance['wbg_wl_category_color'] ) ? sanitize_text_field( $instance['wbg_wl_category_color'] ) : '#555555' );
        $wbg_wl_cat_font_size = ( isset( $instance['wbg_wl_cat_font_size'] ) && filter_var( $instance['wbg_wl_cat_font_size'], FILTER_SANITIZE_NUMBER_INT ) ? $instance['wbg_wl_cat_font_size'] : 11 );
        $wbg_wl_rating = ( isset( $instance['wbg_wl_rating'] ) ? sanitize_text_field( $instance['wbg_wl_rating'] ) : '' );
        $wbg_wl_download_btn = ( isset( $instance['wbg_wl_download_btn'] ) ? sanitize_text_field( $instance['wbg_wl_download_btn'] ) : '' );
        $wbg_wl_buy_btn = ( isset( $instance['wbg_wl_buy_btn'] ) ? sanitize_text_field( $instance['wbg_wl_buy_btn'] ) : '' );
        $wbg_wl_download_btn_bg_color = ( isset( $instance['wbg_wl_download_btn_bg_color'] ) ? sanitize_text_field( $instance['wbg_wl_download_btn_bg_color'] ) : '#0274be' );
        $wbg_wl_dnld_btn_font_clr = ( isset( $instance['wbg_wl_dnld_btn_font_clr'] ) ? sanitize_text_field( $instance['wbg_wl_dnld_btn_font_clr'] ) : '#FFFFFF' );
        ?>
		<style>
		.wbg-main-wrapper.wbg-view-widget .wbg-item {
			border: <?php 
        esc_attr_e( $wbg_wl_border_width );
        ?>px solid <?php 
        esc_attr_e( $wbg_wl_border_color );
        ?>;
			border-radius: <?php 
        esc_attr_e( $wbg_wl_border_radius );
        ?>px;
			background: <?php 
        esc_attr_e( $wbg_wl_bg_color );
        ?>;
			padding: <?php 
        esc_attr_e( $wbg_wl_container_padding );
        ?>px;
		}
		.wbg-main-wrapper.wbg-view-widget .wbg-item a.wgb-item-link {
			color: <?php 
        esc_attr_e( $wbg_wl_title_color );
        ?>;
			font-size: <?php 
        esc_attr_e( $wbg_wl_title_font_size );
        ?>px;
		}
		.wbg-main-wrapper.wbg-view-widget .wbg-item a.wgb-item-link:hover {
			opacity: 0.7;
		}
		.wbg-main-wrapper.wbg-view-widget .wbg-item span {
			color: <?php 
        esc_attr_e( $wbg_wl_category_color );
        ?>;
			font-size: <?php 
        esc_attr_e( $wbg_wl_cat_font_size );
        ?>px;
		}
		.wbg-main-wrapper.wbg-view-widget  .wbg-item a.wbg-btn {
			background: <?php 
        esc_attr_e( $wbg_wl_download_btn_bg_color );
        ?>;
			border: 1px solid <?php 
        esc_attr_e( $wbg_wl_download_btn_bg_color );
        ?>;
			color: <?php 
        esc_attr_e( $wbg_wl_dnld_btn_font_clr );
        ?>;
		}
		.wbg-main-wrapper.wbg-view-widget  .wbg-item a.wbg-btn:hover {
			background: #FFFFFF;
			color: <?php 
        esc_attr_e( $wbg_wl_download_btn_bg_color );
        ?>;
			border: 1px solid <?php 
        esc_attr_e( $wbg_wl_download_btn_bg_color );
        ?>;
		}
		</style>
		<?php 
        _e( 'Upgrade to professional', WBG_TXT_DOMAIN );
        //==========================
        echo  $args['after_widget'] ;
    }
    
    /**
     * Widget Form
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance )
    {
        $title = ( isset( $instance['title'] ) ? $instance['title'] : __( 'Books Gallery', WBG_TXT_DOMAIN ) );
        $wbg_wl_border_width = ( isset( $instance['wbg_wl_cat_font_size'] ) && filter_var( $instance['wbg_wl_border_width'], FILTER_SANITIZE_NUMBER_INT ) ? $instance['wbg_wl_border_width'] : 0 );
        $wbg_wl_border_color = ( isset( $instance['wbg_wl_border_color'] ) ? sanitize_text_field( $instance['wbg_wl_border_color'] ) : '#DDDDDD' );
        $wbg_wl_border_radius = ( !empty($instance['wbg_wl_border_radius']) && filter_var( $instance['wbg_wl_border_radius'], FILTER_SANITIZE_NUMBER_INT ) ? $instance['wbg_wl_border_radius'] : 0 );
        $wbg_wl_bg_color = ( isset( $instance['wbg_wl_bg_color'] ) ? sanitize_text_field( $instance['wbg_wl_bg_color'] ) : '#FFFFFF' );
        $wbg_wl_container_padding = ( isset( $instance['wbg_wl_container_padding'] ) && filter_var( $instance['wbg_wl_container_padding'], FILTER_SANITIZE_NUMBER_INT ) ? $instance['wbg_wl_container_padding'] : 0 );
        $wbg_wl_title_color = ( isset( $instance['wbg_wl_title_color'] ) ? sanitize_text_field( $instance['wbg_wl_title_color'] ) : '#242424' );
        $wbg_wl_title_font_size = ( isset( $instance['wbg_wl_title_font_size'] ) && filter_var( $instance['wbg_wl_title_font_size'], FILTER_SANITIZE_NUMBER_INT ) ? $instance['wbg_wl_title_font_size'] : 16 );
        $wbg_wl_category_color = ( isset( $instance['wbg_wl_category_color'] ) ? sanitize_text_field( $instance['wbg_wl_category_color'] ) : '#555555' );
        $wbg_wl_cat_font_size = ( isset( $instance['wbg_wl_cat_font_size'] ) && filter_var( $instance['wbg_wl_cat_font_size'], FILTER_SANITIZE_NUMBER_INT ) ? $instance['wbg_wl_cat_font_size'] : 11 );
        $wbg_wl_rating = ( isset( $instance['wbg_wl_rating'] ) ? sanitize_text_field( $instance['wbg_wl_rating'] ) : '' );
        $wbg_wl_download_btn = ( isset( $instance['wbg_wl_download_btn'] ) ? sanitize_text_field( $instance['wbg_wl_download_btn'] ) : '' );
        $wbg_wl_buy_btn = ( isset( $instance['wbg_wl_buy_btn'] ) ? sanitize_text_field( $instance['wbg_wl_buy_btn'] ) : '' );
        $wbg_wl_download_btn_bg_color = ( isset( $instance['wbg_wl_download_btn_bg_color'] ) ? sanitize_text_field( $instance['wbg_wl_download_btn_bg_color'] ) : '#0274be' );
        $wbg_wl_dnld_btn_font_clr = ( isset( $instance['wbg_wl_dnld_btn_font_clr'] ) ? sanitize_text_field( $instance['wbg_wl_dnld_btn_font_clr'] ) : '#FFFFFF' );
        ?>
		<p>
			<label><?php 
        _e( 'Title', WBG_TXT_DOMAIN );
        ?>:</label>
			<input class="widefat" id="<?php 
        echo  $this->get_field_id( 'title' ) ;
        ?>" name="<?php 
        echo  $this->get_field_name( 'title' ) ;
        ?>" type="text" value="<?php 
        esc_attr_e( $title );
        ?>">
		</p>
		<hr><label><?php 
        _e( 'Container', WBG_TXT_DOMAIN );
        ?>:</label><hr>
		<p>
			<label><?php 
        _e( 'Border Width', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="number" min="0" max="10" step="1" class="tiny-text" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_border_width' ) ;
        ?>" name="<?php 
        echo  $this->get_field_name( 'wbg_wl_border_width' ) ;
        ?>" value="<?php 
        esc_attr_e( $wbg_wl_border_width );
        ?>">
			<?php 
        esc_html_e( 'px', WBG_TXT_DOMAIN );
        ?>
		</p>
		<p>
			<label><?php 
        _e( 'Border Color', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="text" class="wbg-color-picker" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_border_color' ) ;
        ?>" name="<?php 
        esc_attr_e( $this->get_field_name( 'wbg_wl_border_color' ) );
        ?>" value="<?php 
        esc_attr_e( $wbg_wl_border_color );
        ?>">
			<div id="colorpicker"></div>
		</p>
		<p>
			<label><?php 
        _e( 'Border Radius', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="number" min="0" max="30" step="1" class="tiny-text" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_border_radius' ) ;
        ?>" name="<?php 
        echo  $this->get_field_name( 'wbg_wl_border_radius' ) ;
        ?>" value="<?php 
        esc_attr_e( $wbg_wl_border_radius );
        ?>">
			<?php 
        esc_html_e( 'px', WBG_TXT_DOMAIN );
        ?>
		</p>
		<p>
			<label><?php 
        _e( 'Background Color', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="text" class="wbg-color-picker" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_bg_color' ) ;
        ?>" name="<?php 
        esc_attr_e( $this->get_field_name( 'wbg_wl_bg_color' ) );
        ?>" value="<?php 
        esc_attr_e( $wbg_wl_bg_color );
        ?>">
			<div id="colorpicker"></div>
		</p>
		<p>
			<label><?php 
        _e( 'Padding', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="number" min="0" max="20" step="1" class="tiny-text" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_container_padding' ) ;
        ?>" name="<?php 
        echo  $this->get_field_name( 'wbg_wl_container_padding' ) ;
        ?>" value="<?php 
        esc_attr_e( $wbg_wl_container_padding );
        ?>">
			px
		</p>
		<hr><label><?php 
        _e( 'Book Title', WBG_TXT_DOMAIN );
        ?>:</label><hr>
		<p>
			<label><?php 
        _e( 'Font Color', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="text" class="wbg-color-picker" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_title_color' ) ;
        ?>" name="<?php 
        esc_attr_e( $this->get_field_name( 'wbg_wl_title_color' ) );
        ?>" value="<?php 
        esc_attr_e( $wbg_wl_title_color );
        ?>">
			<div id="colorpicker"></div>
		</p>
		<p>
			<label><?php 
        _e( 'Font Size', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="number" min="12" max="34" step="1" class="tiny-text" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_title_font_size' ) ;
        ?>" name="<?php 
        echo  $this->get_field_name( 'wbg_wl_title_font_size' ) ;
        ?>" value="<?php 
        esc_attr_e( $wbg_wl_title_font_size );
        ?>">
			<?php 
        esc_html_e( 'px', WBG_TXT_DOMAIN );
        ?>
		</p>
		<hr><label><?php 
        _e( 'Category / Author', WBG_TXT_DOMAIN );
        ?>:</label><hr>
		<p>
			<label><?php 
        _e( 'Font Color', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="text" class="wbg-color-picker" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_category_color' ) ;
        ?>" name="<?php 
        esc_attr_e( $this->get_field_name( 'wbg_wl_category_color' ) );
        ?>" value="<?php 
        esc_attr_e( $wbg_wl_category_color );
        ?>">
			<div id="colorpicker"></div>
		</p>
		<p>
			<label><?php 
        _e( 'Font Size', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="number" min="11" max="18" step="1" class="tiny-text" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_cat_font_size' ) ;
        ?>" name="<?php 
        echo  $this->get_field_name( 'wbg_wl_cat_font_size' ) ;
        ?>" value="<?php 
        esc_attr_e( $wbg_wl_cat_font_size );
        ?>">
			<?php 
        esc_html_e( 'px', WBG_TXT_DOMAIN );
        ?>
		</p>
		<hr><label><?php 
        _e( 'Rating', WBG_TXT_DOMAIN );
        ?>:</label><hr>
		<p> 
			<label for="<?php 
        echo  $this->get_field_id( 'wbg_wl_rating' ) ;
        ?>"><?php 
        _e( 'Display Rating', WBG_TXT_DOMAIN );
        ?>?</label>
			<input type="checkbox" class="checkbox" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_rating' ) ;
        ?>" name="<?php 
        echo  $this->get_field_name( 'wbg_wl_rating' ) ;
        ?>" <?php 
        checked( $wbg_wl_rating, 'on' );
        ?> />
		</p>
		<hr><label><?php 
        _e( 'Download Button', WBG_TXT_DOMAIN );
        ?>:</label><hr>
		<p> 
			<label for="<?php 
        echo  $this->get_field_id( 'wbg_wl_download_btn' ) ;
        ?>"><?php 
        _e( 'Check to show', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="checkbox" class="checkbox" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_download_btn' ) ;
        ?>" name="<?php 
        echo  $this->get_field_name( 'wbg_wl_download_btn' ) ;
        ?>" <?php 
        checked( $wbg_wl_download_btn, 'on' );
        ?> />
		</p>
		<p>
			<label><?php 
        _e( 'Background Color', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="text" class="wbg-color-picker" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_download_btn_bg_color' ) ;
        ?>" name="<?php 
        esc_attr_e( $this->get_field_name( 'wbg_wl_download_btn_bg_color' ) );
        ?>" value="<?php 
        esc_attr_e( $wbg_wl_download_btn_bg_color );
        ?>">
			<div id="colorpicker"></div>
		</p>
		<p>
			<label><?php 
        _e( 'Font Color', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="text" class="wbg-color-picker" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_dnld_btn_font_clr' ) ;
        ?>" name="<?php 
        esc_attr_e( $this->get_field_name( 'wbg_wl_dnld_btn_font_clr' ) );
        ?>" value="<?php 
        esc_attr_e( $wbg_wl_dnld_btn_font_clr );
        ?>">
			<div id="colorpicker"></div>
		</p>
		<hr><label><?php 
        _e( 'Buy Button', WBG_TXT_DOMAIN );
        ?>:</label><hr>
		<p> 
			<label for="<?php 
        echo  $this->get_field_id( 'wbg_wl_buy_btn' ) ;
        ?>"><?php 
        _e( 'Check to show', WBG_TXT_DOMAIN );
        ?>:</label>
			<input type="checkbox" class="checkbox" id="<?php 
        echo  $this->get_field_id( 'wbg_wl_buy_btn' ) ;
        ?>" name="<?php 
        echo  $this->get_field_name( 'wbg_wl_buy_btn' ) ;
        ?>" <?php 
        checked( $wbg_wl_buy_btn, 'on' );
        ?> />
		</p>
		<?php 
    }
    
    /*
     * Update Widget Value
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance )
    {
        $instance = array();
        $instance['title'] = ( isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : __( 'Books Gallery', WBG_TXT_DOMAIN ) );
        $instance['wbg_wl_border_width'] = ( filter_var( $new_instance['wbg_wl_border_width'], FILTER_SANITIZE_NUMBER_INT ) ? $new_instance['wbg_wl_border_width'] : 0 );
        $instance['wbg_wl_border_color'] = ( isset( $new_instance['wbg_wl_border_color'] ) ? sanitize_text_field( $new_instance['wbg_wl_border_color'] ) : '#DDDDDD' );
        $instance['wbg_wl_border_radius'] = ( filter_var( $new_instance['wbg_wl_border_radius'], FILTER_SANITIZE_NUMBER_INT ) ? $new_instance['wbg_wl_border_radius'] : 0 );
        $instance['wbg_wl_bg_color'] = ( isset( $new_instance['wbg_wl_bg_color'] ) ? sanitize_text_field( $new_instance['wbg_wl_bg_color'] ) : '#FFF' );
        $instance['wbg_wl_container_padding'] = ( filter_var( $new_instance['wbg_wl_container_padding'], FILTER_SANITIZE_NUMBER_INT ) ? $new_instance['wbg_wl_container_padding'] : 0 );
        $instance['wbg_wl_title_color'] = ( isset( $new_instance['wbg_wl_title_color'] ) ? sanitize_text_field( $new_instance['wbg_wl_title_color'] ) : '#242424' );
        $instance['wbg_wl_title_font_size'] = ( filter_var( $new_instance['wbg_wl_title_font_size'], FILTER_SANITIZE_NUMBER_INT ) ? $new_instance['wbg_wl_title_font_size'] : 16 );
        $instance['wbg_wl_category_color'] = ( isset( $new_instance['wbg_wl_category_color'] ) ? sanitize_text_field( $new_instance['wbg_wl_category_color'] ) : '#555555' );
        $instance['wbg_wl_cat_font_size'] = ( filter_var( $new_instance['wbg_wl_cat_font_size'], FILTER_SANITIZE_NUMBER_INT ) ? $new_instance['wbg_wl_cat_font_size'] : 11 );
        $instance['wbg_wl_rating'] = ( isset( $new_instance['wbg_wl_rating'] ) ? sanitize_text_field( $new_instance['wbg_wl_rating'] ) : '' );
        $instance['wbg_wl_download_btn'] = ( isset( $new_instance['wbg_wl_download_btn'] ) ? sanitize_text_field( $new_instance['wbg_wl_download_btn'] ) : '' );
        $instance['wbg_wl_buy_btn'] = ( isset( $new_instance['wbg_wl_buy_btn'] ) ? sanitize_text_field( $new_instance['wbg_wl_buy_btn'] ) : '' );
        $instance['wbg_wl_download_btn_bg_color'] = ( isset( $new_instance['wbg_wl_download_btn_bg_color'] ) ? sanitize_text_field( $new_instance['wbg_wl_download_btn_bg_color'] ) : '#0274be' );
        $instance['wbg_wl_dnld_btn_font_clr'] = ( isset( $new_instance['wbg_wl_dnld_btn_font_clr'] ) ? sanitize_text_field( $new_instance['wbg_wl_dnld_btn_font_clr'] ) : '#FFFFFF' );
        return $instance;
    }

}