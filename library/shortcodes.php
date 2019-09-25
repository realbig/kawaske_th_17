<?php
/**
 * Shortcodes.
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || die();

require_once( 'shortcodes/accordion.php' );
require_once( 'shortcodes/form-overlay.php' );
require_once( 'shortcodes/video-with-form-overlay.php' );

add_action( 'init', 'kwaske_shortcodes' );

/**
 * Adds shortcodes.
 *
 * @since 1.0.0
 * @access private
 */
function kwaske_shortcodes() {

	add_shortcode( 'accordion', 'kwaske_sc_accordion' );
	add_shortcode( 'form_overlay', 'kwaske_sc_form_overlay' );
	add_shortcode( 'video_with_form_overlay', 'kwaske_sc_video_with_form_overlay' );
}