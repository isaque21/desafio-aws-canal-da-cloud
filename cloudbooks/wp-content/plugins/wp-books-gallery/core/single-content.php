<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Single Content Settings
*/
trait Wbg_Single_Content_Settings 
{
    protected $fields, $settings, $options;

    protected function wbg_set_single_content_settings( $post ) {

        $this->fields   = $this->wbg_single_content_option_fileds();

        $this->options  = $this->wbg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'wbg_detail_settings', $this->options, $post );

        return update_option( 'wbg_detail_settings', serialize( $this->settings ) );

    }

    function wbg_get_single_content_settings() {

        $this->fields   = $this->wbg_single_content_option_fileds();
		$this->settings = stripslashes_deep( unserialize( get_option('wbg_detail_settings') ) );
        
        return $this->wbg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function wbg_single_content_option_fileds() {

        return [
            [
                'name'      => 'wbg_display_format',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_format_label',
                'type'      => 'text',
                'default'   => 'Format',
            ],
            [
                'name'      => 'wbg_display_series',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_series_label',
                'type'      => 'text',
                'default'   => 'Series',
            ],
            [
                'name'      => 'wbg_display_reading_age',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_reading_age_label',
                'type'      => 'text',
                'default'   => 'Reading Age',
            ],
            [
                'name'      => 'wbg_display_grade_level',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_grade_level_label',
                'type'      => 'text',
                'default'   => 'Grade Level',
            ],
            [
                'name'      => 'wbg_author_info',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_author_label',
                'type'      => 'text',
                'default'   => 'Author',
            ],
            [
                'name'      => 'wbg_display_category',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_category_label',
                'type'      => 'text',
                'default'   => 'Category',
            ],
            [
                'name'      => 'wbg_display_publisher',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_publisher_label',
                'type'      => 'text',
                'default'   => 'Publisher',
            ],
            [
                'name'      => 'wbg_display_co_publisher',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_co_publisher_label',
                'type'      => 'text',
                'default'   => 'Co-Publisher',
            ],
            [
                'name'      => 'wbg_display_isbn',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_isbn_label',
                'type'      => 'text',
                'default'   => 'ISBN',
            ],
            [
                'name'      => 'wbg_display_isbn_13',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_isbn_13_label',
                'type'      => 'text',
                'default'   => 'ISBN',
            ],
            [
                'name'      => 'wbg_display_page',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_page_label',
                'type'      => 'text',
                'default'   => 'Pages',
            ],
            [
                'name'      => 'wbg_display_country',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_country_label',
                'type'      => 'text',
                'default'   => 'Country',
            ],
            [
                'name'      => 'wbg_display_language',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_language_label',
                'type'      => 'text',
                'default'   => 'Language',
            ],
            [
                'name'      => 'wbg_display_dimension',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_dimension_label',
                'type'      => 'text',
                'default'   => 'Dimension',
            ],
            [
                'name'      => 'wbg_display_filesize',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_filesize_label',
                'type'      => 'text',
                'default'   => 'File Size',
            ],
            [
                'name'      => 'wbg_display_item_weight',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_item_weight_label',
                'type'      => 'text',
                'default'   => 'Item Weight',
            ],
            [
                'name'      => 'wbg_display_description',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_description_label',
                'type'      => 'text',
                'default'   => 'Description',
            ],
            [
                'name'      => 'wbg_display_publish_date',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_publish_date_label',
                'type'      => 'text',
                'default'   => 'Published',
            ],
            [
                'name'      => 'wbg_publish_date_format',
                'type'      => 'string',
                'default'   => 'full',
            ],
            [
                'name'      => 'wbg_display_download_button',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_subtitle',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_sidebar',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_edition',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_edition_label',
                'type'      => 'text',
                'default'   => 'Edition',
            ],
            [
                'name'      => 'wbg_display_illustrator',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_illustrator_label',
                'type'      => 'text',
                'default'   => 'Illustrator',
            ],
            [
                'name'      => 'wbg_hide_other_books_from',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_hide_other_books_by',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_hide_back_button',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_back_button_label',
                'type'      => 'text',
                'default'   => 'Back',
            ],
            [
                'name'      => 'wbg_details_hide_buynow_btn',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_details_hide_author_panel',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_details_hide_author_panel_title',
                'type'      => 'text',
                'default'   => 'About the author',
            ],
            [
                'name'      => 'wbg_details_hide_editorial_reviews',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_details_hide_editorial_reviews_title',
                'type'      => 'text',
                'default'   => 'Editorial Reviews',
            ],
        ];
    }
}