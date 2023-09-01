<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$wbg_search_settings = get_option( 'wbg_search_settings' );

if ( empty($wbg_search_settings) ) {
    $wbg_display_search_panel = 1;
    $wbg_display_search_title = 1;
    $wbg_display_search_isbn = 1;
    $wbg_display_search_category = 1;
    $wbg_display_search_author = 1;
}

$wbg_general_settings = get_option( 'wbg_general_settings' );

if ( empty($wbg_general_settings) ) {
    $wbg_display_description = 1;
    $wbg_display_category = 1;
    $wbg_display_author = 1;
    $wbg_display_buynow = 1;
}

// Load Styling
include WBG_PATH . 'assets/css/gallery.php';
// Gallery Settings Content
$wbg_details_is_external = ( $wbg_details_is_external ? ' target="_blank"' : '' );
$wbg_dwnld_btn_url_same_tab = ( !$wbg_dwnld_btn_url_same_tab ? 'target="_blank"' : '' );
// Shortcoded Options
$wbg_author = '';
$wbg_language = '';
$wbgCategory = ( isset( $attr['category'] ) ? $attr['category'] : '' );
$wbgDisplay = ( isset( $attr['isdisplay'] ) ? $attr['isdisplay'] : $wbg_books_per_page );
$wbgPagination = ( isset( $attr['ispagination'] ) ? $attr['ispagination'] : $wbg_display_pagination );
// true/0
$wbgLayout = ( isset( $attr['layout'] ) ? $attr['layout'] : '' );

if ( is_front_page() ) {
    $wbgPaged = ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
} else {
    $wbgPaged = ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
}

// Main Query Arguments
$wbg_front_search_query_array = array(
    'post_type'   => 'books',
    'post_status' => 'publish',
    'order'       => $wbg_books_order,
    'orderby'     => $wbg_gallary_sorting,
    'meta_query'  => array( array(
    'key'     => 'wbg_status',
    'value'   => 'active',
    'compare' => '=',
) ),
);
$wbgBooksArr = apply_filters( 'wbg_front_search_query_array', $wbg_front_search_query_array );
// If display params found in shortcode
if ( $wbgDisplay != '' ) {
    $wbgBooksArr['posts_per_page'] = $wbgDisplay;
}
// If Pagination found in shortcode
if ( $wbgPagination ) {
    $wbgBooksArr['paged'] = $wbgPaged;
}
// If Category params found in shortcode
if ( $wbgCategory != '' ) {
    $wbgBooksArr['tax_query'] = array( array(
        'taxonomy' => 'book_category',
        'field'    => 'name',
        'terms'    => $wbgCategory,
    ) );
}
// For Template Category

if ( is_tax( 'book_category' ) ) {
    $wbg_archive_cat_slug = ( isset( get_queried_object()->slug ) ? get_queried_object()->slug : '' );
    if ( $wbg_archive_cat_slug != '' ) {
        $wbgBooksArr['tax_query'] = array( array(
            'taxonomy' => 'book_category',
            'field'    => 'slug',
            'terms'    => $wbg_archive_cat_slug,
        ) );
    }
}

// For Template Tag

if ( is_tag() ) {
    $wbg_tag_for_temp = ( isset( get_queried_object()->slug ) ? get_queried_object()->slug : '' );
    if ( '' !== $wbg_tag_for_temp ) {
        $wbgBooksArr['tag'] = $wbg_tag_for_temp;
    }
}

// Front Sorting Operation
// Sorting Operation
$wbg_orderby_arr = [ 'title', 'date', 'rand' ];
if ( !in_array( $wbg_gallary_sorting, $wbg_orderby_arr ) ) {
    $wbgBooksArr['meta_key'] = $wbg_gallary_sorting;
}

if ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'price' ) {
    $wbgBooksArr['meta_key'] = 'wbgp_regular_price';
    $wbgBooksArr['orderby'] = 'meta_value_num';
    $wbgBooksArr['meta_type'] = 'DECIMAL';
    $wbgBooksArr['order'] = 'ASC';
}


if ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'price-desc' ) {
    $wbgBooksArr['meta_key'] = 'wbgp_regular_price';
    $wbgBooksArr['orderby'] = 'meta_value_num';
    $wbgBooksArr['meta_type'] = 'DECIMAL';
    $wbgBooksArr['order'] = 'DESC';
}


if ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'date' ) {
    $wbgBooksArr['orderby'] = 'date';
    $wbgBooksArr['order'] = 'DESC';
    $wbgBooksArr['suppress_filters'] = true;
}


if ( isset( $_GET['orderby'] ) && $_GET['orderby'] === 'default' ) {
    $wbgBooksArr['orderby'] = $wbg_gallary_sorting;
    $wbgBooksArr['order'] = $wbg_books_order;
    $wbgBooksArr['suppress_filters'] = true;
}

