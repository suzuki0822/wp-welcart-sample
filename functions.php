<?php
/**
 * @package Welcart
 * @subpackage Welcart_Basic
 */


/***********************************************************
* wp_body_open
***********************************************************/

if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/***********************************************************
* check the execution of welcart
***********************************************************/
if( !welcart_basic_is_active( 'usc-e-shop/usc-e-shop.php' ) ) {
	add_action( 'admin_notices', 'welcart_basic_echo_message' );
}

function welcart_basic_echo_message() {
	echo '<div class="message error"><p>'.__("Welcart Basic theme requires <strong>Welcart e-Commerce</strong>. Please <a href=\"plugins.php\">enable Welcart e-Commerce</a>.", 'welcart_basic' ).'</p></div>';
}

function welcart_basic_is_active( $plugin ) {
	if( function_exists('is_plugin_active') ) {
		return is_plugin_active( $plugin );
	} else {
		return in_array(
			$plugin,
			get_option('active_plugins')
		);
	}
}

/***********************************************************
* welcart_setup
***********************************************************/
if ( ! function_exists( 'welcart_basic_setup' ) ):
function welcart_basic_setup() {

	load_theme_textdomain( 'welcart_basic', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );

	register_nav_menus( array(
		'header' => __( 'Header Navigation', 'usces' ),
		'footer' => __( 'Footer Navigation', 'usces' ),
	) );

	add_theme_support( 'custom-header', apply_filters( 'welcart_basic_custom_header_args', array(
		'default-image'	=> get_template_directory_uri() . '/images/image-top.jpg',
		'width'			=> '1000',
		'height'		=> '400',
		'header-text'	=> false,
	) ) );
	register_default_headers( array(
		'basic-default'	=> array(
			'url'			=> '%s/images/image-top.jpg',
			'thumbnail_url'	=> '%s/images/image-top.jpg',
		)
	) );
}
endif;
add_action( 'after_setup_theme', 'welcart_basic_setup' );

if ( !defined('USCES_VERSION') ) return;

/***********************************************************
* includes
***********************************************************/
require( get_template_directory() . '/inc/template-functions.php' );
require( get_template_directory() . '/inc/widget-customized.php' );
require( get_template_directory() . '/inc/front-customized.php' );
/*	Theme customizer	*/
require( dirname( __FILE__ ) . '/inc/theme-customizer.php' );

/*-------------------------------------------*/
/*	Admin page _ Add style
/*-------------------------------------------*/
function basic_admin_enqueue( $hook ){
	if( 'welcart-shop_page_usces_itemedit' == $hook || 'widgets.php' == $hook ){
		wp_enqueue_style( 'basic_admin_style', get_template_directory_uri() . '/css/admin.css', array() );
	}
}
add_action( 'admin_enqueue_scripts', 'basic_admin_enqueue' );

function welcart_theme_version(){
	$themename = 'welcart_basic';
	$theme = wp_get_theme( $themename );
	$theme_ver = !empty($theme) ? $theme->get('Version') : '0';
	echo "<!-- Type Basic : v".$theme_ver." -->\n";
}
add_action( 'wp_footer', 'welcart_theme_version' );

/***********************************************************
* welcart_page_menu_args
***********************************************************/
function welcart_basic_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'welcart_basic_page_menu_args' );

