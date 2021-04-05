<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

$division = welcart_basic_get_item_division( $post->ID );
switch( $division ) :
case 'data':
	get_template_part( 'wc_templates/wc_item_single_data', get_post_format() );
	break;
case 'service':
	get_template_part( 'wc_templates/wc_item_single_service', get_post_format() );
	break;
default://shipped

get_header();
?>

<div id="primary" class="site-content">
	<div id="content" role="main">

	<?php if( have_posts() ) : the_post(); ?>

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<header class="item-header">
				<h1 class="item_page_title"><?php the_title(); ?></h1>
			</header><!-- .item-header -->

			<div class="storycontent">

			<?php usces_remove_filter(); ?>
			<?php usces_the_item(); ?>
			<?php usces_have_skus(); ?>

				<div id="itempage">

					<div id="img-box">

						<div class="itemimg">
							<a href="<?php usces_the_itemImageURL(0); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', NULL ); ?>><?php usces_the_itemImage( 0, 335, 335, $post ); ?></a>
						</div>

						<?php
						$imageid = usces_get_itemSubImageNums();
						if( !empty( $imageid ) ):
						?>
						<div class="itemsubimg">
						<?php foreach( $imageid as $id ) : ?>
							<a href="<?php usces_the_itemImageURL($id); ?>" <?php echo apply_filters( 'usces_itemimg_anchor_rel', NULL ); ?>><?php usces_the_itemImage( $id, 135, 135, $post ); ?></a>
						<?php endforeach; ?>
						</div>
						<?php endif; ?>

					</div><!-- #img-box -->

					<div class="detail-box">
						<h2 class="item-name"><?php usces_the_itemName(); ?></h2>
						<div class="itemcode">(<?php usces_the_itemCode(); ?>)</div>
						<?php welcart_basic_campaign_message(); ?>
						<div class="item-description">
							<?php the_content(); ?>
						</div>

						<?php if( 'continue' == welcart_basic_get_item_chargingtype( $post->ID ) ) : ?>
						<!-- Charging Type Continue shipped -->
						<div class="field">
							<table class="dlseller">
								<tr><th><?php _e('First Withdrawal Date', 'dlseller'); ?></th><td><?php echo dlseller_first_charging( $post->ID ); ?></td></tr>
								<?php if( 0 < (int)$usces_item['dlseller_interval'] ) : ?>
								<tr><th><?php _e('Contract Period', 'dlseller'); ?></th><td><?php echo $usces_item['dlseller_interval']; ?><?php _e('month (Automatic Updates)', 'welcart_basic'); ?></td></tr>
								<?php endif; ?>
							</table>
						</div>
						<?php endif; ?>
					</div><!-- .detail-box -->

					<div class="item-info">

						<?php if( $item_custom = usces_get_item_custom( $post->ID, 'list', 'return' ) ) : ?>
							<?php echo $item_custom; ?>
						<?php endif; ?>

						<form action="<?php echo USCES_CART_URL; ?>" method="post">

						<?php do { ?>
							<div class="skuform">
								<?php if( '' !== usces_the_itemSkuDisp('return') ) : ?>
								<div class="skuname"><?php usces_the_itemSkuDisp(); ?></div>
								<?php endif; ?>

								<?php if( usces_is_options() ) : ?>
								<dl class="item-option">
									<?php while( usces_have_options() ) : ?>
									<dt><?php usces_the_itemOptName(); ?></dt>
									<dd><?php usces_the_itemOption( usces_getItemOptName(), '' ); ?></dd>
									<?php endwhile; ?>
								</dl>
								<?php endif; ?>

								<?php usces_the_itemGpExp(); ?>

								<div class="field">
									<div class="zaikostatus"><?php _e('stock status', 'usces'); ?> : <?php usces_the_itemZaikoStatus(); ?></div>

									<?php if( 'continue' == welcart_basic_get_item_chargingtype( $post->ID ) ) : ?>
									<div class="frequency"><span class="field_frequency"><?php dlseller_frequency_name($post->ID, 'amount'); ?></span></div>
									<?php endif; ?>

									<div class="field_price">
									<?php if( usces_the_itemCprice('return') > 0 ) : ?>
										<span class="field_cprice"><?php usces_the_itemCpriceCr(); ?></span>
									<?php endif; ?>
										<?php usces_the_itemPriceCr(); ?><?php usces_guid_tax(); ?>
									</div>
									<?php usces_crform_the_itemPriceCr_taxincluded(); ?>
								</div>

								<?php if( !usces_have_zaiko() ) : ?>
								<div class="itemsoldout"><?php echo apply_filters( 'usces_filters_single_sku_zaiko_message', __('At present we cannot deal with this product.','welcart_basic') ); ?></div>
								<?php else : ?>
								<div class="c-box">
									<span class="quantity"><?php _e('Quantity', 'usces'); ?><?php usces_the_itemQuant(); ?><?php usces_the_itemSkuUnit(); ?></span>
									<span class="cart-button"><?php usces_the_itemSkuButton( '&#xf07a;&nbsp;&nbsp;' . __('Add to Shopping Cart', 'usces' ), 0 ); ?></span>
								</div>
								<?php endif; ?>
								<div class="error_message"><?php usces_singleitem_error_message( $post->ID, usces_the_itemSku('return') ); ?></div>
							</div><!-- .skuform -->
						<?php } while ( usces_have_skus() ); ?>

							<?php do_action( 'usces_action_single_item_inform' ); ?>
						</form>
						<?php do_action( 'usces_action_single_item_outform' ); ?>

					</div><!-- .item-info -->

					<?php usces_assistance_item( $post->ID, __('An article concerned', 'usces') ); ?>

				</div><!-- #itemspage -->
			</div><!-- .storycontent -->

		</article>

	<?php else: ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
	<?php endif; ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php endswitch; ?>
