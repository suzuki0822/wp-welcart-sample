<?php
/***********************************************************
* usces_cart.css Reset
***********************************************************/
function welcart_basic_remove_usces_cart_css() {
	global $usces;
	$usces->options['system']['no_cart_css'] = 1;
}
add_action( 'wp_enqueue_scripts', 'welcart_basic_remove_usces_cart_css', 8 );

/***********************************************************
* Search results exclude the member page and cart page
***********************************************************/
function welcart_basic_search_filter( $query ) {
	$page_cart = get_page_by_path( 'usces-cart' );
	$page_member = get_page_by_path( 'usces-member' );
	if( !$query->is_admin && $query->is_search ) {
		$query->set( 'post__not_in', array( $page_cart->ID, $page_member->ID ) );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'welcart_basic_search_filter' );

/***********************************************************
* NO-IMAGE
***********************************************************/
function welcart_basic_icon_dirs() {
	if( file_exists(get_stylesheet_directory().'/images/crystal/default.png') ){
		$icon_dir = get_stylesheet_directory().'/images/crystal';
		$icon_dir_uri = get_stylesheet_directory_uri().'/images/crystal';
	}else{
		$icon_dir = get_template_directory().'/images/crystal';
		$icon_dir_uri = get_template_directory_uri().'/images/crystal';
	}
	$icon_dirs = array( $icon_dir => $icon_dir_uri );
	return $icon_dirs;
}
add_filter( 'icon_dirs', 'welcart_basic_icon_dirs' );

/***********************************************************
* Update settlement page sidebar
***********************************************************/
function welcart_basic_member_update_settlement_page_sidebar( $sidebar ) {
	return '';
}
add_filter( 'usces_filter_member_update_settlement_page_sidebar', 'welcart_basic_member_update_settlement_page_sidebar' );

/***********************************************************
* Image size of assistance item
***********************************************************/
function welcart_basic_assistance_item_size( $size ) {
	return 165;
}
add_filter( 'usces_filter_assistance_item_width', 'welcart_basic_assistance_item_size' );
add_filter( 'usces_filter_assistance_item_height', 'welcart_basic_assistance_item_size' );

/***********************************************************
* Image size of list item
***********************************************************/
function welcart_basic_item_list_loopimg( $html, $content ) {
	global $post;
	
	$html	= '<div class="loopimg"><a href="' . get_permalink($post->ID) . '">' . usces_the_itemImage(0, 300, 300, $post, 'return') . '</a></div>' .
	'<div class="loopexp"><div class="field">' . $content . '</div></div>';
	
	return $html;
}
add_filter( 'usces_filter_item_list_loopimg', 'welcart_basic_item_list_loopimg', 10, 2);

/***********************************************************
* Campaign discount
***********************************************************/
function get_welcart_basic_campaign_message( $post_id = NULL ){
	global $post, $usces;
	if( NULL == $post_id ) $post_id = $post->ID;
	
	$html		= '';
	$options	= $usces->options;
	
	if ( 'Promotionsale' == $options[ 'display_mode' ] && in_category( (int)$options[ 'campaign_category' ], $post_id ) ) {
		if ( 'discount' == $options['campaign_privilege'] && !empty( $options[ 'privilege_discount' ] ) ){
			$html = '<div class="campaign_message campaign_discount">' . sprintf( __( 'Save %d&#37;', 'welcart_basic' ), $options[ 'privilege_discount' ] ) .'</div>';
		}else if ( 'point' == $options['campaign_privilege'] && !empty( $options[ 'privilege_point' ] ) ){
			$html = '<div class="campaign_message campaign_point">' . sprintf( __( '%d times more points', 'welcart_basic' ), $options[ 'privilege_point' ] ) .'</div>';
		}
	}

	return apply_filters( 'welcart_basic_filter_campaign_message', $html, $post_id );
}
function welcart_basic_campaign_message( $post_id = NULL ){
	echo get_welcart_basic_campaign_message( $post_id );
}

/***********************************************************
* Remove hentry
***********************************************************/
add_filter( 'post_class', 'welcart_basic_remove_hentry' );
function welcart_basic_remove_hentry( $classes ) {

	$idx = array_search( 'hentry', $classes );
	if( $idx !== false )
		unset( $classes[$idx] );

	return $classes;
}

/***********************************************************
* Widget cart alert
***********************************************************/
add_action( 'init', 'welcart_basic_widgetcart_init', 99 );
function welcart_basic_widgetcart_init(){
	if( is_admin() || !defined('WCEX_WIDGET_CART_VERSION') )
		return;
		
	remove_filter( 'usces_filter_uscesL10n', 'widgetcart_filter_uscesL10n' );
	add_filter( 'usces_filter_uscesL10n', 'welcart_basic_widgetcart_uscesL10n' );
}
function welcart_basic_widgetcart_uscesL10n(){
	global $usces;
	
	if( $usces->is_cart_or_member_page($_SERVER['REQUEST_URI']) || $usces->is_inquiry_page($_SERVER['REQUEST_URI']) ){
		echo "'widgetcartUrl': '" . WCEX_WIDGET_CART_URL . "',\n";
		echo "'widgetcartHome': '" . USCES_SSL_URL . "',\n";
	}else{
		echo "'widgetcartUrl': '" . WCEX_WIDGET_CART_URL . "',\n";
		echo "'widgetcartHome': '" . get_option('home') . "',\n";
	}
	echo "'widgetcartMes01': '" . __('Added to the cart.', 'widgetcart') . '<div id="wdgctToCheckout"><a href="' . USCES_CUSTOMER_URL . '">' . __('Proceed to checkout','usces') . '</a></div>' . "',\n";
	echo "'widgetcartMes02': '" . __('Deleted from the cart.', 'widgetcart') . "',\n";
	echo "'widgetcartMes03': '" . __('Putting this article in the cart.', 'widgetcart') . "',\n";
	echo "'widgetcartMes04': '" . __('Please wait for a while.', 'widgetcart') . "',\n";
	echo "'widgetcartMes05': '" . __('Deleting an article from the cart.', 'widgetcart') . "',\n";
	echo "'widgetcart_fout': 5000,\n";

	return '';
}
