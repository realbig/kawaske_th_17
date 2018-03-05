<?php
/*
Template Name: Full Width
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div class="main-wrap full-width">
    <h1 class="entry-title banner-title">
		<?php the_title(); ?>
		<?php kwaske_banner_end(); ?>
    </h1>

	<main class="main-content">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'page' ); ?>
			<?php comments_template(); ?>
		<?php endwhile;?>
	</main>
</div>
<?php get_footer();
