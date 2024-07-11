<?php
/**
 * Template part for displaying front page introduction.
 *
 * @package Darkness Blog
 */

// Banner Section.
$banner_section = get_theme_mod( 'darkness_blog_banner_section_enable', false );

if ( false === $banner_section ) {
	return;
}

$content_ids         = array();
$banner_content_type = get_theme_mod( 'darkness_blog_banner_section_content_type', 'post' );

if ( $banner_content_type === 'post' ) {

	for ( $i = 1; $i <= 4; $i++ ) {
		$content_ids[] = get_theme_mod( 'darkness_blog_banner_section_post_' . $i );
	}

	$args = array(
		'post_type'           => 'post',
		'post__in'            => array_filter( $content_ids ),
		'orderby'             => 'post__in',
		'posts_per_page'      => absint( 4 ),
		'ignore_sticky_posts' => true,
	);

} else {
	$cat_content_id = get_theme_mod( 'darkness_blog_banner_section_category' );
	$args           = array(
		'cat'            => $cat_content_id,
		'posts_per_page' => absint( 4 ),
	);
}

$query = new WP_Query( $args );
if ( $query->have_posts() ) {
	$button_label = get_theme_mod( 'darkness_blog_banner_section_button_label', __( 'Read More', 'darkness-blog' ) );
	?>
	<div id="darkness_blog_banner_section" class="frontpage banner-navigation banner-section">

		<div class="theme-wrapper">
			<div class="banner-section-wrapper style-3 adore-navigation">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<div class="banner-item">
						<div class="post-item overlay-post" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'post-thumbnail' ) ); ?>');">
							<div class="post-overlay">
								<div class="post-item-content">
									<div class="entry-cat overlay-cat">
										<?php the_category( '', '', get_the_ID() ); ?>
									</div>
									<h2 class="entry-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
									<ul class="entry-meta">
										<li class="post-author"> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="far fa-user"></i><?php echo esc_html( get_the_author() ); ?></a></li>
										<li class="post-date"><i class="far fa-calendar-alt"></i></span><?php echo esc_html( get_the_date() ); ?></li>
										<li class="reading-time"><i class="far fa-hourglass"></i>
											<?php
											echo glowing_blog_time_interval( get_the_content() );
											echo esc_html__( ' min', 'darkness-blog' );
											?>
										</li>
									</ul>
								</div>   
							</div>										
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>

	<?php

}
