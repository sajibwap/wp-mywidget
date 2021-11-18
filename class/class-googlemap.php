<?php 

class DemoWidgetGoogleMap extends WP_Widget{
	public function __construct(){
		parent::__construct(
			'demowidget',
			__('Demo Widget','textdomain'),
			array($this,'Widget Info')
		);
	}
	public function form($instance){
		$title 		= isset($instance['title']) ? $instance['title'] : 'Demo title';
		$location 	= isset($instance['location']) ? $instance['location'] : 'Bangladesh';
		$phone 		= isset($instance['phone']) ? $instance['phone'] : '344';
		$email 		= isset($instance['email']) ? $instance['email'] : 'email@email.com';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title' ) ); ?>"><?php _e('Title','textdomain'); ?></label>
			<input class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" id="<?php echo esc_attr( $this->get_field_id('title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" autocomplete="off">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('location' ) ); ?>"><?php _e('Location','textdomain'); ?></label>
			<input class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('location')); ?>" id="<?php echo esc_attr( $this->get_field_id('location' ) ); ?>" value="<?php echo esc_attr( $location ); ?>" autocomplete="off">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('phone' ) ); ?>"><?php _e('Phone','textdomain'); ?></label>
			<input class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" id="<?php echo esc_attr( $this->get_field_id('phone' ) ); ?>" value="<?php echo esc_attr( $phone ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('email' ) ); ?>"><?php _e('Email','textdomain'); ?></label>
			<input class="widefat" type="text" name="<?php echo esc_attr($this->get_field_name('email')); ?>" id="<?php echo esc_attr( $this->get_field_id('email' ) ); ?>" value="<?php echo esc_attr( $email ); ?>">
		</p>
		<?php
	}

	public function update($new_instance, $old_instance ){
		$instance = $new_instance;
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['location'] = sanitize_text_field($new_instance['location']);
		if (!is_numeric($new_instance['phone'])) {
			$instance['phone'] = $old_instance['phone'];
		}
		if (!is_email($new_instance['email'])) {
			$instance['email'] = $old_instance['email'];
		}
		return $instance;
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if (isset($instance['title']) && $instance['title']!='') {
			echo $args['before_title'];
			echo apply_filters( 'widget_title', $instance['title'] );
			echo $args['after_title'];
		}

		if (isset($instance['location']) && $instance['location']!='') {
			echo '<div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q='.$instance['location'].'&t=&z=11&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.whatismyip-address.com/elementor/">elementor pro discount</a><br><style>.mapouter{position:relative;text-align:right;height:300px;width:100%;}</style><a href="https://www.embedgooglemap.net"></a><style>.gmap_canvas {overflow:hidden;background:none!important;height:300px;width:100%;}</style></div></div><p>'.$instance['phone'].'<br/>'.$instance['email'].'</p>';
		}


		echo $args['after_widget'];
	}

}