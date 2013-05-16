<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Brightpage
 */

get_header(); ?>
	
	<!-- BEGIN INTRO -->
	<div id="intro">
		<p class="big"><?php _e('404 Error&#58; Not Found', 'brightpage'); ?></p>
	</div> <!-- end div #intro -->
	<!-- END INTRO -->
		
		<!-- BEGIN PAGE -->
		<div id="page" class="clearfix full">
			
			<div id="content" class="grid_1 first">
				<div class="in30">

						<div class="post">
															
							<div id="post-title" class="clearfix full">
								<h2><?php _e('404 Error&#58; Not Found', 'brightpage'); ?></h2>			
							</div> <!-- end div #post-title -->
							
							<div class="entry">
								<p><?php _e('404 Error&#58; Not Found', 'Sorry, but the page you are trying to reach is unavailable or does not exist.', 'brightpage'); ?></p>			
							</div> <!-- end div .entry -->
							
						</div> <!-- end div .post -->
			      										
				</div> <!-- end div .in30 -->
			</div> <!-- end div #content -->
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>
