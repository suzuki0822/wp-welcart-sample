<?php
get_header();
?>
<div id="primary" class="site-content">
    <div id="content" class="cart-page" role="main">
        <?php if (have_posts()) :
            usces_remove_filter(); ?>

            <article class="post" id="wc_confirm">
                
                <div id="quickpay_wrapper">
                    <div id="checkout_review" class="wcexaap">
                        <div id="info-confirm">
                            <h1 class="cart_page_title"><?php _e('Confirmation', 'usces'); ?></h1>

                            <div class="confiem_notice">
                                <?php _e('Please do not change product addition and amount of it with the other window with displaying this page.', 'usces'); ?>
                            </div>

                            <div class="header_explanation">
                                <?php do_action('usces_action_confirm_page_header'); ?>
                                <?php echo $this->filterTemplateTopErrorMessage(''); ?>
                            </div>

                            <?php do_action('usces_action_delivery_page_inform'); ?>
                            <div id="cart">
                                <?php $this->loadCartComponents(); ?>
                            </div>
                            <?php $this->loadConfirmComponents(); ?>
                            <div class="footer_explanation">
                                <?php echo $this->filterTemplateBottomErrorMessage(''); ?>
                                <?php do_action('usces_action_confirm_page_footer'); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </article>

        <?php else : ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php
get_footer();
