<?php
/*
Template Name: Inquiry
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">
			
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article class="inqbox">
					<?php the_content(); ?>
					<?php usces_the_inquiry_form(); ?>
					<?php edit_post_link(__('Edit this'), '<p>', '</p>'); ?>
				</article>
			<?php endwhile; endif; ?>
			
		</div><!-- #content -->
	</section><!-- #primary -->    
	
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>