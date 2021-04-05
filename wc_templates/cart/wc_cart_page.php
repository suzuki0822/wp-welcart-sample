<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header();
?>
<div id="primary" class="site-content">
	<div id="content" class="cart-page" role="main">

	<?php if( have_posts() ) : usces_remove_filter(); ?>

		<article class="post" id="wc_<?php usces_page_name(); ?>">

			<h1 class="cart_page_title"><?php _e('In the cart', 'usces'); ?></h1>

			<div class="cart_navi">
				<ul>
					<li class="current"><?php _e('1.Cart','usces'); ?></li>
					<li><?php _e('2.Customer Info','usces'); ?></li>
					<li><?php _e('3.Deli. & Pay.','usces'); ?></li>
					<li><?php _e('4.Confirm','usces'); ?></li>
				</ul>
			</div>

			<div class="header_explanation">
				<?php do_action( 'usces_action_cart_page_header' ); ?>
			</div><!-- .header_explanation -->

			<div class="error_message"><?php usces_error_message(); ?></div>

			<form action="<?php usces_url('cart'); ?>" method="post" onKeyDown="if(event.keyCode == 13){return false;}">
			<?php if( usces_is_cart() ) : ?>
				<div id="cart">
					<?php echo apply_filters( 'usces_theme_filter_upbutton', '<div class="upbutton">' . __('Press the `update` button when you change the amount of items.', 'usces' ) .'<input name="upButton" type="submit" value="' . __( 'Quantity renewal', 'usces' ) . '" onclick="return uscesCart.upCart()" /></div>' ); ?>
					<table cellspacing="0" id="cart_table">
						<thead>
						<tr>
							<th scope="row" class="num">No.</th>
							<th class="thumbnail"> </th>
							<th class="productname"><?php _e('item name','usces'); ?></th>
							<th class="unitprice"><?php _e('Unit price','usces'); ?></th>
							<th class="quantity"><?php _e('Quantity','usces'); ?></th>
							<th class="subtotal"><?php _e('Amount','usces'); ?><?php usces_guid_tax(); ?></th>
							<th class="stock"><?php _e('stock status','usces'); ?></th>
							<th class="action"></th>
						</tr>
						</thead>
						<tbody>
							<?php usces_get_cart_rows(); ?>
						</tbody>
						<tfoot>
						<tr>
							<th class="num"></th>
							<th class="thumbnail"></th>
							<th colspan="3" scope="row" class="aright"><?php _e('total items','usces'); ?><?php usces_guid_tax(); ?></th>
							<th class="aright amount"><?php usces_crform(usces_total_price('return'), true, false); ?></th>
							<th class="stock"></th>
							<th class="action"></th>
						</tr>
						</tfoot>
					</table>
					<div class="currency_code"><?php _e('Currency','usces'); ?> : <?php usces_crcode(); ?></div>
					<?php if( $usces_gp ) : ?>
					<div class="gp"><img src="<?php bloginfo('template_directory'); ?>/images/gp.gif" alt="<?php _e('Business package discount','usces'); ?>" /><span><?php _e('The price with this mark applys to Business pack discount.','usces'); ?></span></div>
					<?php endif; ?>
				</div><!-- #cart -->
			<?php else : ?>
				<div class="no_cart"><?php _e('There are no items in your cart.','usces'); ?></div>
			<?php endif; ?>

				<div class="send"><?php usces_get_cart_button(); ?></div>
				<?php do_action( 'usces_action_cart_page_inform' ); ?>
			</form>

			<div class="footer_explanation">
				<?php do_action( 'usces_action_cart_page_footer' ); ?>
			</div><!-- .footer_explanation -->

		</article><!-- .post -->

	<?php else: ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
	<?php endif; ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
