<?php
/**
 * Gallery modifications.
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || die();

add_filter( 'post_gallery', 'kwaske_gallery_html', 20, 3 );
add_action( 'wp_footer', 'kwaske_gallery_modals_output' );

/**
 * Modifies the HTML output for WordPress galleries.
 *
 * @since 1.0.0
 * @access private
 *
 * @param string $output The gallery output. Default empty.
 * @param array $attr Attributes of the gallery shortcode.
 * @param int $instance Unique numeric ID of this gallery shortcode instance.
 */
function kwaske_gallery_html( $output, $attr, $instance ) {

	global $kwaske_galleries;

	if ( $kwaske_galleries === null ) {

		$kwaske_galleries = array();
	}

	$post = get_post();

	$orderby = isset( $attr['orderby'] ) && $attr['orderby'] !== '' ? $attr['orderby'] : 'menu_order ID';

	$gallery = wp_parse_args( $attr, array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'include'    => '',
		'exclude'    => '',
	) );

	$gallery['instance'] = $instance;

	$kwaske_galleries[] = $gallery;

	return '';
}

/**
 * Outputs modals for any galleries.
 *
 * @since 1.0.0
 * @access private
 */
function kwaske_gallery_modals_output() {

	global $kwaske_galleries;

	if ( $kwaske_galleries === null ) {

		return;
	}

	foreach ( $kwaske_galleries as $kwaske_gallery ) : ?>
		<?php
        // This is taken from the shortcode, this way IDs will be exactly matched up with the actual gallery.
		$id = intval( $kwaske_gallery['id'] );

		if ( ! empty( $kwaske_gallery['include'] ) ) {
			$_attachments = get_posts( array( 'include' => $kwaske_gallery['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $kwaske_gallery['order'], 'orderby' => $kwaske_gallery['orderby'] ) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( ! empty( $kwaske_gallery['exclude'] ) ) {
			$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $kwaske_gallery['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $kwaske_gallery['order'], 'orderby' => $kwaske_gallery['orderby'] ) );
		} else {
			$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $kwaske_gallery['order'], 'orderby' => $kwaske_gallery['orderby'] ) );
		}
		?>
        <div class="reveal large kwaske-gallery-modal" id="kwaske-gallery-modal-<?php echo $kwaske_gallery['instance']; ?>" data-reveal
        data-images="<?php echo htmlentities(json_encode( wp_list_pluck( $attachments, 'ID', true ) ) ); ?>">
            <div class="kwaske-gallery-modal-image-container"></div>
            <div class="kwaske-gallery-modal-loading">
                <span class="fa fa-spinner fa-spin"></span>
            </div>
            <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
	<?php endforeach;
}