<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="wph-wrap-all" class="wrap wbg-settings-page">
    
    <div class="settings-banner">
        <h2><i class="fa fa-book" aria-hidden="true"></i>&nbsp;<?php _e('Details Settings', WBG_TXT_DOMAIN); ?></h2>
    </div>
    
    <?php 
    if ( $wbgShowMessage ) { 
        $this->wbg_display_notification('success', 'Your information updated successfully.');
    } 
    ?>

    <div class="wbg-wrap">

        <nav class="nav-tab-wrapper">
            <a href="?post_type=books&page=wbg-details-settings&tab=content" class="nav-tab wbg-tab <?php if ( $tab !== 'styles' ) { ?>wbg-tab-active<?php } ?>">
                <i class="fa fa-cog" aria-hidden="true">&nbsp;</i><?php _e('Content', WBG_TXT_DOMAIN); ?>
            </a>
            <a href="?post_type=books&page=wbg-details-settings&tab=styles" class="nav-tab wbg-tab <?php if ( $tab === 'styles' ) { ?>wbg-tab-active<?php } ?>">
                <i class="fa fa-paint-brush" aria-hidden="true"></i>&nbsp;<?php _e('Styles', WBG_TXT_DOMAIN); ?>
            </a>
        </nav>

        <div class="wbg_personal_wrap wbg_personal_help" style="width: 72%; float: left; margin-top: 0px;">

            <div class="tab-content">

                <?php 
                switch ( $tab ) {
                    case 'styles':
                        include WBG_PATH . 'admin/view/partial/single-styles.php';
                        break;
                    default:
                        include WBG_PATH . 'admin/view/partial/single-content.php';
                        break;
                } 
                ?>

            </div>

        </div>

        <?php include_once('partial/admin-sidebar.php'); ?> 

    </div>

</div>