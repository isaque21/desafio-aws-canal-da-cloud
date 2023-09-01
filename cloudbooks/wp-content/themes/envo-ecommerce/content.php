<article>
	<div <?php post_class(); ?>>                    
		<div class="news-item row">
			<?php envo_ecommerce_thumb_img( 'envo-ecommerce-med', 'col-md-6' ); ?>
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="news-text-wrap col-md-6">
				<?php } else { ?>
					<div class="news-text-wrap col-md-12">
					<?php } ?>
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
					<?php envo_ecommerce_author_meta(); ?>
					<div class="content-date-comments">
						<?php envo_ecommerce_widget_date_comments(); ?>
					</div>	

					<div class="post-excerpt">
						<?php the_excerpt(); ?>
					</div><!-- .post-excerpt -->
				</div><!-- .news-text-wrap -->

			</div><!-- .news-item -->
		</div>
</article>
