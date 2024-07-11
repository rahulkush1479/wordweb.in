<?php
/**
 * Darkness Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Darkness Blog
 */

add_theme_support( 'title-tag' );

add_theme_support( 'automatic-feed-links' );

add_theme_support( 'register_block_style' );

add_theme_support( 'register_block_pattern' );

add_theme_support( 'responsive-embeds' );

add_theme_support( 'wp-block-styles' );

add_theme_support( 'align-wide' );

add_theme_support(
	'html5',
	array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	)
);

add_theme_support(
	'custom-logo',
	array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	)
);

if ( ! function_exists( 'darkness_blog_setup' ) ) :
	function darkness_blog_setup() {
		/*
		* Make child theme available for translation.
		* Translations can be filed in the /languages/ directory.
		*/
		load_child_theme_textdomain( 'darkness-blog', get_stylesheet_directory() . '/languages' );
	}

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'darkness_blog_custom_background_args',
			array(
				'default-color' => '30323e',
				'default-image' => '',
			)
		)
	);

endif;
add_action( 'after_setup_theme', 'darkness_blog_setup' );

if ( ! function_exists( 'darkness_blog_enqueue_styles' ) ) :
	/**
	 * Enqueue scripts and styles.
	 */
	function darkness_blog_enqueue_styles() {
		$parenthandle = 'glowing-blog-style';
		$theme        = wp_get_theme();

		wp_enqueue_style(
			$parenthandle,
			get_template_directory_uri() . '/style.css',
			array(
				'glowing-blog-fonts',
				'glowing-blog-slick-style',
				'glowing-blog-fontawesome-style',
				'glowing-blog-blocks-style',
			),
			$theme->parent()->get( 'Version' )
		);

		wp_enqueue_style(
			'darkness-blog-style',
			get_stylesheet_uri(),
			array( $parenthandle ),
			$theme->get( 'Version' )
		);

		wp_enqueue_script( 'darkness-blog-custom-script', get_stylesheet_directory_uri() . '/assets/js/custom.min.js', array( 'jquery', 'glowing-blog-custom-script' ), $theme->get( 'Version' ), true );

	}

endif;

add_action( 'wp_enqueue_scripts', 'darkness_blog_enqueue_styles' );

require get_theme_file_path() . '/inc/customizer/customizer.php';

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function darkness_blog_body_classes( $classes ) {

	// added class for floating header.
	$classes[] = 'floating-header';

	return $classes;
}
add_filter( 'body_class', 'darkness_blog_body_classes' );

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses darkness_blog_header_style()
 */
function darkness_blog_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'glowing_blog_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => 'ffffff',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => 'glowing_blog_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'darkness_blog_custom_header_setup' );

/**
 * Pagination for archive.
 */
function darkness_blog_render_posts_pagination() {
	$is_pagination_enabled = get_theme_mod( 'glowing_blog_pagination_enable', true );
	if ( $is_pagination_enabled ) {
		$pagination_type = get_theme_mod( 'darkness_blog_pagination_type', 'numeric' );
		if ( 'default' === $pagination_type ) :
			the_posts_navigation();
		else :
			the_posts_pagination();
		endif;
	}
}
add_action( 'darkness_blog_posts_pagination', 'darkness_blog_render_posts_pagination', 10 );

function darkness_blog_load_custom_wp_admin_style() {
	?>
	<style type="text/css">

		.ocdi p.demo-data-download-link {
			display: none !important;
		}

	</style>

	<?php
}
add_action( 'admin_enqueue_scripts', 'darkness_blog_load_custom_wp_admin_style' );

// Style for demo data download link
function darkness_blog_admin_panel_demo_data_download_link() {
	?>
	<style type="text/css">
		p.darkness-blog-demo-data {
			font-size: 16px;
			font-weight: 700;
			display: inline-block;
			border: 0.5px solid #dfdfdf;
			padding: 8px;
			background: #ffff;
		}
	</style>
	<?php
}
add_action( 'admin_enqueue_scripts', 'darkness_blog_admin_panel_demo_data_download_link' );

// One Click Demo Import after import setup.
if ( class_exists( 'OCDI_Plugin' ) ) {
	require get_theme_file_path() . '/inc/demo-import.php';
}
