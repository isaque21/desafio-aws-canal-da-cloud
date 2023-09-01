<?php
/**
 * Add theme dashboard page
 */
/**
 * Get theme actions required
 *
 * @return array|mixed|void
 */
if (!function_exists('envo_ecommerce_get_actions_required')) :

    function envo_ecommerce_get_actions_required() {

        $actions = array();
        $actions['recommend_plugins'] = 'dismiss';

        $recommend_plugins = get_theme_support('recommend-plugins');
        if (is_array($recommend_plugins) && isset($recommend_plugins[0])) {
            $recommend_plugins = $recommend_plugins[0];
        } else {
            $recommend_plugins[] = array();
        }

        if (!empty($recommend_plugins)) {

            foreach ($recommend_plugins as $plugin_slug => $plugin_info) {
                $plugin_info = wp_parse_args($plugin_info, array(
                    'name' => '',
                    'active_filename' => '',
                ));
                if ($plugin_info['active_filename']) {
                    $active_file_name = $plugin_info['active_filename'];
                } else {
                    $active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
                }
                if (!is_plugin_active($active_file_name)) {
                    $actions['recommend_plugins'] = 'active';
                }
            }
        }

        $actions = apply_filters('envo_ecommerce_get_actions_required', $actions);
        $hide_by_click = get_option('envo_ecommerce_actions_dismiss');
        if (!is_array($hide_by_click)) {
            $hide_by_click = array();
        }

        $n_active = $n_dismiss = 0;
        $number_notice = 0;
        foreach ($actions as $k => $v) {
            if (!isset($hide_by_click[$k])) {
                $hide_by_click[$k] = false;
            }

            if ($v == 'active') {
                $n_active ++;
                $number_notice ++;
                if ($hide_by_click[$k]) {
                    if ($hide_by_click[$k] == 'hide') {
                        $number_notice --;
                    }
                }
            } else if ($v == 'dismiss') {
                $n_dismiss ++;
            }
        }

        $return = array(
            'actions' => $actions,
            'number_actions' => count($actions),
            'number_active' => $n_active,
            'number_dismiss' => $n_dismiss,
            'hide_by_click' => $hide_by_click,
            'number_notice' => $number_notice,
        );
        if ($return['number_notice'] < 0) {
            $return['number_notice'] = 0;
        }

        return $return;
    }

endif;
add_action('switch_theme', 'envo_ecommerce_reset_actions_required');

function envo_ecommerce_reset_actions_required() {
    delete_option('envo_ecommerce_actions_dismiss');
}

if (!function_exists('envo_ecommerce_admin_scripts')) :

    /**
     * Enqueue scripts for admin page only: Theme info page
     */
    function envo_ecommerce_admin_scripts($hook) {
        wp_enqueue_style('envo-ecommerce-admin-css', get_template_directory_uri() . '/css/admin/admin.css');
        if ($hook === 'appearance_page_et_ecommerce') {
            // Add recommend plugin css
            wp_enqueue_style('plugin-install');
            wp_enqueue_script('plugin-install');
            wp_enqueue_script('updates');
            add_thickbox();
        }
    }

endif;
add_action('admin_enqueue_scripts', 'envo_ecommerce_admin_scripts');

add_action('admin_menu', 'envo_ecommerce_theme_info');

function envo_ecommerce_theme_info() {

    $actions = envo_ecommerce_get_actions_required();
    $number_count = $actions['number_notice'];

    if ($number_count > 0) {
        /* translators: %1$s: replaced with number (counter) */
        $update_label = sprintf(_n('%1$s action required', '%1$s actions required', $number_count, 'envo-ecommerce'), $number_count);
        $count = "<span class='update-plugins count-" . esc_attr($number_count) . "' title='" . esc_attr($update_label) . "'><span class='update-count'>" . number_format_i18n($number_count) . "</span></span>";
        /* translators: %s: replaced with number (counter) */
        $menu_title = sprintf(esc_html__('Envo eCommerce theme %s', 'envo-ecommerce'), $count);
    } else {
        $menu_title = esc_html__('Envo eCommerce theme', 'envo-ecommerce');
    }

    add_theme_page(esc_html__('Envo eCommerce dashboard', 'envo-ecommerce'), $menu_title, 'edit_theme_options', 'et_ecommerce', 'envo_ecommerce_theme_info_page');
}

