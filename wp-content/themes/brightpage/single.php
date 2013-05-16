<?php
/**
 * The Template for displaying all single posts.
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
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
															
							<div id="post-title" class="clearfix full">
								<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>			
							</div> <!-- end div .post-title -->
							
							<div class="entry">
							
								<?php the_content(); ?> 
								
								<div class="space"></div>
					
								<?php get_template_part( 'postmeta' ); // Post Meta (postmeta.php) ?>

								<div id="nav-below" class="clearfix">
									<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'brightpage' ) . '</span> %title' ); ?></div>
									<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'brightpage' ) . '</span>' ); ?></div>
								</div><!-- #nav-below -->
									
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
