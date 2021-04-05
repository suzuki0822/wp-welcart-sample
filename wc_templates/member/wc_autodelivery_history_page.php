<?php
/**
 * <meta content="charset=UTF-8">
 * @package Welcart
 * @subpackage Welcart Default Theme
 */

get_header();
?>
<div id="primary" class="site-content">
	<div id="content" class="member-page" role="main">

	<?php if( have_posts() ) : usces_remove_filter(); ?>

		<article class="post" id="wc_<?php usces_page_name(); ?>">

			<h1 class="member_page_title"><?php _e('Regular Purchase', 'autodelivery'); ?></h1>

			<div id="memberpages">

				<div class="whitebox">
					<div id="memberinfo">

						<div class="header_explanation">
							<?php do_action( 'wcad_action_autodelivery_history_page_header' ); ?>
						</div>

						<h3><?php _e('Regular purchase information', 'autodelivery'); ?></h3>
						<div class="currency_code"><?php _e('Currency','usces'); ?> : <?php usces_crcode(); ?></div>

						<div class="error_message"><?php usces_error_message(); ?></div>

						<form action="<?php usces_url('member'); ?>#autodelivery" method="post" onKeyDown="if(event.keyCode == 13){return false;}">
							<?php welcart_basic_autodelivery_history(); ?>
							<input name="member_regmode" type="hidden" value="editmemberform" />
							<input name="member_id" type="hidden" value="<?php usces_memberinfo('ID'); ?>" />
							<div class="send">
								<input name="back" type="button" value="<?php _e('Back to the member page.', 'autodelivery'); ?>" onclick="location.href='<?php echo USCES_MEMBER_URL; ?>'" />
								<input name="top" type="button" value="<?php _e('Back to the top page.', 'usces'); ?>" onclick="location.href='<?php echo home_url(); ?>'" />
							</div>
							<?php do_action( 'wcad_action_autodelivery_history_page_inform' ); ?>
						</form>

						<div class="footer_explanation">
							<?php do_action( 'wcad_action_autodelivery_history_page_footer' ); ?>
						</div>

					</div><!-- end of memberinfo -->
				</div><!-- end of whitebox -->

			</div><!-- end of memberpages -->

		</article><!-- end of post -->

	<?php else: ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.', 'usces' ); ?></p>
	<?php endif; ?>
	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
