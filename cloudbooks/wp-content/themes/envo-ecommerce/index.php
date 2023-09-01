<?php get_header(); ?>


<?php
if ( !is_paged() && is_front_page() ) {
	get_template_part( 'template-parts/homepage', 'widgets' );
}
?>

<?php get_template_part( 'template-parts/template-part', 'head' ); ?>
<!-- start content container -->
<div class="row">

	<div class="col-md-<?php envo_ecommerce_main_content_width_columns(); ?>">


		<?php
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();

				get_template_part( 'content', get_post_format() );

			endwhile;

			the_posts_pagination();

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

	</div>

<?php get_sidebar( 'right' ); ?>		

</div>
<!-- end content container -->

<?php get_footer(); ?>
