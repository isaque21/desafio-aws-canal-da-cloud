<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$search_dad_list = $this->get_search_items();
// Setting up the search form url
if ( '' === $wbg_gallery_page_slug ) {
    $wbg_gallery_page_slug = 'books';
}
$wbg_gallery_page_slug = ( isset( $attr['url'] ) ? $attr['url'] : $wbg_gallery_page_slug );
// Search Items
$wbg_title_s = ( isset( $_GET['wbg_title_s'] ) ? sanitize_text_field( $_GET['wbg_title_s'] ) : '' );
$wbg_category_s = ( isset( $_GET['wbg_category_s'] ) ? sanitize_text_field( $_GET['wbg_category_s'] ) : '' );
$wbg_author_s = ( isset( $_GET['wbg_author_s'] ) ? sanitize_text_field( $_GET['wbg_author_s'] ) : '' );
$wbg_publisher_s = ( isset( $_GET['wbg_publisher_s'] ) ? sanitize_text_field( $_GET['wbg_publisher_s'] ) : '' );
$wbg_published_on_s = ( isset( $_GET['wbg_published_on_s'] ) ? sanitize_text_field( $_GET['wbg_published_on_s'] ) : '' );
$wbg_language_s = ( isset( $_GET['wbg_language_s'] ) ? sanitize_text_field( $_GET['wbg_language_s'] ) : '' );
$wbg_isbn_s = ( isset( $_GET['wbg_isbn_s'] ) ? sanitize_text_field( $_GET['wbg_isbn_s'] ) : '' );
// Search Query
if ( '' != $wbg_title_s ) {
    $wbgBooksArr['s'] = $wbg_title_s;
}
if ( '' !== $wbg_category_s ) {
    $wbgBooksArr['tax_query'] = array( array(
        'taxonomy' => 'book_category',
        'field'    => 'name',
        'terms'    => $wbg_category_s,
    ) );
}
if ( '' != $wbg_author_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_author',
        'value'   => $wbg_author_s,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_publisher_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_publisher',
        'value'   => $wbg_publisher_s,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_isbn_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_isbn',
        'value'   => $wbg_isbn_s,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_language_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_language',
        'value'   => $wbg_language_s,
        'compare' => '=',
    ) );
}
if ( '' != $wbg_published_on_s ) {
    $wbgBooksArr['meta_query'] = array( array(
        'key'     => 'wbg_published_on',
        'value'   => $wbg_published_on_s,
        'compare' => 'LIKE',
    ) );
}

if ( '' !== $wbg_category_s ) {
    $wbg_authors_by_cat = "SELECT DISTINCT pm.meta_value\r\n                        FROM {$wpdb->posts} p\r\n                        LEFT JOIN {$wpdb->term_relationships} rel ON rel.object_id = p.ID\r\n                        LEFT JOIN {$wpdb->term_taxonomy} tax ON tax.term_taxonomy_id = rel.term_taxonomy_id\r\n                        LEFT JOIN {$wpdb->terms} t ON t.term_id = tax.term_id\r\n                        LEFT JOIN {$wpdb->postmeta} pm ON pm.post_id = p.ID\r\n                        WHERE post_status = 'publish'\r\n                        AND post_type = 'books'\r\n                        AND t.name = '" . $wbg_category_s . "'\r\n                        AND tax.taxonomy = 'book_category'\r\n                        AND pm.meta_key = 'wbg_author'\r\n                        ORDER BY pm.meta_value {$wbg_display_author_order}";
    $wbg_authors = $wpdb->get_results( $wbg_authors_by_cat, ARRAY_A );
} else {
    $wbg_authors = $wpdb->get_results( "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} pm, {$wpdb->posts} p WHERE meta_key = 'wbg_author' and p.post_type = 'books' ORDER BY meta_value {$wbg_display_author_order}", ARRAY_A );
}

