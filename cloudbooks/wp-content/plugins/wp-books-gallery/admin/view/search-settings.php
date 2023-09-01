<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="wph-wrap-all" class="wrap wbg-search-panel-settings">
    
    <div class="settings-banner">
        <h2><i class="fa fa-search" aria-hidden="true"></i>&nbsp;<?php _e('Search Panel Settings', WBG_TXT_DOMAIN); ?></h2>
    </div>

    <?php 
        if ( $wbgShowMessage ) {
            $this->wbg_display_notification('success', 'Your information updated successfully.');
        }
    ?>

    <div class="wbg-wrap">

        <nav class="nav-tab-wrapper">
            <a href="?post_type=books&page=wbg-search-panel-settings&tab=content" class="nav-tab wbg-tab <?php if ( $tab != 'styles' ) { ?>wbg-tab-active<?php } ?>">
                <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;<?php _e('Content', WBG_TXT_DOMAIN); ?>
            </a>
            <a href="?post_type=books&page=wbg-search-panel-settings&tab=styles" class="nav-tab wbg-tab <?php if ( $tab === 'styles' ) { ?>wbg-tab-active<?php } ?>">
                <i class="fa fa-paint-brush" aria-hidden="true"></i>&nbsp;<?php _e('Styles', WBG_TXT_DOMAIN); ?>
            </a>
        </nav>

        <div class="wbg_personal_wrap wbg_personal_help" style="width: 76%; float: left;">
            
            <div class="tab-content">
                <?php 
                switch ( $tab ) {
                    case 'styles':
                        include WBG_PATH . 'admin/view/partial/search-styles.php';
                        break;
                    default:
                        include WBG_PATH . 'admin/view/partial/search-content.php';
                        break;
                } 
                ?>
            </div>
        </div>

        <?php include_once('partial/admin-sidebar.php'); ?> 

    </div>

</div>