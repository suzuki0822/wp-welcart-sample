<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */

get_header();
?>
<div id="primary" class="site-content">
	<div id="content" class="member-page" role="main">

	<?php if( have_posts() ) : usces_remove_filter(); ?>

		<article class="post" id="wc_<?php usces_page_name(); ?>">

			<h1 class="member_page_title"><?php _e('My page', 'welcart_basic'); ?></h1>

			<div id="memberpages">
				<div class="whitebox">
					<div id="memberinfo">

						<table>
							<tr>
								<th scope="row"><?php _e('member number', 'usces'); ?></th>
								<td class="num"><?php usces_memberinfo( 'ID' ); ?></td>
								<th><?php _e('Strated date', 'usces'); ?></th>
								<td><?php usces_memberinfo( 'registered' ); ?></td>
							</tr>
							<tr>
								<th scope="row"><?php _e('Full name', 'usces'); ?></th>
								<td><?php esc_html_e(sprintf(_x('%s', 'honorific', 'usces'), usces_localized_name( usces_memberinfo( 'name1', 'return' ), usces_memberinfo( 'name2', 'return' ), 'return' ))); ?></td>
							<?php if( usces_is_membersystem_point() ) : ?>
								<th><?php _e('The current point', 'usces'); ?></th>
								<td class="num"><?php usces_memberinfo( 'point' ); ?></td>
							<?php else : ?>
								<th class="space"></th>
								<td class="space"></td>
							<?php endif; ?>
							</tr>
							<tr>
								<th scope="row"><?php _e('e-mail adress', 'usces'); ?></th>
								<td><?php usces_memberinfo('mailaddress1'); ?></td>
								<?php $html_reserve = '<th class="space"></th><td class="space"></td>'; ?>
								<?php echo apply_filters( 'usces_filter_memberinfo_page_reserve', $html_reserve, usces_memberinfo( 'ID', 'return' ) ); ?>
							</tr>
						</table>

						<ul class="member_submenu">
							<li class="member-edit"><a href="#edit"><?php _e('To member information editing', 'usces'); ?></a></li>
							<li><?php do_action( 'usces_action_member_submenu_list' ); ?></li>
							<li class="member-logout"><?php usces_loginout(); ?></li>
						</ul>

						<div class="header_explanation">
							<?php do_action( 'usces_action_memberinfo_page_header' ); ?>
						</div><!-- .header_explanation -->

						<h3><?php _e('Purchase history', 'usces'); ?></h3>

						<div class="currency_code"><?php _e('Currency','usces'); ?> : <?php usces_crcode(); ?></div>
						<?php usces_member_history(); ?>

						<h3><a name="edit"></a><?php _e('Member information editing', 'usces'); ?></h3>

						<div class="error_message"><?php usces_error_message(); ?></div>

						<form action="<?php usces_url('member'); ?>#edit" method="post" onKeyDown="if(event.keyCode == 13){return false;}">
							<table class="customer_form">
								<?php uesces_addressform( 'member', usces_memberinfo(NULL), 'echo' ); ?>
								<tr>
									<th scope="row"><?php _e('e-mail adress', 'usces'); ?></th>
									<td colspan="2"><input name="member[mailaddress1]" id="mailaddress1" type="text" value="<?php usces_memberinfo('mailaddress1'); ?>" /></td>
								</tr>
								<tr>
									<th scope="row"><?php _e('password', 'usces'); ?></th>
									<td colspan="2"><input name="member[password1]" id="password1" type="password" value="<?php usces_memberinfo('password1'); ?>" autocomplete="new-password" />
									<?php _e('Leave it blank in case of no change.', 'usces'); ?></td>
								</tr>
								<tr>
									<th scope="row"><?php _e('Password (confirm)', 'usces'); ?></th>
									<td colspan="2"><input name="member[password2]" id="password2" type="password" value="<?php usces_memberinfo('password2'); ?>" autocomplete="new-password" />
									<?php _e('Leave it blank in case of no change.', 'usces'); ?></td>
								</tr>
							</table>

							<input name="member_regmode" type="hidden" value="editmemberform" />
							<div class="send">
								<input name="top" class="top" type="button" value="<?php _e('Back to the top page.', 'usces'); ?>" onclick="location.href='<?php echo home_url(); ?>'" />
								<input name="editmember" class="editmember" type="submit" value="<?php _e('update it', 'usces'); ?>" />
								<input name="deletemember" class="deletemember" type="submit" value="<?php _e('delete it', 'usces'); ?>" onclick="return confirm('<?php _e('All information about the member is deleted. Are you all right?', 'usces'); ?>');" />
							</div>
							<?php do_action( 'usces_action_memberinfo_page_inform' ); ?>
						</form>

						<div class="footer_explanation">
							<?php do_action( 'usces_action_memberinfo_page_footer' ); ?>
						</div><!-- .footer_explanation -->

					</div><!-- #memberinfo -->
				</div><!-- .whitebox -->
			</div><!-- #memberpages -->

		</article><!-- .post -->

	<?php else: ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
	<?php endif; ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
