<?php 

/***********************************************************
* setup theme_customizer
***********************************************************/
function welcart_basic_customize_register( $wp_customize ) {

	/* Remove Section
	------------------------------------------------------*/
	$wp_customize->remove_section( 'nav' );

	/* Theme Options
	------------------------------------------------------*/
	$wp_customize->add_section( 'welcart_basic_design', array(
		'title'		=> __('Theme Options' , 'welcart_basic'),
		'priority'	=> 100,
	) );

	/* Home Product List category */
	$cats = array();
	$cat = get_category_by_slug( 'item' );
	$cats_arg = array(
		'child_of'   => apply_filters( 'welcart_basic_home_target_category', $cat->term_id ),
		'hide_empty' => 0
	);
	$categories = get_categories( $cats_arg );
	foreach( $categories as $category ) {
		$cats[$category->slug] = $category->name;
	}
	$h_itemcat = get_theme_mod( 'h_itemcat', 'itemreco' );
	$h_itemnum = get_theme_mod( 'h_itemnum', '10' );

	$wp_customize->add_setting( 'welcart_basic_h_itemcat', array(
		'default'			=> $h_itemcat,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
	));
	$wp_customize->add_control( 'h_itemcat', array(
		'label'				=> __('Home Product List category', 'welcart_basic'),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'welcart_basic_h_itemcat',
		'type'				=> 'select',
		'choices'			=> $cats,
		'active_callback'	=> 'callback_is_front_page',
		'priority'			=> 111,
	));

	/* Home Product List number */
	$wp_customize->add_setting( 'welcart_basic_h_itemnum', array(
		'default'			=> $h_itemnum,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
	));
	$wp_customize->add_control( 'h_itemnum', array(
		'label'				=> __('Home Product List number', 'welcart_basic'),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'welcart_basic_h_itemnum',
		'type'				=> 'number',
		'input_attrs'		=> array('min' => '1'),
		'active_callback'	=> 'callback_is_front_page',
		'priority'			=> 121,
	));

	/* Callback
	------------------------------------------------------*/
	function callback_is_front_page() {
		return 'posts' == get_option( 'show_on_front' ) && ( is_home() || is_front_page() );
	}
}
add_action( 'customize_register', 'welcart_basic_customize_register' );

function welcart_basic_posts_per_page( $query ) {
	if( is_admin() || !$query->is_main_query() ) {
		return;
	}

	if( 'posts' == get_option( 'show_on_front' ) && ( $query->is_home() || $query->is_front_page() ) ) {
		$h_itemcat = get_option( 'welcart_basic_h_itemcat' );
		$h_itemnum = get_option( 'welcart_basic_h_itemnum' );
		if( empty( $h_itemcat ) ) $h_itemcat = 'itemreco';
		if( empty( $h_itemnum ) ) $h_itemnum = '10';
		$sticky_posts = get_option( 'sticky_posts' );
		if( ! empty( $sticky_posts ) ) {
			foreach( $sticky_posts as $i => $post_id ) {
				$target_post = get_post( $post_id );
				if( 'item' == $target_post->post_mime_type ) {
					unset( $sticky_posts[$i] );
				}
			}
		}

		$query->set( 'category_name', $h_itemcat );
		$query->set( 'posts_per_page', $h_itemnum );
		$query->set( 'post__not_in', $sticky_posts );
		
		return;
	}
}
add_action( 'pre_get_posts', 'welcart_basic_posts_per_page' );