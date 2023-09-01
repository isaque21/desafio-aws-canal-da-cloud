<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
get_header();

echo do_shortcode("[wp_books_gallery]");

get_footer(); 
?>