/**
 * Add admin notice when active theme, just show one time
 *
 * @return bool|null
 */
add_action('admin_notices', 'envo_ecommerce_admin_notice');

function envo_ecommerce_admin_notice() {
    global $current_user;
    $user_id = $current_user->ID;
    $theme_data = wp_get_theme();
    if (!get_user_meta($user_id, esc_html($theme_data->get('TextDomain')) . '_notice_ignore')) {
        ?>
        <div class="notice notice-success envo-ecommerce-notice">

            <h1>
                <?php
                /* translators: %1$s: theme name, %2$s theme version */
                printf(esc_html__('Welcome to %1$s - Version %2$s', 'envo-ecommerce'), esc_html($theme_data->Name), esc_html($theme_data->Version));
                ?>
            </h1>

            <p>
                <?php
                /* translators: %1$s: theme name, %2$s link */
                printf(__('Welcome! Thank you for choosing %1$s! To fully take advantage of the best our theme can offer please make sure you visit our <a href="%2$s">Welcome page</a>', 'envo-ecommerce'), esc_html($theme_data->Name), esc_url(admin_url('themes.php?page=et_ecommerce'))); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                printf('<a href="%1$s" class="notice-dismiss dashicons dashicons-dismiss dashicons-dismiss-icon"></a>', '?' . esc_html($theme_data->get('TextDomain')) . '_notice_ignore=0');
                ?>
            </p>
            <p>
                <a href="<?php echo esc_url(admin_url('themes.php?page=et_ecommerce')) ?>" class="button button-primary button-hero" style="text-decoration: none;">
                    <?php
                    /* translators: %s theme name */
                    printf(esc_html__('Get started with %s', 'envo-ecommerce'), esc_html($theme_data->Name))
                    ?>
                </a>
            </p>
        </div>
        <div class="updated notice notice-success notice-alt is-dismissible">
            <p>
                <?php esc_html_e('Save time by importing our demo data: your website will be set up and ready to be customized in minutes.', 'envo-ecommerce'); ?>
                <?php if (is_plugin_active('envo-extra/envo-extra.php')) { ?>
                    <a href="<?php echo esc_url(admin_url('themes.php?page=envothemes-panel-install-demos')) ?>" class="button" style="text-decoration: none;">
                        <?php esc_html_e('Import demo data', 'envo-ecommerce'); ?>
                    </a>
                <?php } else { ?>
                    <a href="<?php echo esc_url(admin_url('themes.php?page=et_ecommerce&tab=import_data')) ?>" class="button" style="text-decoration: none;">
                        <?php esc_html_e('Import demo data', 'envo-ecommerce'); ?>
                    </a>
                <?php } ?>
            </p>
        </div>
        <?php
    }
}

add_action('admin_init', 'envo_ecommerce_notice_ignore');

function envo_ecommerce_notice_ignore() {
    global $current_user;
    $theme_data = wp_get_theme();
    $user_id = $current_user->ID;
    /* If user clicks to ignore the notice, add that to their user meta */
    if (isset($_GET[esc_html($theme_data->get('TextDomain')) . '_notice_ignore']) && '0' == $_GET[esc_html($theme_data->get('TextDomain')) . '_notice_ignore']) {
        add_user_meta($user_id, esc_html($theme_data->get('TextDomain')) . '_notice_ignore', 'true', true);
    }
}

