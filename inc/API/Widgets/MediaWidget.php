<?php
namespace WPOOP\API\Widgets;

use WP_Widget;

class MediaWidget extends WP_Widget {

	public $widget_id;
	public $widget_name;
	public $widget_options  = array();
	public $control_options = array();

	public function __construct() {
		$this->widget_id   = 'wpoop_media_widget';
		$this->widget_name = 'WPOOP Media';

		$this->widget_options  = array(
			'classname'                   => $this->widget_id,
			'description'                 => 'A media widget',
			'customize_selective_refresh' => true,
		);
		$this->control_options = array(
			'width'  => 400,
			'height' => 400,
		);
	}

	public function register() {
		parent::__construct(
			$this->widget_id,
			$this->widget_name,
			$this->widget_options,
			$this->control_options
		);

		add_action( 'widgets_init', array( $this, 'widget_initialize' ) );
	}

	public function widget_initialize() {
		register_widget( $this );
	}


	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo $args['after_widget'];
	}

	public function form( $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {

		$instance          = $old_instance;
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}
