<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
* Trait: Slide Settings
*/
trait Wbg_Gallery_Settings_Content
{
    protected $fields, $settings, $options;
    
    protected function wbg_set_gallery_settings_content( $post ) {

        $this->fields   = $this->wbg_gallery_option_fileds_content();

        $this->options  = $this->wbg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'wbg_gallary_settings', $this->options, $post );

        return update_option( 'wbg_general_settings', serialize( $this->settings ) );

    }

    public function wbg_get_gallery_settings_content() {

        $this->fields   = $this->wbg_gallery_option_fileds_content();
		$this->settings = stripslashes_deep( unserialize( get_option('wbg_general_settings') ) );
        
        return $this->wbg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function wbg_gallery_option_fileds_content() {

        return [
            [
                'name'      => 'wbg_gallary_template',
                'type'      => 'string',
                'default'   => 'grid',
            ],
            [
                'name'      => 'wbg_gallary_column',
                'type'      => 'number',
                'default'   => 4,
            ],
            [
                'name'      => 'wbg_gallary_column_mobile',
                'type'      => 'number',
                'default'   => 1,
            ],
            [
                'name'      => 'wbg_book_cover_width',
                'type'      => 'string',
                'default'   => 'default',
            ],
            [
                'name'      => 'wbg_book_cover_size',
                'type'      => 'string',
                'default'   => 'medium-full',
            ],
            [
                'name'      => 'wbg_book_image_animation',
                'type'      => 'string',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_gallary_sorting',
                'type'      => 'string',
                'default'   => 'title',
            ],
            [
                'name'      => 'wbg_books_order',
                'type'      => 'string',
                'default'   => 'ASC',
            ],
            [
                'name'      => 'wbg_display_details_page',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_details_is_external',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_title_length',
                'type'      => 'number',
                'default'   => 5,
            ],
            [
                'name'      => 'wbg_display_category',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_cat_label_txt',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_display_author',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_author_label_txt',
                'type'      => 'text',
                'default'   => '',
            ],
            [
                'name'      => 'wbg_display_edition_gallery',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_edition_label_txt',
                'type'      => 'text',
                'default'   => 'Edition',
            ],
            [
                'name'      => 'wbg_display_publish_date_gallery',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_publish_date_label_txt',
                'type'      => 'text',
                'default'   => 'Published On',
            ],
            [
                'name'      => 'wbg_display_description',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_description_length',
                'type'      => 'number',
                'default'   => 20,
            ],
            [
                'name'      => 'wbg_display_buynow',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_buynow_btn_txt',
                'type'      => 'text',
                'default'   => 'Download',
            ],
            [
                'name'      => 'wbg_display_buy_now',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_buy_now_btn_txt',
                'type'      => 'text',
                'default'   => 'Buy Now',
            ],
            [
                'name'      => 'wbg_display_total_books',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_sorting',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_books_per_page',
                'type'      => 'number',
                'default'   => 10,
            ],
            [
                'name'      => 'wbg_display_pagination',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbgp_currency',
                'type'      => 'string',
                'default'   => 'USD',
            ],
            [
                'name'      => 'wbg_display_rating',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_display_pagination_np',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'wbg_books_per_page_np',
                'type'      => 'number',
                'default'   => 10,
            ],
            [
                'name'      => 'wbg_gallery_button_bottom_align',
                'type'      => 'boolean',
                'default'   => false,
            ],
        ];
    }

    function loop_fotter_content( $total, $page ) {
        ?>
        <div class="wbg-pagination">
            <?php
            if ( $total > 1 ) {

            $wbgPaginateBig = 999999999; // need an unlikely integer
            $wbgPaginateArgs = array(
                'base' => str_replace( $wbgPaginateBig, '%#%', esc_url( get_pagenum_link( $wbgPaginateBig ) ) ),
                'format' => '?page=%#%',
                'total' => $total,
                'current' => max( 1, $page ),
                'end_size' => 1,
                'mid_size' => 2,
                'prev_text' => __('« '),
                'next_text' => __(' »'),
                'type' => 'list',
            );
            echo paginate_links( $wbgPaginateArgs );
            }
            ?>
        </div>
        <?php
    }
}