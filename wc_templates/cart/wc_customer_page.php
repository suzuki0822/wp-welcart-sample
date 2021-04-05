<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header(); ?>

<div id="primary" class="site-content">
	<div id="content" class="cart-page" role="main">

	<?php if( have_posts() ) : usces_remove_filter(); ?>

		<article class="post" id="wc_<?php usces_page_name(); ?>">

			<h1 class="cart_page_title"><?php _e('Customer Information', 'usces'); ?></h1>

			<div id="customer-info">

				<div class="cart_navi">
					<ul>
						<li><?php _e('1.Cart','usces'); ?></li>
						<li class="current"><?php _e('2.Customer Info','usces'); ?></li>
						<li><?php _e('3.Deli. & Pay.','usces'); ?></li>
						<li><?php _e('4.Confirm','usces'); ?></li>
					</ul>
				</div>

				<div class="header_explanation">
					<?php do_action( 'usces_action_customer_page_header' ); ?>
				</div><!-- .header_explanation -->

				<div class="error_message"><?php usces_error_message(); ?></div>

		<?php if( usces_is_membersystem_state() ) : ?>
			<?php if( !welcart_basic_have_ex_order() ) : ?>
				<h5><?php _e('The member please enter at here.','usces'); ?></h5>
			<?php endif; ?>

				<form action="<?php usces_url('cart'); ?>" method="post" name="customer_loginform" onKeyDown="if(event.keyCode == 13){return false;}">

					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="customer_form">
						<tr>
							<th scope="row"><?php _e('e-mail adress', 'usces'); ?></th>
							<td><input name="loginmail" id="loginmail" type="text" value="<?php esc_attr_e($usces_entries['customer']['mailaddress1']); ?>" style="ime-mode: inactive" /></td>
						</tr>
						<tr>
							<th scope="row"><?php _e('password', 'usces'); ?></th>
							<td><input name="loginpass" id="loginpass" type="password" value="" /></td>
						</tr>
					</table>
			<?php if( welcart_basic_have_ex_order() ) : ?>
					<p id="nav">
						<a class="lostpassword" href="<?php usces_url('lostmemberpassword'); ?>"><?php _e('Did you forget your password?', 'usces'); ?></a>
					</p>
					<p id="nav">
						<a class="newmember" href="<?php usces_url('newmember'); ?>&dlseller_transition=newmember"><?php _e('New enrollment for membership.', 'usces'); ?></a>
					</p>
			<?php endif; ?>
					<div class="send"><input name="customerlogin" class="to_memberlogin_button" type="submit" value="<?php _e(' Next ', 'usces'); ?>" /></div>
					<?php do_action( 'usces_action_customer_page_member_inform' ); ?>

				</form>
		<?php endif; ?>

		<?php if( !welcart_basic_have_ex_order() ) : ?>
			<?php if( usces_is_membersystem_state() ) : ?>
				<h5><?php _e('The nonmember please enter at here.','usces'); ?></h5>
			<?php endif; ?>

				<form action="<?php echo USCES_CART_URL; ?>" method="post" name="customer_form" onKeyDown="if(event.keyCode == 13){return false;}">

					<table border="0" cellpadding="0" cellspacing="0" class="customer_form">

						<?php uesces_addressform( 'customer', $usces_entries, 'echo' ); ?>
						<tr>
							<th scope="row"><em><?php _e('*', 'usces'); ?></em><?php _e('e-mail adress', 'usces'); ?></th>
							<td colspan="2"><input name="customer[mailaddress1]" id="mailaddress1" type="text" value="<?php esc_attr_e($usces_entries['customer']['mailaddress1']); ?>" style="ime-mode: inactive" autocomplete="off" /></td>
						</tr>
						<tr>
							<th scope="row"><em><?php _e('*', 'usces'); ?></em><?php _e('e-mail adress', 'usces'); ?>(<?php _e('Re-input', 'usces'); ?>)</th>
							<td colspan="2"><input name="customer[mailaddress2]" id="mailaddress2" type="text" value="<?php esc_attr_e($usces_entries['customer']['mailaddress2']); ?>" style="ime-mode: inactive" autocomplete="off" /></td>
						</tr>
						<?php if( usces_is_membersystem_state() ) : ?>
						<tr>
							<th scope="row"><?php if( $member_regmode == 'editmemberfromcart' ) : ?><em><?php _e('*', 'usces'); ?></em><?php endif; ?><?php _e('password', 'usces'); ?></th>
							<td colspan="2"><input name="customer[password1]" style="width:100px" type="password" value="<?php esc_attr_e($usces_entries['customer']['password1']); ?>" autocomplete="new-password" /><?php if( $member_regmode != 'editmemberfromcart' ) _e('When you enroll newly, please fill it out.', 'usces'); ?>	</td>
						</tr>
						<tr>
							<th scope="row"><?php if( $member_regmode == 'editmemberfromcart' ) : ?><em><?php _e('*', 'usces'); ?></em><?php endif; ?><?php _e('Password (confirm)', 'usces'); ?></th>
							<td colspan="2"><input name="customer[password2]" style="width:100px" type="password" value="<?php esc_attr_e($usces_entries['customer']['password2']); ?>" autocomplete="new-password" /><?php if( $member_regmode != 'editmemberfromcart' ) _e('When you enroll newly, please fill it out.', 'usces'); ?></td>
						</tr>
						<?php endif; ?>
					</table>
					<input name="member_regmode" type="hidden" value="<?php echo $member_regmode; ?>" />

					<div class="send">
						<?php usces_get_customer_button(); ?>
					</div>

					<?php usces_agree_member_field(); ?>

					<?php do_action( 'usces_action_customer_page_inform' ); ?>

				</form>
		<?php endif; ?>

				<div class="footer_explanation">
					<?php do_action( 'usces_action_customer_page_footer' ); ?>
				</div><!-- .footer_explanation -->

			</div><!-- #customer-info -->

		</article><!-- .post -->

	<?php else: ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
	<?php endif; ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