//echo '<pre>';
//print_r($wbgBooksArr);
?>
<div class="wbg-parent-wrapper">
  <?php 
// Search Panel Started
if ( $wbg_display_search_panel ) {
    include WBG_PATH . 'front/view/search.php';
}
// Main Query
$wbgBooks = new WP_Query( $wbgBooksArr );

if ( $wbgBooks->have_posts() ) {
    
    if ( $wbg_display_total_books ) {
        $wbg_prev_posts = ($wbgPaged - 1) * $wbgBooks->query_vars['posts_per_page'];
        $wbg_from = 1 + $wbg_prev_posts;
        $wbg_to = count( $wbgBooks->posts ) + $wbg_prev_posts;
        $wbg_of = $wbgBooks->found_posts;
        ?>
        <div class="wbg-total-books-title">
          <?php 
        _e( 'Showing', WBG_TXT_DOMAIN );
        ?> <span><?php 
        printf(
            '%s-%s of %s',
            $wbg_from,
            $wbg_to,
            $wbg_of
        );
        ?></span> <?php 
        _e( 'Books', WBG_TXT_DOMAIN );
        ?>
        </div>
        <?php 
    }
    
    ?>
    <div class="wbg-main-wrapper <?php 
    echo  'wbg-product-column-' . esc_attr( $wbg_gallary_column ) . ' wbg-product-column-mobile-' . esc_attr( $wbg_gallary_column_mobile ) ;
    ?> <?php 
    echo  ( 'list' !== $wbg_gallary_template ? 'grid' : $wbg_gallary_template ) ;
    ?>">
      <?php 
    while ( $wbgBooks->have_posts() ) {
        $wbgBooks->the_post();
        $wbgImgUrl = get_post_meta( $post->ID, 'wbgp_img_url', true );
        //apply_filters( 'wbg_image_url', $post->ID );
        $wbg_book_cover_size_imp = 200;
        $wbg_book_cover_resulution = 'thumbnail';
        if ( 'default' === $wbg_book_cover_size ) {
            $wbg_book_cover_resulution = [ 0, 200 ];
        }
        
        if ( 'thumbnail' === $wbg_book_cover_size ) {
            $wbg_book_cover_resulution = 'thumbnail';
            $wbg_book_cover_size_imp = 150;
        }
        
        
        if ( 'medium' === $wbg_book_cover_size ) {
            $wbg_book_cover_resulution = 'medium';
            $wbg_book_cover_size_imp = 300;
        }
        
        
        if ( 'full' === $wbg_book_cover_size ) {
            $wbg_book_cover_resulution = [ 0, 500 ];
            $wbg_book_cover_size_imp = 500;
        }
        
        $wbg_default_book_cover_url = ( '' !== $wbg_default_book_cover_url ? $wbg_default_book_cover_url : WBG_ASSETS . 'img/noimage.jpg' );
        $feat_image = '<img src="' . esc_url( $wbg_default_book_cover_url ) . '" alt="' . get_the_title() . '" style="height:' . $wbg_book_cover_size_imp . 'px; object-fit: fill;">';
        
        if ( 'f' === $wbg_book_cover_priority ) {
            
            if ( has_post_thumbnail() ) {
                $feat_image = get_the_post_thumbnail( $post->ID, $wbg_book_cover_resulution );
            } else {
                if ( $wbgImgUrl ) {
                    $feat_image = '<img src="' . esc_url( $wbgImgUrl ) . '" alt="' . get_the_title() . '" style="height:' . $wbg_book_cover_size_imp . 'px; object-fit: fill;">';
                }
            }
        
        } else {
            
            if ( $wbgImgUrl ) {
                $feat_image = '<img src="' . esc_url( $wbgImgUrl ) . '" alt="' . get_the_title() . '" style="height:' . $wbg_book_cover_size_imp . 'px; object-fit: fill;">';
            } else {
                if ( has_post_thumbnail() ) {
                    $feat_image = get_the_post_thumbnail( $post->ID, $wbg_book_cover_resulution );
                }
            }
        
        }
        
        if ( 'grid' === $wbg_gallary_template ) {
            include 'gallery/layout/grid.php';
        }
        if ( 'list' === $wbg_gallary_template ) {
            include 'gallery/layout/list.php';
        }
        if ( 'grid-classic' === $wbg_gallary_template ) {
            include 'gallery/layout/grid-classic.php';
        }
    }
    ?>
    </div>
    <?php 
    if ( $wbgPagination ) {
        $this->loop_fotter_content( $wbgBooks->max_num_pages, $wbgPaged );
    }
} else {
    
    if ( '' !== $wbg_no_book_message ) {
        ?>
      <p class="wbg-no-books-found"><?php 
        esc_html_e( $wbg_no_book_message );
        ?></p>
      <?php 
    }

}

// Reset Post Data
wp_reset_postdata();
?>
</div>
