<?php
/**
 * Adds extra meta to home page.
 *
 * @since {{VERSION}}
 */

defined( 'ABSPATH' ) || die();

add_action( 'add_meta_boxes', 'kwaske_add_mb_home' );

/**
 * Adds meta boxes for products.
 *
 * @since {{VERSION}}
 * @access private
 */
function kwaske_add_mb_home() {

	if ( kwaske_field_helpers() === false ) {
		return;
	}

	if ( get_the_ID() !== (int) get_option( 'page_on_front' ) ) {
		return;
	}

	add_filter( 'rbm_fieldhelpers_load_select2', '__return_true' );
	wp_enqueue_editor();

	add_meta_box(
		'kwaske-home-hero',
		'Hero Section',
		'kwaske_mb_home_hero',
		'page'
	);

	add_meta_box(
		'kwaske-home-about',
		'About Section',
		'kwaske_mb_home_about',
		'page'
	);

	add_meta_box(
		'kwaske-home-services',
		'Services Section',
		'kwaske_mb_home_services',
		'page'
	);

	add_meta_box(
		'kwaske-home-request-quote',
		'Request a Quote Section',
		'kwaske_mb_home_request_quote',
		'page'
	);
}

/**
 * Outputs the meta box for home page hero settings.
 *
 * @since {{VERSION}}
 * @access private
 */
function kwaske_mb_home_hero() {

	kwaske_field_helpers()->fields->do_field_text( 'hero_heading', array(
		'group'       => 'home_hero',
		'label'       => 'Hero Heading',
		'input_class' => 'regular-text',
	) );

	kwaske_field_helpers()->fields->do_field_text( 'hero_subheading', array(
		'group'       => 'home_hero',
		'label'       => 'Hero Sub-Heading',
		'input_class' => 'widefat',
	) );

	kwaske_field_helpers()->fields->do_field_text( 'hero_button_text', array(
		'group'       => 'home_hero',
		'label'       => 'Hero Button Text',
		'input_class' => 'regular-text',
	) );

	$pages = get_posts( array(
		'post_type'   => 'page',
		'numberposts' => - 1,
	) );

	$options = array();
	foreach ( $pages as $page ) {

		$options[] = array(
			'value' => $page->ID,
			'text'  => $page->post_title,
		);
	}

	kwaske_field_helpers()->fields->do_field_select( 'hero_button_link', array(
		'group'       => 'home_hero',
		'label'       => 'Hero Button Link Page',
		'options'     => $options,
		'placeholder' => 'Select a Page',
		'option_none' => 'Select a Page',
	) );

	kwaske_field_helpers()->fields->save->initialize_fields( 'home_hero' );
}

/**
 * Outputs the meta box for home page about settings.
 *
 * @since {{VERSION}}
 * @access private
 */
function kwaske_mb_home_about() {

	kwaske_field_helpers()->fields->do_field_text( 'home_youtube_url', array(
		'group'       => 'home_about',
		'label'       => 'About Section YouTube URL',
		'input_class' => 'regular-text',
	) );

	kwaske_field_helpers()->fields->save->initialize_fields( 'home_about' );
}

/**
 * Outputs the meta box for home page services settings.
 *
 * @since {{VERSION}}
 * @access private
 */
function kwaske_mb_home_services() {

	kwaske_field_helpers()->fields->do_field_number( 'home_services_count', array(
		'group' => 'home_services',
		'label' => 'Max number of Services to show.',
		'min'   => 2,
		'max'   => 12,
	) );

	kwaske_field_helpers()->fields->save->initialize_fields( 'home_services' );
}


/**
 * Outputs the meta box for home page request quote settings.
 *
 * @since {{VERSION}}
 * @access private
 */
function kwaske_mb_home_request_quote() {

	kwaske_field_helpers()->fields->do_field_textarea( 'home_request_quote_content', array(
		'group'   => 'home_request_quote',
		'label'   => 'Content',
		'wysiwyg' => true,
	) );

	if ( function_exists( 'Ninja_Forms' ) ) {

		$forms = Ninja_Forms()->form()->get_forms();

		$options = array();
		/** @var NF_Database_Models_Form $form */
		foreach ( $forms as $form ) {

			$options[] = array(
				'value' => $form->get_id(),
				'text'  => $form->get_setting( 'title' ),
			);
		}

		kwaske_field_helpers()->fields->do_field_select( 'home_request_quote_form', array(
			'group'       => 'home_request_quote',
			'label'       => 'Request a Quote Form',
			'options'     => $options,
			'placeholder' => 'Select a Form',
			'option_none' => 'Select a Form',
		) );
	}

	kwaske_field_helpers()->fields->save->initialize_fields( 'home_request_quote' );
}