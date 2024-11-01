<?php 
/*
Plugin Name: Show Youtube Subscribe Button 
Plugin URI:   http://skybootstrap.com/plugins/youtube-subscribe-button
Description:  This is widget of showing youtube subscribe button on your widget area.
Version:      1.
Author:       skybootstrap
Author URI:   http://skybootstrap.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  skyboot-ysb
*/
if( !defined('ABSPATH') ) exit;

// class
class Skyboot_Youtube_Scribe_Button_Widget extends WP_Widget {

	// actual widget processes
	public function __construct(){
		$widget_ops = array(
			"classname" => "skyboot_youtube_subscrib_button",
			"description" => esc_html__( 'Show your youtube subscribe button.', 'skyboot-ysb' )
		);
		parent::__construct( "skyboot_youtube_subscrib_button", "Skyboot Youtube Subscribe Button", $widget_ops  );
	}

	// widget title
    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
        'before_widget' => '<div class="widget-wrap">',
        'after_widget'  => '</div>'
    );

	// outputs the content of the widget
	public function widget( $args , $instance ){

		echo $args['before_widget'] ;

		if( !empty( $instance['title'] ) ){
			echo $args['before_title']. apply_filters( "widget_title", $instance['title'] ). $args['after_title'];
		}

		echo '<div class="g-ytsubscribe" data-theme="dark" data-channel="'. $instance['chanel_name'] .'" data-layout="'. $instance['layout'] .'" data-count="'. $instance['count'] .'"></div>';

		echo $args['after_widget'];


	}

	// outputs the options form in the admin
	public function form( $instance ){

        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'skyboot-ysb' );
        $chanel_name = ! empty( $instance['chanel_name'] ) ? $instance['chanel_name'] : esc_html__( '', 'skyboot-ysb' );
        $layout = ! empty( $instance['layout'] ) ? $instance['layout'] : esc_html__( '', 'skyboot-ysb' );
        $count = ! empty( $instance['count'] ) ? $instance['count'] : esc_html__( '', 'skyboot-ysb' );
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'skyboot-ysb' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'chanel_name' ) ); ?>"><?php echo esc_html__( 'Chanel Name:', 'skyboot-ysb' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'chanel_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'chanel_name' ) ); ?>" type="text" value="<?php echo esc_attr( $chanel_name ); ?>">
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php echo esc_html__( 'Layout:', 'skyboot-ysb' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>">
            	<option value="default" <?php echo ( $layout == 'default' ) ? 'selected' : ''; ?> >
            		Default
            	</option>
            	<option value="full" <?php echo ( $layout == 'full' ) ? 'selected' : ''; ?> >
            		Full
            	</option>
            </select>
        </p>

        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php echo esc_html__( 'Count:', 'skyboot-ysb' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>">
            	<option value="default" <?php echo ( $count == 'default' ) ? 'selected' : ''; ?> >
            		Default
            	</option>
            	<option value="hidden" <?php echo ( $count == 'hidden' ) ? 'selected' : ''; ?> >
            		Hidden
            	</option>
            </select>
        </p>

        <?php		

	}

	// processes widget options to be saved
	public function update( $new_instance, $old_instance ){

        $instance = array();
 
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : ''; 
        $instance['chanel_name'] = ( !empty( $new_instance['chanel_name'] ) ) ? $new_instance['chanel_name'] : ''; 
        $instance['layout'] = ( !empty( $new_instance['layout'] ) ) ? $new_instance['layout'] : ''; 
        $instance['count'] = ( !empty( $new_instance['count'] ) ) ? $new_instance['count'] : ''; 

        return $instance;		

	}

}
$skyboot_widget = new Skyboot_Youtube_Scribe_Button_Widget();

// register widget
function skyboot_youtube_scribe_button_widget() {
    register_widget( 'Skyboot_Youtube_Scribe_Button_Widget' );
}
add_action( 'widgets_init', 'skyboot_youtube_scribe_button_widget' );

//Enqueue Script
function skyboot_youtube_scribe_button_enqueue() {

	// google script
    wp_register_script( 'google-js', 'https://apis.google.com/js/platform.js');
    wp_enqueue_script('google-js');

}
add_action( 'wp_enqueue_scripts', 'skyboot_youtube_scribe_button_enqueue' );

