<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
		
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
			<?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>
			
			<?php if(!usces_is_item()): ?>
			
				<div class="comment-area">
				<div class="feedback">
				<?php wp_link_pages(); ?>
				</div>
				<?php comments_template( '', true ); ?>
				</div><!-- .comment-area -->
			
			<?php endif; ?>
			
		<?php endwhile; else: ?>
			
			<p><?php _e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
			
		<?php endif; ?>
		
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar('other'); ?>
<?php get_footer(); ?>