function envo_ecommerce_render_recommend_plugins($recommend_plugins = array()) {
    foreach ($recommend_plugins as $plugin_slug => $plugin_info) {
        $plugin_info = wp_parse_args($plugin_info, array(
            'name' => '',
            'active_filename' => '',
            'description' => '',
        ));
        $plugin_name = $plugin_info['name'];
        $plugin_desc = $plugin_info['description'];
        $status = is_dir(WP_PLUGIN_DIR . '/' . $plugin_slug);
        $button_class = 'install-now button';
        if ($plugin_info['active_filename']) {
            $active_file_name = $plugin_info['active_filename'];
        } else {
            $active_file_name = $plugin_slug . '/' . $plugin_slug . '.php';
        }

        if (!is_plugin_active($active_file_name)) {
            $button_txt = __('Install Now', 'envo-ecommerce');
            if (!$status) {
                $install_url = wp_nonce_url(
                        add_query_arg(
                                array(
                                    'action' => 'install-plugin',
                                    'plugin' => $plugin_slug
                                ), network_admin_url('update.php')
                        ), 'install-plugin_' . $plugin_slug
                );
            } else {
                $install_url = add_query_arg(array(
                    'action' => 'activate',
                    'plugin' => rawurlencode($active_file_name),
                    'plugin_status' => 'all',
                    'paged' => '1',
                    '_wpnonce' => wp_create_nonce('activate-plugin_' . $active_file_name),
                        ), network_admin_url('plugins.php'));
                $button_class = 'activate-now button-primary';
                $button_txt = __('Activate', 'envo-ecommerce');
            }

            $detail_link = add_query_arg(
                    array(
                        'tab' => 'plugin-information',
                        'plugin' => $plugin_slug,
                        'TB_iframe' => 'true',
                        'width' => '772',
                        'height' => '349',
                    ), network_admin_url('plugin-install.php')
            );

            echo '<div class="rcp">';
            echo '<h4 class="rcp-name">';
            echo esc_html($plugin_name);
            echo '</h4>';
            echo '<p class="rcp-desc">';
            echo wp_kses_post($plugin_desc);
            echo '</p>';
            echo '<p class="action-btn plugin-card-' . esc_attr($plugin_slug) . '"><a href="' . esc_url($install_url) . '" data-slug="' . esc_attr($plugin_slug) . '" class="' . esc_attr($button_class) . '">' . esc_html($button_txt) . '</a></p>';
            echo '<a class="plugin-detail thickbox open-plugin-details-modal" href="' . esc_url($detail_link) . '">' . esc_html__('Details', 'envo-ecommerce') . '</a>';
            echo '</div>';
        }
    }
}

function envo_ecommerce_admin_dismiss_actions() {
    // Action for dismiss
    if (isset($_GET['envo_ecommerce_action_notice'])) {
        $actions_dismiss = get_option('envo_ecommerce_actions_dismiss');
        if (!is_array($actions_dismiss)) {
            $actions_dismiss = array();
        }
        $action_key = sanitize_text_field(wp_unslash($_GET['envo_ecommerce_action_notice']));
        if (isset($actions_dismiss[$action_key]) && $actions_dismiss[$action_key] == 'hide') {
            $actions_dismiss[$action_key] = 'show';
        } else {
            $actions_dismiss[$action_key] = 'hide';
        }
        update_option('envo_ecommerce_actions_dismiss', $actions_dismiss);
        $url = null;
        if (isset($_SERVER['REQUEST_URI'])) { // Input var okay.
            $url = sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI']));
            $url = remove_query_arg('envo_ecommerce_action_notice', $url);
        }
        wp_redirect($url);
        die();
    }
}

add_action('admin_init', 'envo_ecommerce_admin_dismiss_actions');

add_action('envo_ecommerce_recommended_title', 'envo_ecommerce_recommended_title_construct');

function envo_ecommerce_recommended_title_construct() {
    // Check for current viewing tab
    $tab = null;
    if (isset($_GET['tab'])) {
        $tab = sanitize_text_field(wp_unslash($_GET['tab']));
    } else {
        $tab = null;
    }
    $actions_r = envo_ecommerce_get_actions_required();
    $number_action = absint($actions_r['number_notice']);
    $actions = $actions_r['actions'];
    ?>
    <a href="?page=et_ecommerce&tab=actions_required" class="nav-tab<?php echo $tab == 'actions_required' ? ' nav-tab-active' : null; ?>"><?php
        esc_html_e('Recommended Actions', 'envo-ecommerce');
        echo ( $number_action > 0 ) ? '<span class="theme-action-count">' . absint($number_action) . '</span>' : '';
        ?>
    </a>
    <?php
}

