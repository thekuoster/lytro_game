<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Brightpage
 */

get_header(); ?>
	
	<!-- BEGIN INTRO -->
	<div id="intro">
		<p class="big">
			<?php printf( __( 'Search Results for: %s', 'brightpage' ), '<span>' . get_search_query() . '</span>' ); ?>
		</p>
	</div> <!-- end div #intro -->
	<!-- END INTRO -->
		
		<!-- BEGIN PAGE -->
		<div id="page" class="clearfix full">

			<div id="content" class="grid_1 first">
				<div class="in30">
					<?php if (have_posts()) : ?>
					
						<?php get_template_part( 'post-excerpt' ); // Post Excerpt (post-excerpt.php) ?>
						<?php get_template_part( 'pagenav' ); // Page Navigation (pagenav.php) ?>

					<?php else : ?>
						<div class="post">
							<div id="post-title" class="clearfix full">
								<h2><?php _e('404 Error&#58; Not Found', 'brightpage'); ?></h2>			
							</div> <!-- end div #post-title -->
							
							<div class="entry">
								<p><?php _e('Sorry, but the page you are trying to reach is unavailable or does not exist.', 'brightpage'); ?></p>			
							</div> <!-- end div .entry -->
						</div>
					<?php endif; ?>
			      										
				</div> <!-- end div .in30 -->
			</div> <!-- end div #content -->
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>
