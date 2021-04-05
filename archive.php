<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php if (have_posts()) : ?>

			<div class="post-li">
				<?php while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<p><time datetime="<?php the_time('c'); ?>"><?php the_time(__('Y/m/d')) ?></time></p>
						<div class="post-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'welcart_basic' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></div>
						<?php the_excerpt() ?>
					</article>
				<?php endwhile; ?>
			</div>
			
			<?php endif; ?>

			<div class="pagination_wrapper">
				<?php
				$args = array (
					'type' => 'list',
					'prev_text' => __( ' &laquo; ', 'welcart_basic' ),
					'next_text' => __( ' &raquo; ', 'welcart_basic' ),
				);
				echo paginate_links( $args );
				?>
			</div><!-- .pagenation-wrapper -->

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
