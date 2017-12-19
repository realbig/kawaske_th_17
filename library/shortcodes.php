<?php
/**
 * Shortcodes.
 *
 * @since {{VERSION}}
 */

defined( 'ABSPATH' ) || die();

require_once( 'shortcodes/accordion.php' );

add_action( 'init', 'kwaske_shortcodes' );

/**
 * Adds shortcodes.
 *
 * @since {{VERSION}}
 * @access private
 */
function kwaske_shortcodes() {

	add_shortcode( 'accordion', 'kwaske_sc_accordion' );
}