<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( !function_exists( 'wbg_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wbg_fs()
    {
        global  $wbg_fs ;
        
        if ( !isset( $wbg_fs ) ) {
            // Include Freemius SDK.
            require_once WBG_PATH . '/freemius/start.php';
            $wbg_fs = fs_dynamic_init( array(
                'id'             => '8841',
                'slug'           => 'wp-books-gallery',
                'type'           => 'plugin',
                'public_key'     => 'pk_0a8ec2eb28cd4919f2bed771a51da',
                'is_premium'     => false,
                'has_addons'     => false,
                'has_paid_plans' => true,
                'menu'           => array(
                'slug'       => 'edit.php?post_type=books',
                'first-path' => 'edit.php?post_type=books&page=wbg-get-help',
            ),
                'is_live'        => true,
            ) );
        }
        
        return $wbg_fs;
    }
    
    // Init Freemius.
    wbg_fs();
    // Signal that SDK was initiated.
    do_action( 'wbg_fs_loaded' );
    function wbg_fs_support_forum_url( $wp_support_url )
    {
        return 'https://wordpress.org/support/plugin/wp-books-gallery/';
    }
    
    wbg_fs()->add_filter( 'support_forum_url', 'wbg_fs_support_forum_url' );
    function wbg_fs_custom_connect_message_on_update(
        $message,
        $user_first_name,
        $plugin_title,
        $user_login,
        $site_link,
        $freemius_link
    )
    {
        return sprintf(
            __( 'Hey %1$s' ) . ',<br>' . __( 'Please help us improve %2$s! If you opt-in, some data about your usage of %2$s will be sent to %5$s. If you skip this, that\'s okay! %2$s will still work just fine.', WBG_TXT_DOMAIN ),
            $user_first_name,
            '<b>' . $plugin_title . '</b>',
            '<b>' . $user_login . '</b>',
            $site_link,
            $freemius_link
        );
    }
    
    wbg_fs()->add_filter(
        'connect_message_on_update',
        'wbg_fs_custom_connect_message_on_update',
        10,
        6
    );
    function wbg_fs_uninstall_cleanup()
    {
        global  $wpdb ;
        $tbl = $wpdb->prefix . 'options';
        $search_string = 'wbg_%';
        $sql = $wpdb->prepare( "SELECT option_name FROM {$tbl} WHERE option_name LIKE %s", $search_string );
        $options = $wpdb->get_results( $sql, OBJECT );
        if ( is_array( $options ) && count( $options ) ) {
            foreach ( $options as $option ) {
                delete_option( $option->option_name );
                delete_site_option( $option->option_name );
            }
        }
    }
    
    wbg_fs()->add_action( 'after_uninstall', 'wbg_fs_uninstall_cleanup' );
}
