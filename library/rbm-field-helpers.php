<?php
/**
 * RBM Field Helpers
 */

defined( 'ABSPATH' ) || die();

/**
 * Gets the Napleon Bee Supply RBM Field Helpers instance.
 *
 * @since {{VERSION}}
 */
function kwaske_field_helpers() {

	if ( ! class_exists( 'RBM_FieldHelpers' ) ) {
		return false;
	}

	static $field_helpers;

	if ( $field_helpers === null ) {

		$field_helpers = new RBM_FieldHelpers( array(
			'ID' => 'kwaske',
		) );
	}

	return $field_helpers;
}

kwaske_field_helpers();

/**
 * Outputs a select field.
 *
 * @since {{VERSION}}
 *
 * @param array $args
 */
function kwaske_do_field_select( $args ) {

	kwaske_field_helpers()->fields->do_field_select(
		$args['name'],
		$args
	);
}