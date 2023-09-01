<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Search Styles Settings
*/
trait Wbg_Search_Styles_Settings
{
    protected $fields, $settings, $options;
    
    protected function wbg_set_search_styles_settings( $post ) {

        $this->fields   = $this->wbg_search_styles_option_fileds();

        $this->options  = $this->wbg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'wbg_search_styles', $this->options, $post );

        return update_option( 'wbg_search_styles', $this->settings );

    }

    function wbg_get_search_styles_settings() {

        $this->fields   = $this->wbg_search_styles_option_fileds();
		$this->settings = get_option('wbg_search_styles');
        
        return $this->wbg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function wbg_search_styles_option_fileds() {

        return [
            [
                'name'      => 'wbg_btn_color',
                'type'      => 'text',
                'default'   => '#0274be',
            ],
            [
                'name'      => 'wbg_btn_border_color',
                'type'      => 'text',
                'default'   => '#317081',
            ],
            [
                'name'      => 'wbg_btn_font_color',
                'type'      => 'text',
                'default'   => '#FFFFFF',
            ],
            [
                'name'      => 'wbg_search_reset_bg_color',
                'type'      => 'text',
                'default'   => '#EEEEEE',
            ],
            [
                'name'      => 'wbg_search_reset_border_color',
                'type'      => 'text',
                'default'   => '#999999',
            ],
            [
                'name'      => 'wbg_search_reset_font_color',
                'type'      => 'text',
                'default'   => '#111111',
            ],
            [
                'name'      => 'wbg_search_panel_bg_color',
                'type'      => 'text',
                'default'   => '#FFFFFF',
            ],
            [
                'name'      => 'wbg_search_panel_border_color',
                'type'      => 'text',
                'default'   => '#CCCCCC',
            ],
            [
                'name'      => 'wbg_search_panel_border_radius',
                'type'      => 'number',
                'default'   => '0',
            ],
            [
                'name'      => 'wbg_search_panel_border_width',
                'type'      => 'number',
                'default'   => '0',
            ],
            [
                'name'      => 'wbg_search_panel_input_bg_color',
                'type'      => 'text',
                'default'   => '#FFFFFF',
            ],
            [
                'name'      => 'wbg_search_btn_bg_color_hover',
                'type'      => 'text',
                'default'   => '#EAEAEA',
            ],
            [
                'name'      => 'wbg_search_font_color_hover',
                'type'      => 'text',
                'default'   => '#242424',
            ],
        ];
    }
}