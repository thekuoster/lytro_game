<?php
/**
 * The template for displaying page navigation (The Next and Previous post links) on index and archive pages. 
 * The Next and Previous post links guide your visitor through your WordPress site.
 *
 * Learn more: http://codex.wordpress.org/Next_and_Previous_Links
 *
 * @package WordPress
 * @subpackage Brightpage
 */
?>

<div id="pagenavi" class="clearfix">
	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
	
	<?php next_posts_link( __( '<span class="alignleft">&larr; Older posts</span>', 'brightpage' ) ); ?>
	<?php previous_posts_link( __( '<span class="alignright">Newer posts &rarr;</span>', 'brightpage' ) ); ?>

	<?php } ?>
</div> <!-- end div #pagenavi -->
