<?php
/**
 * Adore Themes Customizer
 *
 * @package Darkness Blog
 *
 * Banner Section
 */

$wp_customize->add_section(
	'darkness_blog_banner_section',
	array(
		'title'    => esc_html__( 'Banner Section', 'darkness-blog' ),
		'panel'    => 'glowing_blog_frontpage_panel',
		'priority' => 10,
	)
);

// Banner section enable settings.
$wp_customize->add_setting(
	'darkness_blog_banner_section_enable',
	array(
		'default'           => false,
		'sanitize_callback' => 'glowing_blog_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Darkness_Blog_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'darkness_blog_banner_section_enable',
		array(
			'label'    => esc_html__( 'Enable Banner Section', 'darkness-blog' ),
			'type'     => 'checkbox',
			'settings' => 'darkness_blog_banner_section_enable',
			'section'  => 'darkness_blog_banner_section',
		)
	)
);

// Banner Section content type settings.
$wp_customize->add_setting(
	'darkness_blog_banner_section_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'glowing_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'darkness_blog_banner_section_content_type',
	array(
		'label'           => esc_html__( 'Content type:', 'darkness-blog' ),
		'description'     => esc_html__( 'Choose where you want to render the content from.', 'darkness-blog' ),
		'section'         => 'darkness_blog_banner_section',
		'type'            => 'select',
		'active_callback' => 'darkness_blog_if_banner_section_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'darkness-blog' ),
			'category' => esc_html__( 'Category', 'darkness-blog' ),
		),
	)
);

for ( $i = 1; $i <= 4; $i++ ) {
	// Banner Section post setting.
	$wp_customize->add_setting(
		'darkness_blog_banner_section_post_' . $i,
		array(
			'sanitize_callback' => 'glowing_blog_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'darkness_blog_banner_section_post_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Post %d', 'darkness-blog' ), $i ),
			'section'         => 'darkness_blog_banner_section',
			'type'            => 'select',
			'choices'         => glowing_blog_get_post_choices(),
			'active_callback' => 'darkness_blog_banner_section_content_type_post_enabled',
		)
	);

}

// Banner Section category setting.
$wp_customize->add_setting(
	'darkness_blog_banner_section_category',
	array(
		'sanitize_callback' => 'glowing_blog_sanitize_select',
	)
);

$wp_customize->add_control(
	'darkness_blog_banner_section_category',
	array(
		'label'           => esc_html__( 'Category', 'darkness-blog' ),
		'section'         => 'darkness_blog_banner_section',
		'type'            => 'select',
		'choices'         => glowing_blog_get_post_cat_choices(),
		'active_callback' => 'darkness_blog_banner_section_content_type_category_enabled',
	)
);

// Banner Section button label setting.
$wp_customize->add_setting(
	'darkness_blog_banner_section_button_label',
	array(
		'default'           => __( 'Read More', 'darkness-blog' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'darkness_blog_banner_section_button_label',
	array(
		'label'           => esc_html__( 'Button Label', 'darkness-blog' ),
		'section'         => 'darkness_blog_banner_section',
		'type'            => 'text',
		'active_callback' => 'darkness_blog_if_banner_section_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'darkness_blog_banner_section_button_label',
		array(
			'selector'            => '.banner-section .post-btn a',
			'settings'            => 'darkness_blog_banner_section_button_label',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'darkness_blog_banner_section_button_label_text_partial',
		)
	);
}

/*========================Active Callback==============================*/
function darkness_blog_if_banner_section_enabled( $control ) {
	return $control->manager->get_setting( 'darkness_blog_banner_section_enable' )->value();
}
function darkness_blog_banner_section_content_type_post_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'darkness_blog_banner_section_content_type' )->value();
	return darkness_blog_if_banner_section_enabled( $control ) && ( 'post' === $content_type );
}
function darkness_blog_banner_section_content_type_category_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'darkness_blog_banner_section_content_type' )->value();
	return darkness_blog_if_banner_section_enabled( $control ) && ( 'category' === $content_type );
}

/*========================Partial Refresh==============================*/
if ( ! function_exists( 'darkness_blog_banner_section_button_label_text_partial' ) ) :
	// Read More Button.
	function darkness_blog_banner_section_button_label_text_partial() {
		return esc_html( get_theme_mod( 'darkness_blog_banner_section_button_label' ) );
	}
endif;
