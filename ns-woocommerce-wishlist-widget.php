<?php

class ns_custom_Widget_Whishlist extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'ns_class_wishlist',
			'description' => 'Display wishlist.',
		);
		parent::__construct( 'ns_wishlist', 'NS Wishlist', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
			echo $args['before_widget'];
		if ( ! empty( $instance['ns_title_wishlist'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['ns_title_wishlist'] ) . $args['after_title'];
		}
		?>
		<?php
		    $print_ns_short = ns_print_wishlist('widget');
			echo '<div style="width: 100%; clear: both;" id="ns_my_wishlist_widget">' . $print_ns_short . '</div>';

		?>

		<?php
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$ns_title_wishlist = ! empty( $instance['ns_title_wishlist'] ) ? $instance['ns_title_wishlist'] : '';
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'ns_title_wishlist' ) ); ?>"><?php _e( esc_attr( 'Title:', 'woocommerce' ) ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ns_title_wishlist' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ns_title_wishlist' ) ); ?>" type="text" value="<?php echo esc_attr( $ns_title_wishlist ); ?>">
		</p>						
		<?php 	
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['ns_title_wishlist'] = ( ! empty( $new_instance['ns_title_wishlist'] ) ) ? strip_tags( $new_instance['ns_title_wishlist'] ) : '';

		return $instance;
	}
}




add_action( 'widgets_init', function(){
	register_widget( 'ns_custom_Widget_Whishlist' );
});
?>