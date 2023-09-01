<?php
/**
 * Displays main header
 *
 * @package Digital Books
 */

$digital_books_sticky_header = get_theme_mod('digital_books_sticky_header');
    $data_sticky = "false";
    if ($digital_books_sticky_header) {
        $data_sticky = "true";
    }
?>
<div class="main_header" data-sticky="<?php echo esc_attr($data_sticky); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 align-self-center">
                <div class="navbar-brand">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; ?>
                    <?php $digital_books_blog_info = get_bloginfo( 'name' ); ?>
                        <?php if ( ! empty( $digital_books_blog_info ) ) : ?>
                            <?php if ( is_front_page() && is_home() ) : ?>
                                <?php if( get_theme_mod('digital_books_logo_title_text',true) != ''){ ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php } ?>
                            <?php else : ?>
                              <?php if( get_theme_mod('digital_books_logo_title_text',true) != ''){ ?>
                                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                              <?php } ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php
                            $digital_books_description = get_bloginfo( 'description', 'display' );
                            if ( $digital_books_description || is_customize_preview() ) :
                        ?>
                        <?php if( get_theme_mod('digital_books_theme_description',false) != ''){ ?>
                            <p class="site-description"><?php echo esc_html($digital_books_description); ?></p>
                        <?php }?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-7 col-md-4 col-4">
                <?php get_template_part('template-parts/navigation/navigation', 'top'); ?>
            </div>
            <div class="col-lg-1 col-md-2 col-4">
                <?php if(class_exists('woocommerce')){ ?>
                    <div class="search-box">
                        <span><a href="#"><i class="fas fa-search"></i></a></span>
                    </div>
                <?php }?>
            </div>
            <div class="col-lg-1 col-md-2 col-4">
                <?php if(class_exists('woocommerce')){ ?>
                    <div class="cart_box">
                        <?php global $woocommerce; ?>
                        <a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e( 'shopping cart','digital-books' ); ?>"><i class="fas fa-shopping-bag"></i><span class="cart-value"><?php echo sprintf ( esc_html( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span></a>
                    </div>
                <?php }?>
            </div>
        </div>
        <?php if(class_exists('woocommerce')){ ?>
            <div class="serach_outer">
                <div class="serach_inner">
                    <?php get_product_search_form(); ?>
                </div>
            </div>
        <?php }?>
    </div>
</div>
