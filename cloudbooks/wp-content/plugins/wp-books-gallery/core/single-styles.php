<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Single Styles Settings
*/
trait Wbg_Single_Styles_Settings
{
    protected $fields, $settings, $options;
    
    protected function wbg_set_single_styles_settings( $post ) {

        $this->fields   = $this->wbg_single_styles_option_fileds();

        $this->options  = $this->wbg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'wbg_single_styles', $this->options, $post );

        return update_option( 'wbg_single_styles', $this->settings );

    }

    function wbg_get_single_styles_settings() {

        $this->fields   = $this->wbg_single_styles_option_fileds();
		$this->settings = get_option('wbg_single_styles');
        
        return $this->wbg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function wbg_single_styles_option_fileds() {

        return [
            [
                'name'      => 'wbg_single_container_width',
                'type'      => 'number',
                'default'   => '1100',
            ],
            [
                'name'      => 'wbg_single_container_width_type',
                'type'      => 'text',
                'default'   => 'px',
            ],
            [
                'name'      => 'wbg_single_container_margin_top',
                'type'      => 'number',
                'default'   => '50',
            ],
            [
                'name'      => 'wbg_single_container_margin_bottom',
                'type'      => 'number',
                'default'   => '50',
            ],
            [
                'name'      => 'wbg_single_title_font_color',
                'type'      => 'text',
                'default'   => '#242424',
            ],
            [
                'name'      => 'wbg_single_title_font_size',
                'type'      => 'number',
                'default'   => '18',
            ],
            [
                'name'      => 'wbg_single_subtitle_font_color',
                'type'      => 'text',
                'default'   => '#555555',
            ],
            [
                'name'      => 'wbg_single_subtitle_font_size',
                'type'      => 'number',
                'default'   => '14',
            ],
            [
                'name'      => 'wbg_single_label_font_color',
                'type'      => 'text',
                'default'   => '#242424',
            ],
            [
                'name'      => 'wbg_single_label_font_size',
                'type'      => 'number',
                'default'   => '12',
            ],
            [
                'name'      => 'wbg_single_info_font_color',
                'type'      => 'text',
                'default'   => '#242424',
            ],
            [
                'name'      => 'wbg_single_info_font_size',
                'type'      => 'number',
                'default'   => '12',
            ],
            [
                'name'      => 'wbg_single_modal_height',
                'type'      => 'number',
                'default'   => '400',
            ],
            [
                'name'      => 'wbg_single_modal_width',
                'type'      => 'number',
                'default'   => '700',
            ],
            [
                'name'      => 'wbg_single_modal_bg_color',
                'type'      => 'text',
                'default'   => '#FFFFFF',
            ],
            [
                'name'      => 'wbg_single_modal_border_color',
                'type'      => 'text',
                'default'   => '#FFFFFF',
            ],
            [
                'name'      => 'wbg_single_modal_border_width',
                'type'      => 'number',
                'default'   => '0',
            ],
        ];
    }
}