<?php get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
		
		<?php if ( 'page' == get_option('show_on_front') ): ?>

			<div class="sof">
				<?php if (have_posts()) : the_post(); ?>
					<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
	
						<h2 class="entry-title"><?php the_title(); ?></h2>
				
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					</article>
				<?php else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.', 'usces'); ?></p>
				<?php endif; ?>
			</div><!-- .sof -->

		<?php else: ?>

			<section class="front-il cf">
			
				<?php if( have_posts() ) : ?>
					<?php while( have_posts() ) : the_post(); usces_the_item(); ?>
					
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
							<div class="itemimg">
								<a href="<?php the_permalink(); ?>"><?php usces_the_itemImage( 0, 300, 300 ); ?></a>
								<?php welcart_basic_campaign_message(); ?>
							</div>
							<div class="itemprice"><?php usces_the_firstPriceCr(); ?><?php usces_guid_tax(); ?></div>
							<?php usces_crform_the_itemPriceCr_taxincluded(); ?>
							<?php if( !usces_have_zaiko_anyone() ) : ?>
							<div class="itemsoldout"><?php _e('Sold Out', 'usces' ); ?></div>
							<?php endif; ?>
							<div class="itemname"><a href="<?php the_permalink(); ?>"  rel="bookmark"><?php usces_the_itemName(); ?></a></div>
						
						</article>
					
					<?php endwhile; ?>
					
				<?php else: ?>
					
					<p class="no-date"><?php _e('Sorry, no posts matched your criteria.', 'usces'); ?></p>
				
				<?php endif; ?>
			
			</section><!-- .front-il -->

		<?php endif; ?>
				
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar('home'); ?>
<?php get_footer(); ?>
