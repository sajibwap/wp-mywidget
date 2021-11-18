<?php 

class imgUploader extends WP_Widget{
	public function __construct(){
		parent::__construct(
			'imguploader',
			'Demo Image Uploader',
			array($this,'Image Uploader demo info')
		);
	}
	public function form($instance){
		$title = isset($instance['title']) ? $instance['title'] : "Image Title";
		$image_id = isset($instance['image']) ? $instance['image'] : "";
		$image_url = wp_get_attachment_image_src( $image_id, 'thumbnail', false );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">Title</label>
			<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name( 'title' )) ?>" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" value="<?php echo esc_attr($title) ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('image') ); ?>">Upload an Image</label>
			<p class="img-preview"><img src="<?php echo esc_attr( $image_url[0] ); ?>" alt=""></p>
			<input type="hidden" class="widefat img-id" name="<?php echo esc_attr($this->get_field_name( 'image' )) ?>" id="<?php echo esc_attr( $this->get_field_id('image') ); ?>" value="<?php echo esc_attr($image_id) ?>">
			<p><input type="button" class="button button-primary imguploader" value="Upload"></p>
		</p>
		<?php
	}

	public function update($new_instance, $old_instance){
		$instance = array();
		$instance['title'] = $new_instance['title'];
		$instance['image'] = $new_instance['image'];
		return $instance;
	}



}