/***********************************************************
* sidebar
***********************************************************/
function welcart_basic_widgets_init() {
	require get_template_directory() . '/widgets/item-list.php';

	register_widget( 'Basic_Item_List' );

	register_sidebar(array(
		'name' => __( 'Home Left Widget', 'welcart_basic' ),
		'id' => 'left-widget-area',
		'description' => __( 'Widget area left of the top page footer top', 'welcart_basic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget_title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Home Center Widget', 'welcart_basic' ),
		'id' => 'center-widget-area',
		'description' => __( 'Widget area center of the top page footer top', 'welcart_basic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget_title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' =>  __( 'Home Right Widget', 'welcart_basic' ),
		'id' => 'right-widget-area',
		'description' => __( 'Widget area right of the top page footer top', 'welcart_basic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget_title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __( 'Sidebar Widget 1', 'welcart_basic' ),
		'id' => 'side-widget-area1',
		'description' => apply_filters( 'welcart_basic_side_widgetarea1_description', __( 'Widget area Product Details page or category page or search page', 'welcart_basic' ) ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget_title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __( 'Sidebar Widget 2', 'welcart_basic' ),
		'id' => 'side-widget-area2',
		'description' => __( 'Widget area of posts and pages', 'welcart_basic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="widget_title">',
		'after_title' => '</h3>',
	));
}
add_action( 'widgets_init', 'welcart_basic_widgets_init' );

/***********************************************************
* wp_enqueue_scripts
***********************************************************/
if ( ! function_exists( 'welcart_basic_scripts_styles' ) ) {
	function welcart_basic_scripts_styles() {
		global $usces, $is_IE;

		$template_dir = get_template_directory_uri();

		wp_enqueue_style( 'wc-basic-style', get_stylesheet_uri(), array(), '1.0' );
		wp_enqueue_style( 'font-awesome', $template_dir . '/font-awesome/font-awesome.min.css', array(), '1.0' );

		if(defined('WCEX_POPLINK') ) {
			if( welcart_basic_is_poplink_page() ) {
				wp_enqueue_style( 'wc_basic_poplink', $template_dir . '/css/poplink.css', array(), '1.0' );
			}
		}

		if( $is_IE ) {
			wp_enqueue_style( 'wc-basic-ie', $template_dir . '/css/ie.css', array(), '1.0' );
			wp_enqueue_script( 'wc_basic_css3', $template_dir . '/js/css3-mediaqueries.js', array(), '1.0');
			wp_enqueue_script( 'wc-basic_html5', $template_dir . '/js/html5shiv.js', array(), '1.0');
		}

		wp_enqueue_script( 'wc-basic-js', $template_dir . '/js/front-customized.js', array(), '1.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'welcart_basic_scripts_styles' );


function welcart_basic_luminous_scripts() {
	if( is_singular() ) {
		wp_enqueue_style( 'luminous-basic-css', get_theme_file_uri( '/css/luminous-basic.css' ), array(), '1.0' );
		wp_enqueue_script( 'luminous', get_theme_file_uri( '/js/luminous.min.js' ), array(), '1.0', true );
		wp_enqueue_script( 'wc-basic_luminous', get_theme_file_uri( '/js/wb-luminous.js' ), array(), '1.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'welcart_basic_luminous_scripts' );


/***********************************************************
* excerpt
***********************************************************/
if ( ! function_exists( 'welcart_assistance_excerpt_length' ) ) {
	function welcart_assistance_excerpt_length( $length ) {
		return 10;
	}
}
if ( ! function_exists( 'welcart_assistance_excerpt_mblength' ) ) {
	function welcart_assistance_excerpt_mblength( $length ) {
		return 40;
	}
}
if ( ! function_exists( 'welcart_excerpt_length' ) ) {
	function welcart_excerpt_length( $length ) {
		return 40;
	}
}
add_filter( 'excerpt_length', 'welcart_excerpt_length' );

if ( ! function_exists( 'welcart_excerpt_mblength' ) ) {
	function welcart_excerpt_mblength( $length ) {
		return 110;
	}
}
add_filter( 'excerpt_mblength', 'welcart_excerpt_mblength' );

if ( ! function_exists( 'welcart_continue_reading_link' ) ) {
	function welcart_continue_reading_link() {
		return ' <a href="'. get_permalink() . '">' . __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'welcart_basic' ) . '</a>';
	}
}
if ( ! function_exists( 'welcart_auto_excerpt_more' ) ) {
	function welcart_auto_excerpt_more( $more ) {
		return ' &hellip;' . welcart_continue_reading_link();
	}
}
//add_filter( 'excerpt_more', 'welcart_auto_excerpt_more' );

if ( ! function_exists( 'welcart_custom_excerpt_more' ) ) {
	function welcart_custom_excerpt_more( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= welcart_continue_reading_link();
		}
		return $output;
	}
}
//add_filter( 'get_the_excerpt', 'welcart_custom_excerpt_more' );

/***********************************************************
* pre_get_posts
***********************************************************/
function welcart_basic_query( $query ) {
	$item_cat = get_category_by_slug('item');
	$item_cat_id = $item_cat->cat_ID;
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( $query->is_search && !isset($_GET['searchitem']) ) {
		$query->set('category_name','item');
	}
}
add_action( 'pre_get_posts', 'welcart_basic_query' );

/***********************************************************
 * search_form
************************************************************/
function welcart_basic_search_form( $form ) {
    $form = '<form role="search" method="get" action="'.home_url( '/' ).'" >
		<div class="s-box">
			<input type="text" value="' . get_search_query() . '" name="s" id="s-text" class="search-text" />
			<input type="submit" id="s-submit" class="searchsubmit" value="&#xf002;" />
		</div>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'welcart_basic_search_form' );

/***********************************************************
 * get_head_search_form
************************************************************/
function get_head_search_form() {
	
    $form = '<form role="search" method="get" action="'.home_url( '/' ).'" >
		<div class="s-box">
			<input type="text" value="' . get_search_query() . '" name="s" id="head-s-text" class="search-text" />
			<input type="submit" id="head-s-submit" class="searchsubmit" value="&#xf002;" />
		</div>
    </form>';

	echo $form;
}

/***********************************************************
* Plugin Hook Remove
***********************************************************/
//WCEX Mobile
remove_filter( 'usces_filter_cart_row', 'wcmb_cart_row_of_smartphone_wct', 10, 3);
remove_filter( 'usces_filter_confirm_row', 'wcmb_confirm_row_of_smartphone_wct', 10, 3);

function welcart_basic_the_post(){
	global $post;

	if ( 'item' === $post->post_mime_type ){
		$select_sku_switch = get_post_meta($post->ID, '_select_sku_switch', true);
		if(  !defined("WCEX_SKU_SELECT") || 1 != $select_sku_switch ){
			remove_action( 'usces_action_single_item_outform', 'wcad_action_single_item_outform' );
			add_action( 'usces_action_single_item_outform', 'welcart_basic_action_single_item_outform' );
		}
	}
}
add_action( 'the_post', 'welcart_basic_the_post', 9 );

function welcart_basic_init(){
	add_filter('wcex_sku_select_filter_single_item_autodelivery', 'welcart_basic_single_item_autodelivery_sku_select');
}
add_action( 'init', 'welcart_basic_init', 9 );


/***********************************************************
* Theme Update checker
***********************************************************/
//@set_site_transient( 'update_plugins', null );
require( get_template_directory() . '/inc/theme-update-checker.php');
$welcart_theme_update_checker = new ThemeUpdateChecker(
'welcart_basic',
'http://www.welcart.com/update_info/themes/welcart_basic.json'
);