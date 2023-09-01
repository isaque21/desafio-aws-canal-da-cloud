<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Search Content Settings
*/
trait Wbg_Search_Content_Settings 
{
    protected $fields, $settings, $options;

    protected function wbg_set_search_content_settings( $post ) {

        $this->fields   = $this->wbg_search_content_option_fileds();

        $this->options  = $this->wbg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'wbg_search_settings', $this->options, $post );

        return update_option( 'wbg_search_settings', $this->settings );

    }

    function wbg_get_search_content_settings() {

        $this->fields   = $this->wbg_search_content_option_fileds();
		$this->settings = get_option('wbg_search_settings');
        
        return $this->wbg_build_get_settings_options( $this->fields, $this->settings );
	}

    function get_search_items() {

        if ( get_option( 'wbgp_search_dad_list' ) ) {

            $searchItems = get_option( 'wbgp_search_dad_list' );
            if ( ! in_array('format', $searchItems) ) {
                $searchItems[7] = 'format';
            }
            if ( ! in_array('series', $searchItems) ) {
                $searchItems[8] = 'series';
            }
            if ( ! in_array('isbn13', $searchItems) ) {
                $searchItems[9] = 'isbn13';
            }
            if ( ! in_array('tags', $searchItems) ) {
                $searchItems[10] = 'tags';
            }

        } else {

            $searchItems = array( 'title', 'isbn', 'category', 'year', 'language',  'author', 'publisher', 'format', 'series', 'isbn13', 'tags' );
        }

        return apply_filters( 'wbg_search_items', $searchItems );
    }

    protected function wbg_search_content_option_fileds() {

        return [
            [
                'name'      => 'wbg_display_search_panel',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_search_title',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_search_title_placeholder',
                'type'      => 'text',
                'default'   => 'Book Title',
            ],
            [
                'name'      => 'wbg_display_search_isbn',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_search_isbn_placeholder',
                'type'      => 'text',
                'default'   => 'ISBN-10',
            ],
            [
                'name'      => 'wbg_display_search_category',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_category_order',
                'type'      => 'string',
                'default'   => 'asc',
            ],
            [
                'name'      => 'wbg_search_category_default',
                'type'      => 'text',
                'default'   => 'All Categories',
            ],
            [
                'name'      => 'wbg_display_search_author',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_author_order',
                'type'      => 'string',
                'default'   => 'asc',
            ],
            [
                'name'      => 'wbg_search_author_default',
                'type'      => 'text',
                'default'   => 'All Authors',
            ],
            [
                'name'      => 'wbg_display_search_publisher',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_publisher_order',
                'type'      => 'string',
                'default'   => 'asc',
            ],
            [
                'name'      => 'wbg_search_publishers_default',
                'type'      => 'text',
                'default'   => 'All Publishers',
            ],
            [
                'name'      => 'wbg_display_search_year',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_year_order',
                'type'      => 'string',
                'default'   => 'asc',
            ],
            [
                'name'      => 'wbg_search_year_default',
                'type'      => 'text',
                'default'   => 'All Years',
            ],
            [
                'name'      => 'wbg_display_search_language',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_language_order',
                'type'      => 'string',
                'default'   => 'asc',
            ],
            [
                'name'      => 'wbg_search_language_default',
                'type'      => 'text',
                'default'   => 'All Languages',
            ],
            [
                'name'      => 'wbgp_display_book_format',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbgp_book_format_order',
                'type'      => 'string',
                'default'   => 'asc',
            ],
            [
                'name'      => 'wbgp_book_format_default_option',
                'type'      => 'text',
                'default'   => 'All Formats',
            ],
            [
                'name'      => 'wbgp_display_book_series',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbgp_book_series_order',
                'type'      => 'string',
                'default'   => 'asc',
            ],
            [
                'name'      => 'wbgp_book_series_default_option',
                'type'      => 'text',
                'default'   => 'All Series',
            ],
            [
                'name'      => 'wbg_search_btn_txt',
                'type'      => 'text',
                'default'   => 'Search Books',
            ],
            [
                'name'      => 'wbg_display_search_isbn13',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_search_isbn13_placeholder',
                'type'      => 'text',
                'default'   => 'ISBN-13',
            ],
            [
                'name'      => 'wbg_display_search_tags',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_search_tags_placeholder',
                'type'      => 'text',
                'default'   => 'Tags',
            ],
        ];
    }
}