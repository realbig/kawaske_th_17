<?php
/**
 * Shortcode: Accordion
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || die();

add_shortcode( 'accordion', 'kwaske_sc_accordion' );
add_shortcode( 'accordion_item', 'kwaske_sc_accordion_item' );

/**
 * Shortcode: Accordion
 *
 * @since 1.0.0
 */
function kwaske_sc_accordion( $atts = array(), $content = '' ) {

	return '<ul class="accordion" data-accordion>' . do_shortcode( $content ) . '</ul>';
}

/**
 * Shortcode: Accordion Item
 *
 * @since 1.0.0
 */
function kwaske_sc_accordion_item( $atts = array(), $content = '' ) {

	$atts = shortcode_atts( array(
		'title' => false,
	), $atts, 'accordion' );

	if ( ! $atts['title']) {

		return '';
	}

	return "<li class=\"accordion-item\" data-accordion-item><a href=\"#\" class=\"accordion-title\">{$atts['title']}</a><div class=\"accordion-content\" data-tab-content>" . wpautop( $content ) . "</div></li>";
}