?>
<form method="GET" action="<?php 
echo  esc_url( home_url( '/' . $wbg_gallery_page_slug ) ) ;
?>" id="wbg-search-form">
  <?php 
//if(function_exists('wp_nonce_field')) { wp_nonce_field('wbg_nonce_field'); }
?>
  <div class="wrap wbg-search-container">
    <?php 
foreach ( $search_dad_list as $search_item ) {
    if ( 'title' === $search_item ) {
        
        if ( $wbg_display_search_title ) {
            ?>
          <div class="wbg-search-item">
            <input type="text" name="wbg_title_s" placeholder="<?php 
            esc_attr_e( $wbg_display_search_title_placeholder );
            ?>" value="<?php 
            esc_attr_e( stripslashes( $wbg_title_s ) );
            ?>">
          </div>
          <?php 
        }
    
    }
    // title ends
    if ( 'isbn' === $search_item ) {
        
        if ( $wbg_display_search_isbn ) {
            ?>
          <div class="wbg-search-item">
            <input type="text" name="wbg_isbn_s" placeholder="<?php 
            esc_attr_e( $wbg_display_search_isbn_placeholder );
            ?>" value="<?php 
            echo  esc_attr( $wbg_isbn_s ) ;
            ?>">
          </div>
          <?php 
        }
    
    }
    if ( 'category' === $search_item ) {
        
        if ( $wbg_display_search_category ) {
            ?>
          <div class="wbg-search-item">
            <select id="wbg_category_s" name="wbg_category_s" class="wbg-selectize">
                <option value=""><?php 
            esc_html_e( $wbg_search_category_default );
            ?></option>
                <?php 
            $wbg_book_categories = get_terms( array(
                'taxonomy'   => 'book_category',
                'hide_empty' => true,
                'order'      => $wbg_display_category_order,
                'parent'     => 0,
            ) );
            foreach ( $wbg_book_categories as $book_category ) {
                ?>
                  <option value="<?php 
                echo  esc_attr( $book_category->name ) ;
                ?>" <?php 
                echo  ( $wbg_category_s == $book_category->name ? 'Selected' : '' ) ;
                ?> ><?php 
                esc_html_e( $book_category->name );
                ?></option>
                  <?php 
                $loterms = get_terms( array(
                    'taxonomy'   => 'book_category',
                    'hide_empty' => true,
                    'order'      => $wbg_display_category_order,
                    'parent'     => $book_category->term_id,
                ) );
                if ( $loterms ) {
                    foreach ( $loterms as $key => $loterm ) {
                        ?>
                      <option value="<?php 
                        echo  esc_attr( $loterm->name ) ;
                        ?>" <?php 
                        echo  ( $wbg_category_s == $loterm->name ? 'Selected' : '' ) ;
                        ?> >- <?php 
                        esc_html_e( $loterm->name );
                        ?></option>
                      <?php 
                    }
                }
            }
            ?>
            </select>
          </div>
          <?php 
        }
    
    }
    // category ends
    if ( 'year' === $search_item ) {
        
        if ( $wbg_display_search_year ) {
            ?>
          <div class="wbg-search-item">
              <select id="wbg_published_on_s" name="wbg_published_on_s" class="wbg-selectize">
                  <option value=""><?php 
            esc_html_e( $wbg_search_year_default );
            ?></option>
                  <?php 
            $wbg_years = $wpdb->get_results( "SELECT DISTINCT YEAR(meta_value) year FROM {$wpdb->postmeta} pm, {$wpdb->posts} p WHERE meta_key = 'wbg_published_on' and p.post_type = 'books' ORDER BY meta_value {$wbg_display_year_order}", ARRAY_A );
            foreach ( $wbg_years as $year ) {
                
                if ( NULL != $year['year'] ) {
                    ?>
                      <option value="<?php 
                    echo  esc_attr( $year['year'] ) ;
                    ?>" <?php 
                    echo  ( $wbg_published_on_s == $year['year'] ? "Selected" : "" ) ;
                    ?> ><?php 
                    echo  esc_html( $year['year'] ) ;
                    ?></option>
                      <?php 
                }
            
            }
            ?>
              </select>
          </div>
          <?php 
        }
    
    }
    // year ends
    if ( 'language' === $search_item ) {
        
        if ( $wbg_display_search_language ) {
            ?>
            <div class="wbg-search-item">
                <select id="wbg_language_s" name="wbg_language_s" class="wbg-selectize">
                    <option value=""><?php 
            esc_html_e( $wbg_search_language_default );
            ?></option>
                    <?php 
            $wbg_languages = $wpdb->get_results( "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} pm, {$wpdb->posts} p WHERE meta_key = 'wbg_language' and p.post_type = 'books' ORDER BY meta_value {$wbg_display_language_order}", ARRAY_A );
            foreach ( $wbg_languages as $lang ) {
                ?>
                        <option value="<?php 
                echo  esc_attr( $lang['meta_value'] ) ;
                ?>" <?php 
                echo  ( $wbg_language_s == $lang['meta_value'] ? "Selected" : "" ) ;
                ?> ><?php 
                echo  esc_html( $lang['meta_value'] ) ;
                ?></option>
                    <?php 
            }
            ?>
                </select>
            </div>
            <?php 
        }
    
    }
    // language ends
    if ( 'author' === $search_item ) {
        
        if ( $wbg_display_search_author ) {
            ?>
            <div class="wbg-search-item">
              <select id="wbg_author_s" name="wbg_author_s" class="wbg-selectize">
                  <option value=""><?php 
            esc_html_e( $wbg_search_author_default );
            ?></option>
                  <?php 
            foreach ( $wbg_authors as $author ) {
                ?>
                    <option value="<?php 
                echo  esc_attr( $author['meta_value'] ) ;
                ?>" <?php 
                echo  ( $wbg_author_s == $author['meta_value'] ? "Selected" : "" ) ;
                ?> ><?php 
                echo  esc_html( $author['meta_value'] ) ;
                ?></option>
                  <?php 
            }
            ?>
              </select>
            </div>
            <?php 
        }
    
    }
    // author ends
    if ( 'publisher' === $search_item ) {
        
        if ( $wbg_display_search_publisher ) {
            ?>
            <div class="wbg-search-item">
              <select id="wbg_publisher_s" name="wbg_publisher_s" class="wbg-selectize">
                  <option value=""><?php 
            esc_html_e( $wbg_search_publishers_default );
            ?></option>
                  <?php 
            $wbg_publishers = $wpdb->get_results( "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} pm, {$wpdb->posts} p WHERE meta_key = 'wbg_publisher' and p.post_type = 'books' ORDER BY meta_value {$wbg_display_publisher_order}", ARRAY_A );
            foreach ( $wbg_publishers as $publisher ) {
                ?>
                    <option value="<?php 
                echo  esc_attr( $publisher['meta_value'] ) ;
                ?>" <?php 
                echo  ( $wbg_publisher_s == $publisher['meta_value'] ? "Selected" : "" ) ;
                ?> ><?php 
                echo  esc_html( $publisher['meta_value'] ) ;
                ?></option>
                  <?php 
            }
            ?>
              </select>
            </div>
            <?php 
        }
    
    }
}
// foreach ( $search_dad_list as $search_item )
apply_filters( 'wbg_front_search_load_items', $search_item );
?>

    <div class="wbg-search-item">
      <input type="submit" class="button submit-btn" value="<?php 
esc_attr_e( $wbg_search_btn_txt );
?>">
    </div>
    <div class="wbg-search-item refresh">
      <a href="<?php 
echo  esc_url( home_url( '/' . $wbg_gallery_page_slug ) ) ;
?>" class="fa fa-refresh" id="wbg-search-refresh"></a>
    </div>

  </div>
</form>