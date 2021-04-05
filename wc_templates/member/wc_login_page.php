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

			<h1 class="member_page_title"><?php _e('Log-in for members', 'usces'); ?></h1>

			<div id="memberpages">
				<div class="whitebox">

					<div class="header_explanation">
						<?php do_action( 'usces_action_login_page_header' ); ?>
					</div><!-- .header_explanation -->

					<div class="error_message"><?php usces_error_message(); ?></div>

					<div class="loginbox">
						<div class="member-box">
							<form name="loginform" id="loginform" action="<?php echo apply_filters( 'usces_filter_login_form_action', USCES_MEMBER_URL ); ?>" method="post">
								<p>
									<label><?php _e('e-mail adress', 'usces'); ?><br />
									<input type="text" name="loginmail" id="loginmail" class="loginmail" value="<?php esc_attr_e(usces_remembername('return')); ?>" size="20" /></label>
								</p>
								<p>
									<label><?php _e('password', 'usces'); ?><br />
									<input type="password" name="loginpass" id="loginpass" class="loginpass" size="20" /></label>
								</p>
								<p class="forgetmenot">
									<label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e('memorize login information', 'usces'); ?></label>
								</p>
								<p class="submit">
									<?php usces_login_button(); ?>
								</p>
								<?php do_action( 'usces_action_login_page_inform' ); ?>
							</form>
	
							<p id="nav">
								<a href="<?php usces_url('lostmemberpassword'); ?>" title="<?php _e('Did you forget your password?', 'usces'); ?>"><?php _e('Did you forget your password?', 'usces'); ?></a>
							</p>
						</div><!-- new-entry -->
						
						<div class="new-entry">
							<h2><?php _e('Customers who are not member registration' , 'welcart_basic'); ?></h2>
							<p id="nav">
								<a href="<?php usces_url('newmember') . apply_filters( 'usces_filter_newmember_urlquery', NULL ); ?>" title="<?php _e('New enrollment for membership.', 'usces'); ?>"><?php _e('New enrollment for membership.', 'usces'); ?></a>
							</p>
						</div><!-- new-entry -->
					
					</div><!-- .loginbox -->
					
					<div class="footer_explanation">
						<?php do_action( 'usces_action_login_page_footer' ); ?>
					</div><!-- .footer_explanation -->

				</div><!-- .whitebox -->
			</div><!-- #memberpages -->

			<script type="text/javascript">
		<?php if( usces_is_login() ) : ?>
				setTimeout( function(){ try{
				d = document.getElementById('loginpass');
				d.value = '';
				d.focus();
				} catch(e){}
				}, 200);
		<?php else : ?>
				try{document.getElementById('loginmail').focus();}catch(e){}
		<?php endif; ?>
			</script>

		</article><!-- .post -->

	<?php else: ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
	<?php endif; ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
