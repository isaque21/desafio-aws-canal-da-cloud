<?php
/**
 * Displays top navigation
 *
 * @package Digital Books
 */
?>

<div class="navigation_header">
    <div class="toggle-nav mobile-menu">
        <?php if(has_nav_menu('primary')){ ?>
            <button onclick="digital_books_openNav()"><i class="fas fa-th"></i></button>
        <?php }?>
    </div>
    <div id="mySidenav" class="nav sidenav">
        <nav id="site-navigation" class="main-navigation navbar navbar-expand-xl" aria-label="<?php esc_attr_e( 'Top Menu', 'digital-books' ); ?>">
            <?php if(has_nav_menu('primary')){
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'menu',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    )
                );
            } ?>
        </nav>
        <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="digital_books_closeNav()"><i class="far fa-times-circle"></i></a>
    </div>
</div>