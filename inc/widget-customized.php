<?php
/***********************************************************
* Explanation : bestseller
***********************************************************/
function welcart_basic_filter_bestseller( $list, $post_id, $i ) {
	global $usces;
	$post = get_post( $post_id );

	$list  = '<li>'."\n";
	$list .= '<div class="itemimg"><a href="'.get_permalink($post_id).'">'.usces_the_itemImage( 0, 192, 192, $post, 'return' ).'</a></div>'."\n";
	$list .= '<div class="itemname"><a href="'.get_permalink($post_id).'">'.get_the_title($post_id).'</a></div>'."\n";
	if( usces_have_zaiko_anyone( $post_id ) ) {
		$list .= '<div class="itemprice">' . usces_the_firstPriceCr( 'return', $post ) . usces_guid_tax('return') . '</div>'."\n";
		$list .= usces_crform_itemPriceCr_taxincluded( $post_id );
	} else {
		$skus = $usces->get_skus( $post_id );
		$num = $skus[0]['stock'];
		$list .= '<div class="itemsoldout">'.$usces->zaiko_status[$num].'</div>'."\n";
	}
	$list .= '</li>'."\n";

	return $list;
}
add_filter( 'usces_filter_bestseller', 'welcart_basic_filter_bestseller', 10, 3 );
