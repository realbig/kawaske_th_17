<?php
/**
 * Outputs a list of services.
 *
 * @since {{VERSION}}
 */

defined( 'ABSPATH' ) || die();
?>

<?php if ( have_posts() ) : ?>
    <ul class="services-list">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
            <li class="service-list-item">
                <div class="service-list-item-background"
					<?php kwaske_featured_interchange( get_post_thumbnail_id() ); ?>></div>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_title(); ?>
                </a>
            </li>
		<?php endwhile; ?>
    </ul>
<?php else: ?>
    <div class="services-list-none">
        <p>No Services</p>
    </div>
<?php endif; ?>