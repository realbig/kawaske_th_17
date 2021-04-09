<?php
/**
 * Add a TinyMCE button to create [form_overlay] Shortcodes
 *
 * @since   1.0.0
 * @package kwaske_th_17
 * @subpackage  kwaske_th_17/admin/tinymce
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Add Button Shortcode to TinyMCE
 *
 * @since       1.0.0
 * @return      void
 */
add_action( 'admin_init', 'add_kwaske_form_overlay_tinymce_filters' );
function add_kwaske_form_overlay_tinymce_filters() {
    
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
        
        add_filter( 'mce_buttons', function( $buttons ) {
            array_push( $buttons, 'form_overlay_shortcode' );
            return $buttons;
        } );
        
        // Attach script to the button rather than enqueueing it
        add_filter( 'mce_external_plugins', function( $plugin_array ) {
            $plugin_array['form_overlay_shortcode_script'] = get_stylesheet_directory_uri() . '/dist/assets/js/tinymce/form-overlay-shortcode.js';
            return $plugin_array;
        } );
        
    }
    
}

/**
 * Add Localized Text for our TinyMCE Button
 *
 * @since       1.0.0
 * @return      Array Localized Text
 */
add_filter( 'kwaske_tinymce_l10n', 'kwaske_form_overlay_tinymce_l10n' );
function kwaske_form_overlay_tinymce_l10n( $l10n ) {

    $ninja_forms = array();

    if ( class_exists( 'Ninja_Forms' ) ) {

        $forms = Ninja_Forms()->form()->get_forms();

		/** @var NF_Database_Models_Form $form */
		foreach ( $forms as $form ) {
			$ninja_forms[ $form->get_id() ] = $form->get_setting( 'title' );
		}
        
    }
    
    $l10n['form_overlay_shortcode'] = array(
        'tinymce_title' => _x( 'Add Form Overlay', 'Form Overlay Shortcode TinyMCE Button Text', 'kwaske_th_17' ),
		'form_id' => array(
			'label' => _x( 'Ninja Form', 'Form to use in Overlay Label', 'kwaske_th_17' ),
			'choices' => $ninja_forms,
		),
        'button_text' => array(
            'label' => _x( 'Button Text', "Button's Text", 'kwaske_th_17' ),
        ),
        'colors' => array(
            'label' => _x( 'Button Color', 'Button Color Selection Label', 'kwaske_th_17' ),
            'default' => 'primary',
            'choices' => array(
                'primary' => _x( 'Blue', 'Primary Theme Color', 'kwaske_th_17' ),
                'secondary' => _x( 'Orange', 'Secondary Theme Color', 'kwaske_th_17' ),
            ),
        ),
        'size' => array(
            'label' => _x( 'Button Size', 'Button Size Selection Lable', 'kwaske_th_17' ),
            'default' => '',
            'choices' => array(
				'' => _x( 'Default', 'Default Button Size', 'kwaske_th_17' ),
                'tiny' => _x( 'Tiny', 'Tiny Button Size', 'kwaske_th_17' ),
                'small' => _x( 'Small', 'Small Button Size', 'kwaske_th_17' ),
                'medium' => _x( 'Medium', 'Medium Button Size', 'kwaske_th_17' ),
                'large' => _x( 'Large', 'Large Button Size', 'kwaske_th_17' ),
            ),
        ),
        'hollow' => array(
            'label' => _x( 'Hollow/"Ghost" Button?', 'Hollow Button Style', 'kwaske_th_17' ),
        ),
        'expand' => array(
            'label' => _x( 'Full Width Button?', 'Full Width Button', 'kwaske_th_17' ),
        ),
    );
    
    return $l10n;
    
}