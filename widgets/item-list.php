<?php
class Basic_Item_List extends WP_Widget {
	function __construct() {
		parent::__construct( false, $name = __( 'Welcart product list', 'welcart_basic' ) );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$html = '';
		$title   = empty( $instance['title'] ) ? '' : $instance['title'];
		$term_id = empty( $instance['term_id'] ) ? usces_get_cat_id( 'item' ) : $instance['term_id'];
		$number  = empty( $instance['number'] ) ? 10 : $instance['number'];
		
		echo $before_widget;
		if( !empty( $title ) ) {
			echo $before_title . esc_html( $title ) . $after_title;
		}

		$item_args = array(
			'cat'  => $term_id,
			'posts_per_page' => $number,
		); 
		$item_query = new WP_Query( $item_args );
		if ( $item_query->have_posts() ) {
			$html .= '<div class="item-list">' . "\n";
			while ( $item_query->have_posts() ) {
				$item_query->the_post();
				usces_the_item();
				$post_id = get_the_ID();
				$list = '<article id="post-' . $post_id . '">' . "\n";
					$list .= '<a href="' . get_permalink( $post_id ) .'">' . "\n";
						$list .= '<div class="itemimg">' . usces_the_itemImage( 0, 300, 300, '', 'return' ) . '</div>' . "\n";
						$list .= '<div class="item-info-wrap"><div class="inner">' . "\n";
							$list .= '<div class="itemname">' . usces_the_itemName( 'return' ) . '</div>' . "\n";
							$list .= '<div class="itemprice">' . usces_the_firstPriceCr( 'return' ) . usces_guid_tax( 'return' ) . '</div>' . usces_crform_the_itemPriceCr_taxincluded( true, '', '', '', true, false, true, 'return' ) . get_welcart_basic_campaign_message() . "\n";
						$list .= '</div></div>' . "\n";
					$list .= '</a>' . "\n";
				$list .= '</article>';
				$html .= apply_filters( 'welcart_basic_filter_item_post', $list, $post_id );
			}
			wp_reset_postdata();
			$html .= '</div>' . "\n";
		}
		echo apply_filters( 'welcart_basic_filter_item_list', $html, $term_id, $number );
		echo $after_widget;
	}
	
	function form( $instance ) {
		$title        = empty( $instance['title'] ) ? '' : $instance['title'];
		$term_id      = empty( $instance['term_id'] ) ? usces_get_cat_id( 'item' ) : $instance['term_id'];
		$number       = empty( $instance['number'] ) ? 10 : $instance['number'];
		$target_arg	  = array(
			'child_of'	=>	usces_get_cat_id( 'item' ),
		);
		$target_terms = get_terms( 'category', $target_arg );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'term_id' ); ?>"><?php _e( 'Product category to show:', 'welcart_basic' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'term_id' ); ?>" name="<?php echo $this->get_field_name( 'term_id' ); ?>">
				<option value="<?php echo usces_get_cat_id( 'item' ); ?>"<?php if( $term_id == usces_get_cat_id( 'item' ) ) echo ' selected="selected"'; ?>><?php _e( 'Items', 'usces' ); ?></option>
				<?php foreach( $target_terms as $term ): ?>
				<option value="<?php echo $term->term_id; ?>"<?php if( $term_id == $term->term_id ) echo ' selected="selected"'; ?>><?php echo $term->name; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3">
		</p>
		<?php
	}
	
	function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance['title']   = strip_tags( $new_instance['title'] );
		$instance['term_id'] = strip_tags( $new_instance['term_id'] );
		$instance['number']  = strip_tags( $new_instance['number'] );
		return $instance;
	}
}
