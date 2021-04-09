<?php
/**
 * Localize TinyMCE Plugins
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
 * wp_localize_script() doesn't work on non-enqueued scripts like TinyMCE Plugins
 * So we're going to fake it!
 *
 * @since       1.0.0
 * @return      void
 */
add_action( 'before_wp_tiny_mce', 'kwaske_localize_tinymce' );
function kwaske_localize_tinymce() {
    
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) :
    
        $object_name = apply_filters( 'kwaske_tinymce_l10n_object_name', 'kwaske_tinymce_l10n' );

        $l10n = apply_filters( 'kwaske_tinymce_l10n', array() );

        foreach ( $l10n as $key => $value ) {

            if ( ! is_scalar( $value ) )
                continue;

            $l10n[$key] = html_entity_decode( (string) $value, ENT_QUOTES, 'UTF-8' );

        }

        $script = "var $object_name = " . wp_json_encode( $l10n ) . ';';

        $script = "/* <![CDATA[ */\n" . $script . "\n/* ]]> */";

        ?>

        <script type="text/javascript"><?php echo $script; ?></script>

        <?php
    
    endif;

}