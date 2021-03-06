<?php
/**
 * Displays footer site info
 *
 * @package Inspiro
 * @subpackage Inspiro_Lite
 * @since Inspiro Lite 1.0.0
 * @version x.x.x
 */

?>
<div class="site-info">
	<?php
	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
	}
	?>
	<span class="copyright">
		<span>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'inspiro' ) ); ?>" target="_blank">
				<?php printf( __( 'Powered by %s', 'inspiro' ), 'WordPress' ); ?>
			</a>
		</span>
		<span>
			<?php echo esc_html__( 'Inspiro WordPress Theme by', 'inspiro' ); ?> <a href="<?php echo esc_url( 'https://www.wpzoom.com/' ) ?>" target="_blank" rel="nofollow">WPZOOM</a>
		</span>
	</span>
</div><!-- .site-info -->
