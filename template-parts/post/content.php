<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Inspiro
 * @subpackage Inspiro_Lite
 * @since Inspiro Lite 1.0.0
 * @version x.x.x
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'inspiro-featured-image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<header class="entry-header">

		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		
		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">';
			if ( is_single() ) {
				inspiro_posted_on();
			} else {
				echo inspiro_time_link();
				inspiro_edit_link();
			};
			echo '</div><!-- .entry-meta -->';
		}
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				/* translators: %s: Post title. */
				__( 'Read more<span class="screen-reader-text"> "%s"</span>', 'inspiro' ),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'inspiro' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php
	if ( is_single() ) {
		inspiro_entry_footer();
	}
	?>

</article><!-- #post-<?php the_ID(); ?> -->
