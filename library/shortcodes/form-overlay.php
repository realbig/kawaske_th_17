<?php
/**
 * Shortcode: Form Overlay
 *
 * @since 1.0.1
 */

defined( 'ABSPATH' ) || die();

/**
 * Add Form Overlay Shortcode
 *
 * @since       1.0.1
 * @return      HTML
 */
add_shortcode( 'form_overlay', 'kwaske_sc_form_overlay' );
function kwaske_sc_form_overlay( $atts, $content = '' ) {
    
    $atts = shortcode_atts(
        array( // a few default values
            'color' => 'primary',
            'size' => '',
            'hollow' => 'false',
            'expand' => 'false',
            'form_id' => 0,
        ),
        $atts,
        'form_overlay'
    );
    
    ob_start();
	
	
	// Copy of Foundation's implementation, but in PHP
	// This should prevent collisions as they need to be unique
	// Math.round( Math.pow( 36, 7 ) - Math.random() * Math.pow( 36, 6 ) ).toString( 36 ).slice( 1 ) + '-reveal';
	$uuid = substr( base_convert( round( pow( 36, 7 ) - ( mt_rand() / mt_getrandmax() ) * pow( 36, 6 ) ), 10, 36 ), 1 ) . '-reveal';
	
    ?>

	<a data-open="<?php echo $uuid; ?>" class="<?php echo $atts['color'] . ' ' . $atts['size'] . ' button' . ( strtolower( $atts['hollow'] == 'true' ) ? ' hollow' : '' ) . ( strtolower( $atts['expand'] == 'true' ) ? ' expanded' : '' ); ?>">
		<?php echo ( $content ) ? $content : __( 'Open Form', 'kwaske_th_17' ); ?>
    </a>

    <div class="reveal" id="<?php echo $uuid; ?>" data-reveal>

        <?php if ( class_exists( 'Ninja_Forms' ) ) : ?>

            <h2><?php echo Ninja_Forms()->form( $atts['form_id'] )->get()->get_setting( 'title' ); ?></h2>

            <?php Ninja_Forms()->display( $atts['form_id'] ); ?>

        <?php endif; ?>

		<button class="close-button" data-close aria-label="<?php _e( 'Close modal', 'kwaske_th_17' ); ?>" type="button">
			<span aria-hidden="true">&times;</span>
		</button>

	</div>

    <?php
    
    $output = ob_get_contents();
    ob_end_clean();
    
    return html_entity_decode( do_shortcode( $output ) );
    
}