add_action('envo_ecommerce_import_title', 'envo_ecommerce_recommended_import_construct');

function envo_ecommerce_recommended_import_construct() {
    // Check for current viewing tab
    $tab = null;
    if (isset($_GET['tab'])) {
        $tab = sanitize_text_field(wp_unslash($_GET['tab']));
    } else {
        $tab = null;
    }
    if (is_plugin_active('envo-extra/envo-extra.php')) {
        ?>
        <a href="?page=envothemes-panel-install-demos" class="nav-tab<?php echo $tab == 'import_data' ? ' nav-tab-active' : null; ?>"><?php esc_html_e('One Click Demo Import', 'envo-ecommerce') ?></a>
    <?php } else { ?>
        <a href="?page=et_ecommerce&tab=import_data" class="nav-tab<?php echo $tab == 'import_data' ? ' nav-tab-active' : null; ?>"><?php esc_html_e('One Click Demo Import', 'envo-ecommerce') ?></a>
        <?php
    }
}

function envo_ecommerce_theme_info_page() {

    $theme_data = wp_get_theme();

    if (isset($_GET['envo_ecommerce_action_dismiss'])) {
        $actions_dismiss = get_option('envo_ecommerce_actions_dismiss');
        if (!is_array($actions_dismiss)) {
            $actions_dismiss = array();
        }
        $actions_dismiss[sanitize_text_field(wp_unslash($_GET['envo_ecommerce_action_dismiss']))] = 'dismiss';
        update_option('envo_ecommerce_actions_dismiss', $actions_dismiss);
    }

    // Check for current viewing tab
    $tab = null;
    if (isset($_GET['tab'])) {
        $tab = sanitize_text_field(wp_unslash($_GET['tab']));
    } else {
        $tab = null;
    }

    $actions_r = envo_ecommerce_get_actions_required();
    $number_action = $actions_r['number_notice'];
    $actions = $actions_r['actions'];

    $current_action_link = esc_url(admin_url('themes.php?page=et_ecommerce&tab=actions_required'));

    $recommend_plugins = get_theme_support('recommend-plugins');
    if (is_array($recommend_plugins) && isset($recommend_plugins[0])) {
        $recommend_plugins = $recommend_plugins[0];
    } else {
        $recommend_plugins[] = array();
    }
    ?>
    <div class="wrap about-wrap theme_info_wrapper">
        <h1>
            <?php
            /* translators: %1$s theme name, %2$s theme version */
            printf(esc_html__('Welcome to %1$s - Version %2$s', 'envo-ecommerce'), esc_html($theme_data->Name), esc_html($theme_data->Version));
            ?>
        </h1>
        <div class="about-text"><?php echo esc_html($theme_data->Description); ?></div>
        <h2 class="nav-tab-wrapper">
            <a href="?page=et_ecommerce" class="nav-tab<?php echo is_null($tab) ? ' nav-tab-active' : null; ?>"><?php echo esc_html($theme_data->Name); ?></a>
            <?php do_action('envo_ecommerce_recommended_title'); ?>
            <?php do_action('envo_ecommerce_import_title'); ?>

            <?php do_action('envo_ecommerce_admin_more_tabs'); ?>
        </h2>

        <?php if (is_null($tab)) { ?>
            <div class="theme_info info-tab-content">
                <div class="theme_info_column clearfix">
                    <div class="theme_info_left">
                        <div class="theme_link">
                            <h3><?php esc_html_e('Theme Customizer', 'envo-ecommerce'); ?></h3>
                            <p class="about">
                                <?php
                                /* translators: %s theme name */
                                printf(esc_html__('%s supports the Theme Customizer for all theme settings. Click "Customize" to personalize your site.', 'envo-ecommerce'), esc_html($theme_data->Name));
                                ?>
                            </p>
                            <p>
                                <a href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button button-primary"><?php esc_html_e('Start customizing', 'envo-ecommerce'); ?></a>
                            </p>
                        </div>
                        <div class="theme_link">
                            <h3><?php esc_html_e('Theme documentation', 'envo-ecommerce'); ?></h3>
                            <p class="about">
                                <?php
                                /* translators: %s theme name */
                                printf(esc_html__('Need help in setting up and configuring %s? Please take a look at our documentation page.', 'envo-ecommerce'), esc_html($theme_data->Name));
                                ?>
                            </p>
                            <p>
                                <a href="<?php echo esc_url('https://envothemes.com/docs/docs/envo-ecommerce/'); ?>" target="_blank" class="button button-secondary">
                                    <?php
                                    /* translators: %s theme name */
                                    printf(esc_html__('%s Documentation', 'envo-ecommerce'), esc_html($theme_data->Name));
                                    ?>
                                </a>
                            </p>
                        </div>
                        <div class="theme_link">
                            <h3><?php esc_html_e('Having trouble? Need support?', 'envo-ecommerce'); ?></h3>
                            <p>
                                <a href="<?php echo esc_url('https://envothemes.com/contact/'); ?>" target="_blank" class="button button-secondary"><?php esc_html_e('Contact us', 'envo-ecommerce'); ?></a>
                            </p>
                        </div>
                    </div>

                    <div class="theme_info_right">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/screenshot.png" />
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ($tab == 'actions_required') { ?>
            <div class="action-required-tab info-tab-content">
                <?php if ($actions_r['number_active'] > 0) { ?>
                    <?php $actions = wp_parse_args($actions, array('page_on_front' => '', 'page_template')) ?>

                    <?php if ($actions['recommend_plugins'] == 'active') { ?>
                        <div id="plugin-filter" class="recommend-plugins action-required">
                            <a  title="" class="dismiss" href="<?php echo esc_url(add_query_arg(array('envo_ecommerce_action_notice' => 'recommend_plugins'), $current_action_link)); ?>">
                                <?php if ($actions_r['hide_by_click']['recommend_plugins'] == 'hide') { ?>
                                    <span class="dashicons dashicons-hidden"></span>
                                <?php } else { ?>
                                    <span class="dashicons  dashicons-visibility"></span>
                                <?php } ?>
                            </a>
                            <h3><?php esc_html_e('Recommended plugins', 'envo-ecommerce'); ?></h3>
                            <?php
                            envo_ecommerce_render_recommend_plugins($recommend_plugins);
                            ?>
                        </div>
                    <?php } ?>
                    <?php do_action('envo_ecommerce_more_required_details', $actions); ?>
                <?php } else { ?>
                    <p>
                        <?php esc_html_e('Hooray! There are no required actions for you right now.', 'envo-ecommerce'); ?>
                    </p>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if ($tab == 'import_data') { ?>
            <div class="import-data-tab info-tab-content">
                <?php if (is_plugin_active('envo-extra/envo-extra.php')) { ?>
                    <a href="<?php echo esc_url(admin_url('themes.php?page=envothemes-panel-install-demos')) ?>" class="button" style="text-decoration: none;">
                        <?php esc_html_e('Import demo data', 'envo-ecommerce'); ?>
                    </a>
                    <?php
                } else {
                    $importer = array(
                        'envo-extra' => array(
                            'name' => 'Envo Extra',
                            'active_filename' => 'envo-extra/envo-extra.php',
                            /* translators: %1$s "documentation" string and link */
                            'description' => sprintf(__('You can import the demo content with just one click. For step-by-step video tutorial, see %1$s', 'envo-ecommerce'), '<a class="documentation" href="' . esc_url('https://envothemes.com/docs/docs/envo-ecommerce/one-click-demo-import/') . '" target="_blank">' . esc_html__('documentation', 'envo-ecommerce') . '</a>'),
                        ),
                    );
                    envo_ecommerce_render_recommend_plugins($importer);
                }
                ?>
            </div>
        <?php } ?>

    </div> <!-- END .theme_info -->
    <?php
}
