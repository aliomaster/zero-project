<?php

/**** ALIO WIDGETS AREA ****/

function alio_wg() {
	register_widget( 'alio_socials' );
}

// ALIO Socials
class alio_socials extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'alio_socials', // Base ID
			'ALIO Socials', // Name
			array( 'description' => __( 'Display Logo Social Icons' ), ) // Args
		);
	}

	//widget output
	public function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		echo $before_widget;
		?>
			<?php if ( $logolink ): ?>
					<img class="footer_logo_img" src="<?php echo $logolink; ?>" alt="<?php echo bloginfo('name'); ?>">
			<?php endif; ?>
			<div class="social_block">
					<a class="twitterBtn smGlobalBtn" href="<?php echo $twlink; ?>" ></a>
					<a class="facebookBtn smGlobalBtn" href="<?php echo $fblink; ?>" ></a>
			</div>
		<?php
		echo $after_widget;
	}

	//save widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['logolink'] = strip_tags( $new_instance['logolink'] );
		$instance['twlink'] = strip_tags( $new_instance['twlink'] );
		$instance['fblink'] = strip_tags( $new_instance['fblink'] );

		return $instance;
	}

	//widget settings form
	public function form( $instance ) {
		extract( $instance );
		echo '
		<p><label>Logo link:</label>
			<input type="text" name="'.$this -> get_field_name( 'logolink' ).'" id="'.$this -> get_field_id( 'logolink' ).'" value="'.esc_attr($instance['logolink']).'" class="widefat" /></p>
		<p><label>Twitter link to icon:</label>
			<input type="text" name="' . $this->get_field_name( 'twlink' ) . '" id="' . $this->get_field_id( 'twlink' ) . '" value="' . esc_attr( $instance['twlink'] ) . '" class="widefat" /></p>
		<p><label>Facebook link to icon:</label>
			<input type="text" name="' . $this->get_field_name( 'fblink' ) . '" id="' . $this->get_field_id( 'fblink' ) . '" value="' . esc_attr( $instance['fblink'] ) . '" class="widefat" /></p>';
	}
}

//add_action( 'widgets_init', 'alio_wg', 30 );
