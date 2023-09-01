<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Gallery Styles Settings
*/
trait Wbg_Gallery_Settings_Styles
{
    protected $fields, $settings, $options;
    
    protected function wbg_set_gallery_styles_settings( $post ) {

        $this->fields   = $this->wbg_gallery_styles_option_fileds();

        $this->options  = $this->wbg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'wbg_general_styles', $this->options, $post );

        return update_option( 'wbg_general_styles', $this->settings );

    }

    function wbg_get_gallery_styles_settings() {

        $this->fields   = $this->wbg_gallery_styles_option_fileds();
		$this->settings = get_option('wbg_general_styles');
        
        return $this->wbg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function wbg_gallery_styles_option_fileds() {

        return [
            [
                'name'      => 'wbg_container_border_color',
                'type'      => 'text',
                'default'   => '#FFFFFF',
            ],
            [
                'name'      => 'wbg_container_bg_color',
                'type'      => 'text',
                'default'   => '#FFF',
            ],
            [
                'name'      => 'wbg_container_width',
                'type'      => 'number',
                'default'   => 1200,
            ],
            [
                'name'      => 'wbg_container_width_type',
                'type'      => 'string',
                'default'   => 'px',
            ],
            [
                'name'      => 'wbg_container_margin_top',
                'type'      => 'number',
                'default'   => 0,
            ],
            [
                'name'      => 'wbg_container_margin_bottom',
                'type'      => 'number',
                'default'   => 0,
            ],
            [
                'name'      => 'wbg_loop_container_padding',
                'type'      => 'number',
                'default'   => 0,
            ],
            [
                'name'      => 'wbg_loop_container_radius',
                'type'      => 'number',
                'default'   => 0,
            ],
            [
                'name'      => 'wbg_loop_book_border_color',
                'type'      => 'text',
                'default'   => '#FFFFFF',
            ],
            [
                'name'      => 'wbg_loop_book_bg_color',
                'type'      => 'text',
                'default'   => '#F4F4F4',
            ],
            [
                'name'      => 'wbg_hide_hover_shadow',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_download_btn_color',
                'type'      => 'text',
                'default'   => '#0274be',
            ],
            [
                'name'      => 'wbg_download_btn_font_color',
                'type'      => 'text',
                'default'   => '#FFFFFF',
            ],
            [
                'name'      => 'wbg_download_btn_color_hvr',
                'type'      => 'text',
                'default'   => '#0274be',
            ],
            [
                'name'      => 'wbg_download_btn_font_color_hvr',
                'type'      => 'text',
                'default'   => '#FFFFFF',
            ],
            [
                'name'      => 'wbg_download_btn_font_size',
                'type'      => 'number',
                'default'   => '12',
            ],
            [
                'name'      => 'wbg_title_color',
                'type'      => 'text',
                'default'   => '#242424',
            ],
            [
                'name'      => 'wbg_title_hover_color',
                'type'      => 'text',
                'default'   => '#FF0000',
            ],
            [
                'name'      => 'wbg_title_font_size',
                'type'      => 'number',
                'default'   => '18',
            ],
            [
                'name'      => 'wbg_description_color',
                'type'      => 'text',
                'default'   => '#242424',
            ],
            [
                'name'      => 'wbg_description_font_size',
                'type'      => 'number',
                'default'   => '12',
            ],
            [
                'name'      => 'wbg_pagination_bg_color',
                'type'      => 'text',
                'default'   => '#FFFFFF',
            ],
            [
                'name'      => 'wbg_pagination_font_color',
                'type'      => 'text',
                'default'   => '#242424',
            ],
            [
                'name'      => 'wbg_pagination_hover_bg_color',
                'type'      => 'text',
                'default'   => '#DDDDDD',
            ],
            [
                'name'      => 'wbg_pagination_hover_font_color',
                'type'      => 'text',
                'default'   => '#242424',
            ],
            [
                'name'      => 'wbg_pagination_active_bg_color',
                'type'      => 'text',
                'default'   => '#DDDDDD',
            ],
            [
                'name'      => 'wbg_pagination_active_font_color',
                'type'      => 'text',
                'default'   => '#242424',
            ],
            [
                'name'      => 'wbg_rprice_font_color',
                'type'      => 'text',
                'default'   => '#13b651',
            ],
            [
                'name'      => 'wbg_dprice_font_color',
                'type'      => 'text',
                'default'   => '#ff7162',
            ],
            [
                'name'      => 'wbg_price_font_size',
                'type'      => 'number',
                'default'   => '16',
            ],
            [
                'name'      => 'wbg_loop_format_font_color',
                'type'      => 'text',
                'default'   => '#006600',
            ],
            [
                'name'      => 'wbg_loop_format_font_size',
                'type'      => 'number',
                'default'   => '11',
            ],
            [
                'name'      => 'wbg_loop_cat_font_color',
                'type'      => 'text',
                'default'   => '#555555',
            ],
            [
                'name'      => 'wbg_loop_cat_font_size',
                'type'      => 'number',
                'default'   => '11',
            ],
            [
                'name'      => 'wbg_loop_author_font_color',
                'type'      => 'text',
                'default'   => '#555555',
            ],
            [
                'name'      => 'wbg_loop_author_font_size',
                'type'      => 'number',
                'default'   => '11',
            ],
        ];
    }
}