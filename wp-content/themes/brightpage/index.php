<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Brightpage
 */

get_header(); ?>

	<?php get_template_part( 'slider' ); // Slider (slider.php) ?>

	<?php if(!is_paged()) { ?>
		<?php if ( is_active_sidebar( 'welcome-message' ) ) : ?>
			<!-- BEGIN INTRO -->
			<div id="intro">	
				<?php dynamic_sidebar( 'welcome-message' ); ?>
			</div> <!-- end div #intro -->
			<!-- END INTRO -->
		<?php endif; ?>
	<?php } ?>
	
	<!-- BEGIN PAGE -->
	<div id="page" class="clearfix full">
		
		<div id="content" class="grid_1 first">
			<div class="in30">

				<?php get_template_part( 'post-excerpt' ); // Post Excerpt (post-excerpt.php) ?>
				<?php get_template_part( 'pagenav' ); // Page Navigation (pagenav.php) ?>

			</div> <!-- end div .in30 -->
		</div> <!-- end div #content -->
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>
