<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/**
 * Define Constants based on our Stylesheet Header. Update things only once!
 */
$theme_header = wp_get_theme();

define( 'THEME_VER', $theme_header->get( 'Version' ) );
define( 'THEME_URL', get_template_directory_uri() );
define( 'THEME_DIR', get_template_directory() );

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Format comments */
require_once( 'library/class-foundationpress-comments.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/class-foundationpress-top-bar-walker.php' );
require_once( 'library/class-foundationpress-mobile-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** RBM Field Helpers support */
require_once( 'library/rbm-field-helpers.php' );

/** Gallery support */
require_once( 'library/gallery.php' );

/** Admin functionality */
require_once( 'library/admin/admin.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/class-foundationpress-protocol-relative-theme-assets.php' );

/** Shortcodes */
require_once( 'library/shortcodes.php' );
require_once( 'library/admin/tinymce/localization.php' );
require_once( 'library/admin/tinymce/form-overlay.php' );
require_once( 'library/admin/tinymce/video-with-form-overlay.php' );

function kwaske_banner_end( $class_base = 'banner-end' ) {
	?>
    <span class="<?php echo esc_attr( $class_base ); ?>">
        <span class="<?php echo esc_attr( $class_base ); ?>-a"></span>
        <span class="<?php echo esc_attr( $class_base ); ?>-b"></span>
        <span class="<?php echo esc_attr( $class_base ); ?>-c"></span>
    </span>
	<?php
}

add_filter( 'the_content', 'kwaske_shortcode_p_fix', 10 );
function kwaske_shortcode_p_fix( $content ) {

    // array of custom shortcodes requiring the fix
	$block = join("|",array('accordion', 'accordion_item'));
	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
	return $rep;
}