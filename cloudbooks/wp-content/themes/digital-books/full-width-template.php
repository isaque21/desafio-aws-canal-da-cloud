<?php
/**
* Template Name: Full Width Template
 */

get_header(); ?>

	<div id="skip-content" class="container">
	    <div id="primary" class="content-area">
	        <main id="main" class="site-main module-border-wrap">
				<?php
				while (have_posts()) : the_post();

					get_template_part('template-parts/content', 'page');

					// If comments are open or we have at least one comment, load up the comment template.
					if (comments_open() || get_comments_number()) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
	        </main>
	    </div>
	</div>
	
<?php get_footer();