<?php
/**
 * Entry meta information for posts
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

if ( ! function_exists( 'foundationpress_entry_meta' ) ) :
	function foundationpress_entry_meta() {
		echo '<div class="entry-meta">';
		/* translators: %1$s: current date, %2$s: current time */
		echo '<time class="updated" datetime="' . get_the_time( 'c' ) . '">' . sprintf( __( 'Posted on %1$s at %2$s.', 'kwaske_th_17' ), get_the_date(), get_the_time() ) . '</time>';
		echo '<p class="byline author">' . __( 'Written by', 'kwaske_th_17' ) . ' <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" rel="author" class="fn">' . get_the_author() . '</a></p>';
		echo '</div>';
	}
endif;
