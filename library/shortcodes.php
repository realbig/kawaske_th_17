<?php
/**
 * Shortcodes.
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || die();

require_once( 'shortcodes/accordion.php' );

add_action( 'init', 'kwaske_shortcodes' );

/**
 * Adds shortcodes.
 *
 * @since 1.0.0
 * @access private
 */
function kwaske_shortcodes() {

	add_shortcode( 'accordion', 'kwaske_sc_accordion' );
}