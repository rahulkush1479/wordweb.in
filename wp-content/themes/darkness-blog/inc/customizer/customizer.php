<?php

// upgrade to pro.
require get_theme_file_path() . '/inc/upgrade-to-pro/class-customize.php';

function darkness_blog_customize_register( $wp_customize ) {

	class Darkness_Blog_Toggle_Checkbox_Custom_control extends WP_Customize_Control {
		public $type = 'toogle_checkbox';

		public function render_content() {
			?>
			<div class="checkbox_switch">
				<div class="onoffswitch">
					<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="onoffswitch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" 
					<?php
					$this->link();
					checked( $this->value() );
					?>
					>
					<label class="onoffswitch-label" for="<?php echo esc_attr( $this->id ); ?>"></label>
				</div>
				<span class="customize-control-title onoffswitch_label"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo wp_kses_post( $this->description ); ?></p>
			</div>
			<?php
		}
	}

	// Banner section.
	require get_theme_file_path() . '/inc/customizer/banner.php';

	// Pagination - Pagination Style.
	$wp_customize->add_setting(
		'darkness_blog_pagination_type',
		array(
			'default'           => 'numeric',
			'sanitize_callback' => 'glowing_blog_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'darkness_blog_pagination_type',
		array(
			'label'           => esc_html__( 'Pagination Style', 'darkness-blog' ),
			'section'         => 'glowing_blog_pagination',
			'type'            => 'select',
			'choices'         => array(
				'default' => __( 'Default (Older/Newer)', 'darkness-blog' ),
				'numeric' => __( 'Numeric', 'darkness-blog' ),
			),
			'active_callback' => 'glowing_blog_pagination_enabled',
			'priority'        => 15,
		)
	);

}
add_action( 'customize_register', 'darkness_blog_customize_register' );

function darkness_blog_customize_preview_js() {
	wp_enqueue_script( 'darkness-blog-customizer', get_stylesheet_directory_uri() . '/assets/js/customizer.min.js', array( 'customize-preview', 'glowing-blog-customizer' ), true );
}
add_action( 'customize_preview_init', 'darkness_blog_customize_preview_js' );

function darkness_blog_custom_control_scripts() {
	wp_enqueue_style( 'darkness-blog-customize-controls', get_theme_file_uri() . '/assets/css/customize-controls.min.css' );
	wp_enqueue_script( 'darkness-blog-custom-controls-js', get_stylesheet_directory_uri() . '/assets/js/customize-control.min.js', array( 'glowing-blog-customize-control', 'jquery', 'jquery-ui-core' ), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'darkness_blog_custom_control_scripts' );
