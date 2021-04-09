<?php
/**
 * Shortcode: Video With Form Overlay
 *
 * @since 1.0.1
 */

defined( 'ABSPATH' ) || die();

/**
 * Add Video With Form Overlay Shortcode
 *
 * @since       1.0.1
 * @return      HTML
 */
add_shortcode( 'video_with_form_overlay', 'kwaske_sc_video_with_form_overlay' );
function kwaske_sc_video_with_form_overlay( $atts, $content = '' ) {
    
    $atts = shortcode_atts(
        array( // a few default values
            'video_id' => false,
            'color' => 'primary',
            'size' => '',
            'hollow' => 'false',
            'expand' => 'false',
            'form_id' => 0,
        ),
        $atts,
        'video_with_form_overlay'
    );
    
    ob_start();
    
    if ( ! $atts['video_id'] ) {
        return __( 'A YouTube Video ID must be defined', 'kwaske_th_17' );
    }
	
	// Copy of Foundation's implementation, but in PHP
	// This should prevent collisions as they need to be unique
	// Math.round( Math.pow( 36, 7 ) - Math.random() * Math.pow( 36, 6 ) ).toString( 36 ).slice( 1 ) + '-reveal';
	$uuid = substr( base_convert( round( pow( 36, 7 ) - ( mt_rand() / mt_getrandmax() ) * pow( 36, 6 ) ), 10, 36 ), 1 ) . '-reveal';
	
    ?>

    <div class="video-with-form-overlay">

        <?php echo wp_oembed_get( 'https://www.youtube.com/watch?v=' . esc_attr( $atts['video_id'] ) ); ?>

        <div class="overlay">

            <div class="overlaid-items">
                <a data-open="<?php echo $uuid; ?>" class="<?php echo $atts['color'] . ' ' . $atts['size'] . ' button' . ( strtolower( $atts['hollow'] == 'true' ) ? ' hollow' : '' ) . ( strtolower( $atts['expand'] == 'true' ) ? ' expanded' : '' ); ?>">
                    <?php echo ( $content ) ? $content : __( 'Open Form', 'kwaske_th_17' ); ?>
                </a>
            </div>
            
        </div>

    </div>

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

/**
 * Make YouTube not show featured videos at the end and make it controllable via the JS API
 * 
 * @param string $return HTML
 * @param object $data Data Object returned from oEmbed provider
 * @param string $url URL String
 * 
 * @since 1.0.1
 * @return void
 */
add_filter( 'oembed_dataparse', function( $return, $data, $url ) {
    
    if ( $data->provider_name == 'YouTube' ) {
        $return = str_replace( '?feature=oembed"', '?feature=oembed&rel=0&enablejsapi=1" class="youtube-embed"', $return );
    }
    
    return $return;
    
}, 10, 3 );