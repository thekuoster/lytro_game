<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Brightpage
 */

get_header(); ?>
	
	<!-- BEGIN INTRO -->
	<div id="intro">
		<p class="small"><?php brightpage_the_breadcrumb(); ?></p>
	</div> <!-- end div #intro -->
	<!-- END INTRO -->
		
		<!-- BEGIN PAGE -->
		<div id="page" class="clearfix full">
			
			<div id="content" class="grid_1 first">
				<div class="in30">
					<?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>
						<div class="post" id="post-<?php the_ID(); ?>">
															
							<div id="post-title" class="clearfix full">
								<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>			
							</div> <!-- end div .post-title -->
							
							<div class="entry">
							
								<?php the_content(); ?> 
								
								<div class="space"></div>
								
								<?php get_template_part( 'postmeta' ); // Post Meta (postmeta.php) ?>
								<?php wp_link_pages(); ?> 
								<!-- <?php trackback_rdf(); ?> -->
							
							</div> <!-- end div .entry -->
							
							<?php comments_template( '', true ); ?>								
								
						</div> <!-- end div .post -->

					<?php endwhile; ?>

					<?php else : ?>
						<div class="post">
							<h3><?php _e('404 Error&#58; Not Found', 'brightpage'); ?></h3>
						</div>
					<?php endif; ?>
			      										
				</div> <!-- end div .in30 -->
			</div> <!-- end div #content -->
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>
