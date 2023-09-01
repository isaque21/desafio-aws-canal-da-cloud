<?php
/**
 * Plugin Name:	        WordPress Books Gallery
 * Plugin URI:	        https://wordpress.org/plugins/wp-books-gallery/
 * Description:	        Best Books Showcase & Library Plugin for WordPress which will build a beautiful mobile-friendly Book Store, Gallery, Library in a few minutes.
 * Version:		        4.5.5
 * Author:		        HM Plugin
 * Author URI:	        https://hmplugin.com
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Tested up to:        6.2.2
 * Text Domain:         wp-books-gallery
 * Domain Path:         /languages/
 * License:		        GPL-2.0+
 * License URI:	        http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( function_exists('wbg_fs') ) {

    wbg_fs()->set_basename(true, __FILE__);

} else {

    if ( ! class_exists('WBG_Master') ) {
    
        define( 'WBG_PATH', plugin_dir_path( __FILE__ ) );
        define( 'WBG_ASSETS', plugins_url('/assets/', __FILE__) );
        define( 'WBG_SLUG', plugin_basename( __FILE__ ) );
        define( 'WBG_PRFX', 'wbg_' );
        define( 'WBG_CLS_PRFX', 'cls-books-gallery-' );
        define( 'WBG_TXT_DOMAIN', 'wp-books-gallery' );
        define( 'WBG_VERSION', '4.5.5' );

        require_once WBG_PATH . "/lib/freemius-integrator.php";

        require_once WBG_PATH . 'inc/' . WBG_CLS_PRFX . 'master.php';
        $wbg = new WBG_Master();
        $wbg->wbg_run();

        // Creating Default Page
        /*
        function wbg_create_default_page() {
        
            $wbg_page   = 'Books';
            $wbg_page_exist = get_page_by_title($wbg_page , 'OBJECT', 'page');
            $post_content     = '[wp_books_gallery]';
            if ( empty( $wbg_page_exist ) ) {
                wp_insert_post( array(
                    'comment_status' => 'close',
                    'ping_status'    => 'close',
                    'post_author'    => 1,
                    'post_title'     => ucwords( $wbg_page ),
                    'post_name'      => sanitize_title( $wbg_page ),
                    'post_status'    => 'publish',
                    'post_content'   => $post_content,
                    'post_type'      => 'page',
                    'post_parent'    => ''
                    )
                );
            }
        }
        add_action( 'init', 'wbg_create_default_page' );
        */
        
        // Extra link to plugin description
        add_filter( 'plugin_row_meta', 'wbg_plugin_row_meta', 10, 2 );
        function wbg_plugin_row_meta( $links, $file ) {

            if ( WBG_SLUG === $file ) {
                $row_meta = array(
                'wbg_donation'    => '<a href="' . esc_url( 'https://www.paypal.me/mhmrajib/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Plugin Additional Links', 'wp-books-gallery' ) . '" style="color:green; font-weight: bold;">' . esc_html__( 'Donate us', 'wp-books-gallery' ) . '</a>'
                );
        
                return array_merge( $links, $row_meta );
            }
            return (array) $links;
        }

        // rewrite_rules upon plugin activation
        register_activation_hook( __FILE__, 'wbg_myplugin_activate' );
        function wbg_myplugin_activate() {
            if ( ! get_option( 'wbg_flush_rewrite_rules_flag' ) ) {
                add_option( 'wbg_flush_rewrite_rules_flag', true );
            }
        }

        add_action( 'init', 'wbg_flush_rewrite_rules_maybe', 10 );
        function wbg_flush_rewrite_rules_maybe() {
            if( get_option( 'wbg_flush_rewrite_rules_flag' ) ) {
                flush_rewrite_rules();
                delete_option( 'wbg_flush_rewrite_rules_flag' );
            }
        }

        // include your custom post type on category and tags pages
        function wbg_custom_post_type_cat_filter( $query ) {
            
            global $pagenow;
            
            $type = 'post';
            if ( isset( $_GET['post_type'] ) ) {
                $type = $_GET['post_type'];
            }
            if ( is_category() && ( ! isset( $query->query_vars['suppress_filters'] ) || false == $query->query_vars['suppress_filters'] ) ) {
                $query->set( 'post_type', array( 'post', 'books' ) );
            }
            if ( $query->is_tag() && $query->is_main_query() ) {
            
                $query->set( 'post_type', array( 'post', 'books' ) );
            }
            if ( is_admin() && 'books' == $type && $query->is_main_query() && $pagenow == 'edit.php' ) {
                $query->set( 'post_type', 'books' );
            }
            if ( is_admin() && 'post' == $type && $query->is_main_query() && $pagenow == 'edit.php' ) {
                $query->set( 'post_type', 'post' );
            }

            return $query;
        }
        add_action('pre_get_posts', 'wbg_custom_post_type_cat_filter');

        // Add Columns to logo list table
        function wbg_add_logo_columns( $columns ) {
            
            unset( $columns['author'] );
			unset( $columns['comments'] );
            unset( $columns['title'] );
            unset( $columns['categories'] );
            unset( $columns['tags'] );
            unset( $columns['taxonomy-book_category'] );
            unset( $columns['taxonomy-book_format'] );
            unset( $columns['taxonomy-book_series'] );
            unset( $columns['taxonomy-reading_age'] );
            unset( $columns['taxonomy-grade_level'] );
            unset( $columns['taxonomy-book_author'] );
            unset( $columns['date'] );
        
            return array_merge ( 
                $columns, 
                array ( 
                    'cover'                     => __('Book Cover', WBG_TXT_DOMAIN),
                    'title'                     => __('Book Title', WBG_TXT_DOMAIN),
                    'taxonomy-book_category'    => __('Book Category', WBG_TXT_DOMAIN),
                    'author_main'                    => __('Author', WBG_TXT_DOMAIN),
                    'tags'                      => __('Tags', WBG_TXT_DOMAIN),
                    'status'                    => __('Book Status', WBG_TXT_DOMAIN),
                    'date'                      => __('Published Date', WBG_TXT_DOMAIN),
                ) 
            );
        
        }
        add_filter('manage_books_posts_columns', 'wbg_add_logo_columns');

        // Add Data To Custom Post Type Columns
        function wbg_logo_column_data( $column, $post_id ) {

            switch ( $column ) {
                case 'cover':
                    $wbg_img    = get_post_meta( $post_id, 'wbgp_img_url', true );
                    if ( $wbg_img ) {
                        ?>
                        <img src="<?php echo esc_url( $wbg_img ); ?>" alt="<?php _e('No Image Available', WBG_TXT_DOMAIN); ?>" width="50">
                        <?php
                    } else {
                        echo get_the_post_thumbnail( $post_id, array( 50, 150 ), array( 'class' => 'wbg-admin-book-cover-list' ) );
                    }
                    break;
        
                case 'author_main':
                    echo get_post_meta( $post_id, 'wbg_author', true );
                    break;
        
                case 'status':
                    echo ( 'active' !== get_post_meta( $post_id , 'wbg_status' , true ) ) ? '<b style="color:red;">' . __('Inactive', WBG_TXT_DOMAIN) . '</b>' : '<b style="color:green;">' . __('Active', WBG_TXT_DOMAIN) . '</b>';
                    break;
    
            }
            
        }
        add_action('manage_books_posts_custom_column' , 'wbg_logo_column_data', 10, 2);
    }
}