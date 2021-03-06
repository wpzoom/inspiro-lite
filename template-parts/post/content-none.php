<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Inspiro
 * @subpackage Inspiro_Lite
 * @since Inspiro Lite 1.0.0
 * @version x.x.x
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<div class="inner-wrap">
			<h1 class="page-title"><?php _e( 'Nothing Found', 'inspiro' ); ?></h1>
		</div>
	</header>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			?>

			<p>
			<?php
			/* translators: %s: Post editor URL. */
			printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'inspiro' ), esc_url( admin_url( 'post-new.php' ) ) );
			?>
			</p>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'inspiro' ); ?></p>
			<?php
				get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
