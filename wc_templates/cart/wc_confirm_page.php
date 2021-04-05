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

			<h1 class="cart_page_title"><?php _e('Confirmation', 'usces'); ?></h1>

			<div id="info-confirm">
				<div class="confiem_notice">
					<?php _e('Please do not change product addition and amount of it with the other window with displaying this page.','usces'); ?>
				</div>

				<div class="cart_navi">
					<ul>
						<li><?php _e('1.Cart','usces'); ?></li>
						<li><?php _e('2.Customer Info','usces'); ?></li>
						<li><?php _e('3.Deli. & Pay.','usces'); ?></li>
						<li class="current"><?php _e('4.Confirm','usces'); ?></li>
					</ul>
				</div>

				<div class="header_explanation">
					<?php do_action( 'usces_action_confirm_page_header' ); ?>
				</div><!-- .header_explanation -->

				<div class="error_message"><?php usces_error_message(); ?></div>

				<div id="cart">
					<div class="currency_code"><?php _e('Currency','usces'); ?> : <?php usces_crcode(); ?></div>
					<table cellspacing="0" id="cart_table">
						<thead>
						<tr>
							<th scope="row" class="num"><?php _e('No.','usces'); ?></th>
							<th class="thumbnail"></th>
							<th class="productname"><?php _e('item name','usces'); ?></th>
							<th class="price"><?php _e('Unit price','usces'); ?></th>
							<th class="quantity"><?php _e('Quantity', 'usces'); ?></th>
							<th class="subtotal"><?php _e('Amount', 'usces'); ?></th>
							<th class="action"></th>
						</tr>
						</thead>
						<tbody>
							<?php usces_get_confirm_rows(); ?>
						</tbody>
						<tfoot>
						<tr>
							<th class="num"></th>
							<th class="thumbnail"></th>
							<th colspan="3" class="aright"><?php _e('total items', 'usces'); ?></th>
							<th class="aright amount"><?php usces_crform($usces_entries['order']['total_items_price'], true, false); ?></th>
						</tr>
					<?php if( !empty($usces_entries['order']['discount']) ) : ?>
						<tr>
							<td class="num"></td>
							<td class="thumbnail"></td>
							<td colspan="3" class="aright"><?php echo apply_filters('usces_confirm_discount_label', __('Campaign disnount', 'usces')); ?></td>
							<td class="aright" style="color:#FF0000"><?php usces_crform($usces_entries['order']['discount'], true, false); ?></td>
						</tr>
					<?php endif; ?>
					<?php if( usces_is_tax_display() && 'products' == usces_get_tax_target() ) : ?>
						<tr>
							<td class="num"></td>
							<td class="thumbnail"></td>
							<td colspan="3" class="aright"><?php usces_tax_label(); ?></td>
							<td class="aright"><?php usces_tax($usces_entries); ?></td>
						</tr>
					<?php endif; ?>
					<?php if( usces_is_member_system() && usces_is_member_system_point() && !empty($usces_entries['order']['usedpoint']) && 0 == usces_point_coverage() ) : ?>
						<tr>
							<td class="num"></td>
							<td class="thumbnail"></td>
							<td colspan="3" class="aright"><?php _e('Used points', 'usces'); ?></td>
							<td class="aright" style="color:#FF0000"><?php echo number_format($usces_entries['order']['usedpoint']); ?></td>
						</tr>
					<?php endif; ?>
					<?php if( welcart_basic_have_shipped() ) : ?>
						<tr>
							<td class="num"></td>
							<td class="thumbnail"></td>
							<td colspan="3" class="aright"><?php _e('Shipping', 'usces'); ?></td>
							<td class="aright"><?php usces_crform($usces_entries['order']['shipping_charge'], true, false); ?></td>
						</tr>
					<?php endif; ?>
					<?php if( !empty($usces_entries['order']['cod_fee']) ) : ?>
						<tr>
							<td class="num"></td>
							<td class="thumbnail"></td>
							<td colspan="3" class="aright"><?php echo apply_filters('usces_filter_cod_label', __('COD fee', 'usces')); ?></td>
							<td class="aright"><?php usces_crform($usces_entries['order']['cod_fee'], true, false); ?></td>
						</tr>
					<?php endif; ?>
					<?php if( usces_is_tax_display() && 'all' == usces_get_tax_target() ) : ?>
						<tr>
							<td class="num"></td>
							<td class="thumbnail"></td>
							<td colspan="3" class="aright"><?php usces_tax_label(); ?></td>
							<td class="aright"><?php usces_tax($usces_entries); ?></td>
						</tr>
					<?php endif; ?>
					<?php if( usces_is_member_system() && usces_is_member_system_point() && !empty($usces_entries['order']['usedpoint']) && 1 == usces_point_coverage() ) : ?>
						<tr>
							<td class="num"></td>
							<td class="thumbnail"></td>
							<td colspan="3" class="aright"><?php _e('Used points', 'usces'); ?></td>
							<td class="aright" style="color:#FF0000"><?php echo number_format($usces_entries['order']['usedpoint']); ?></td>
						</tr>
					<?php endif; ?>
						<tr>
							<th class="num"></th>
							<th class="thumbnail"></th>
							<th colspan="3" class="aright"><?php _e('Total Amount', 'usces'); ?></th>
							<th class="aright amount"><?php usces_crform($usces_entries['order']['total_full_price'], true, false); ?></th>
						</tr>
						</tfoot>
					</table>

				<?php if( usces_is_member_system() && usces_is_member_system_point() && usces_is_login() && welcart_basic_is_available_point() ) : ?>
					<form action="<?php usces_url('cart'); ?>" method="post" onKeyDown="if(event.keyCode == 13){return false;}">

						<div class="error_message"><?php usces_error_message(); ?></div>
						<table cellspacing="0" id="point_table">
							<tr>
								<td class="c-point"><?php _e('The current point', 'usces'); ?></td>
								<td><span class="point"><?php echo $usces_members['point']; ?></span>pt</td>
							</tr>
							<tr>
								<td class="u-point"><?php _e('Points you are using here', 'usces'); ?></td>
								<td><input name="offer[usedpoint]" class="used_point" type="text" value="<?php esc_attr_e($usces_entries['order']['usedpoint']); ?>" />pt</td>
							</tr>
							<tr>
								<td colspan="2" class="point-btn"><input name="use_point" type="submit" class="use_point_button" value="<?php _e('Use the points', 'usces'); ?>" /></td>
							</tr>
						</table>
						<?php do_action( 'usces_action_confirm_page_point_inform' ); ?>

					</form>
				<?php endif; ?>
					<?php do_action( 'usces_action_confirm_after_form' ); ?>

				</div><!-- #cart -->

				<table id="confirm_table">
					<tr class="ttl">
						<td colspan="2"><h3><?php _e('Customer Information', 'usces'); ?></h3></td>
					</tr>
					<tr>
						<th><?php _e('e-mail adress', 'usces'); ?></th>
						<td><?php esc_html_e($usces_entries['customer']['mailaddress1']); ?></td>
					</tr>
					<?php uesces_addressform( 'confirm', $usces_entries, 'echo' ); ?>
					<tr class="ttl">
						<td colspan="2"><h3><?php _e('Others', 'usces'); ?></h3></td>
					</tr>
				<?php if( welcart_basic_have_shipped() ) : ?>
					<tr>
						<th><?php _e('shipping option', 'usces'); ?></th>
						<td><?php esc_html_e(usces_delivery_method_name( $usces_entries['order']['delivery_method'], 'return' )); ?></td>
					</tr>
					<tr>
						<th><?php _e('Delivery date', 'usces'); ?></th>
						<td><?php esc_html_e($usces_entries['order']['delivery_date']); ?></td>
					</tr>
					<tr>
						<th><?php _e('Delivery Time', 'usces'); ?></th>
						<td><?php esc_html_e($usces_entries['order']['delivery_time']); ?></td>
					</tr>
				<?php endif; ?>
					<tr>
						<th><?php _e('payment method', 'usces'); ?></th>
						<td><?php esc_html_e($usces_entries['order']['payment_name'] . usces_payment_detail($usces_entries)); ?></td>
					</tr>
					<?php usces_custom_field_info( $usces_entries, 'order', '' ); ?>
					<tr>
						<th><?php _e('Notes', 'usces'); ?></th>
						<td><?php echo nl2br(esc_html($usces_entries['order']['note'])); ?></td>
					</tr>
				<?php if( welcart_basic_have_dlseller_content() ) : ?>
					<tr>
						<th><?php _e('Terms of Use', 'dlseller'); ?></th>
						<td><?php echo( $usces_entries['order']['terms'] ? __('Agree','welcart_basic') : '' ); ?></td>
					</tr>
				<?php endif; ?>
				</table>

				<?php usces_purchase_button(); ?>

				<div class="footer_explanation">
					<?php do_action( 'usces_action_confirm_page_footer' ); ?>
				</div><!-- .footer_explanation -->

			</div><!-- #info-confirm -->

		</article><!-- .post -->

	<?php else: ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
	<?php endif; ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
