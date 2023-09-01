<?php get_header(); ?>
<?php get_template_part( 'template-parts/template-part', 'head' ); ?>
<!-- start content container -->
<div class="row">
	<article class="col-md-<?php envo_ecommerce_main_content_width_columns(); ?>">
		<?php woocommerce_content(); ?>
	</article>       
	<?php get_sidebar( 'right' ); ?>
</div>
<!-- end content container -->

<?php
get_footer();
