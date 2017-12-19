<?php
/**
 * Services Settings page.
 *
 * @since {{VERSION}}
 */

defined( 'ABSPATH' ) || die();

add_action( 'admin_init', 'kwaske_services_settings_register' );
add_action( 'admin_menu', 'kwaske_services_add_menu_page' );
add_action( 'the_content', 'kwaske_output_services_archive' );

function kwaske_services_settings_register() {

	register_setting( 'kwaske_services_settings', 'kwaske_services_archive_page' );

	add_settings_section(
		'kwaske_services_settings',
		null,
		null,
		'kwaske_services_settings'
	);

	$pages = get_posts( array(
		'post_type'   => 'page',
		'numberposts' => - 1,
	) );

	$page_options = array();

	foreach ( $pages as $page ) {

		$page_options[] = array(
			'text'  => $page->post_title,
			'value' => $page->ID,
		);
	}

	add_settings_field(
		'kwaske_services_archive_page',
		'Services Page',
		'kwaske_do_field_select',
		'kwaske_services_settings',
		'kwaske_services_settings',
		array(
			'option_field' => true,
			'name'         => 'services_archive_page',
			'options'      => $page_options,
			'no_options'   => 'Select a Page',
			'placeholder'  => 'Select a Page',
		)
	);
}

/**
 * Adds the menu page for Services.
 *
 * @since {{VERSION}}
 * @access private
 */
function kwaske_services_add_menu_page() {

	$page = add_submenu_page(
		'edit.php?post_type=service',
		'Settings',
		'Settings',
		'manage_options',
		'kwaske-services-settings',
		'kwaske_services_settings_page'
	);

	add_action( "load-$page", 'kwaske_services_settings_page_actions' );
}

function kwaske_services_settings_page_actions() {

	add_filter( 'rbm_fieldhelpers_load_select2', '__return_true' );
}

/**
 * Services Settings page output.
 *
 * @since {{VERSION}}
 * @access private
 */
function kwaske_services_settings_page() {

	echo '<div class="wrap">';
	echo '<h2>Services Settings</h2>';
	echo '<form action="options.php" method="post">';
	settings_fields( 'kwaske_services_settings' );
	do_settings_sections( 'kwaske_services_settings' );
	submit_button();
	echo '</form>';
	echo '</div>';
}

function kwaske_output_services_archive( $content ) {

	global $wp_query;

	static $services_archive_page;

	if ( $services_archive_page === null ) {

		$services_archive_page = (int) get_option( 'kwaske_services_archive_page' );
	}

	if ( is_main_query() && $services_archive_page === get_the_ID() ) {

		$wp_query->query( array(
			'post_type'      => 'service',
			'posts_per_page' => -1,
		) );

		ob_start();
		get_template_part( 'template-parts/services-list' );
		$services_list = ob_get_clean();

		$wp_query->reset_postdata();
		$wp_query->posts = array();
		$wp_query->post_count = 0;

		return $content . $services_list;
	}

	return $content;
}