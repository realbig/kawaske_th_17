<?php
/**
 * Template Name: Front
 *
 * @global WP_Query $wp_query
 */
get_header();

$ID = get_the_ID();
?>

    <header class="front-hero" role="banner" <?php echo kwaske_get_featured_interchange( get_post_thumbnail_id() ); ?>>
        <div class="marketing">
            <div class="tagline">
                <h1><?php echo kwaske_field_helpers()->fields->get_field( 'hero_heading' ); ?></h1>
                <h4 class="subheader"><?php echo kwaske_field_helpers()->fields->get_field( 'hero_subheading' ); ?></h4>
                <a role="button" class="large button arrow-button"
                   href="<?php echo get_permalink( kwaske_field_helpers()->fields->get_field( 'hero_button_link' ) ); ?>">
					<?php echo kwaske_field_helpers()->fields->get_field( 'hero_button_text' ); ?>
                </a>
            </div>
        </div>

    </header>

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
    <section class="intro" role="main">
        <div class="fp-intro">

            <div <?php post_class() ?> id="post-<?php the_ID(); ?>">

                <h1 class="page-title">
					<?php the_title(); ?>
					<?php kwaske_banner_end(); ?>
                </h1>

				<?php do_action( 'foundationpress_page_before_entry_content' ); ?>

                <div class="intro-container">
                    <div class="entry-content">
						<?php the_content(); ?>
                    </div>

                    <div class="intro-video">
						<?php echo wp_oembed_get( kwaske_field_helpers()->fields->get_field( 'home_youtube_url' ) ); ?>
                    </div>
                </div>
            </div>

        </div>

    </section>
<?php endwhile; ?>
<?php do_action( 'foundationpress_after_content' ); ?>

<?php
// Get services
$service_count = kwaske_field_helpers()->fields->get_field( 'home_services_count' );

$wp_query->query( array(
	'post_type'      => 'service',
	'posts_per_page' => $service_count ? (int) $service_count : 12,
) );
?>

    <section class="services">
        <h2 class="banner-title">
            Services We Offer
			<?php kwaske_banner_end(); ?>
        </h2>

		<?php get_template_part( 'template-parts/services-list' ); ?>
    </section>

    <section class="request-quote">

        <h2 class="banner-title">
            Request a Quote
			<?php kwaske_banner_end(); ?>
        </h2>

        <div class="request-quote-container">
            <div class="request-quote-content">
				<?php echo wpautop( kwaske_field_helpers()->fields->get_field( 'home_request_quote_content', $ID ) ); ?>
            </div>

            <div class="request-quote-form">
				<?php
				$form = kwaske_field_helpers()->fields->get_field( 'home_request_quote_form', $ID );

				if ( $form ) {

					Ninja_Forms()->display( $form );
				}
				?>
            </div>
        </div>
    </section>

<?php get_footer();
