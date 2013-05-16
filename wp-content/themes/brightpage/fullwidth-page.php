<?php
/*
Template Name: Fullwidth Page
 *
 * To use this template, on the Add a Page, select Fullwidth Page from the Template drop-down menu.
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
			
			<div id="content" class="fullwidth">
				<div class="in30">
					<?php if(have_posts()) : ?><?php while(have_posts())  : the_post(); ?>
						<div class="post" id="post-<?php the_ID(); ?>">
															
							<div id="post-title" class="clearfix full">
								<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>			
							</div> <!-- end div .post-title -->
							
							<div class="entry clearfix">
							
								<?php the_content(); ?> 
								<div class="clearfix"></div>
								<div class="space"></div>
								<?php get_template_part( 'postmeta' ); // Post Meta (postmeta.php) ?>
								<?php wp_link_pages(); ?> 
								<!-- <?php trackback_rdf(); ?> -->
							
							</div> <!-- end div .entry -->
							
							<div class="comments">
								<?php comments_template(); ?>
							</div> <!-- end div .comments -->
								
						</div> <!-- end div .post -->

					<?php endwhile; ?>

					<?php else : ?>
						<div class="post">
							<h3><?php _e('404 Error&#58; Not Found', 'brightpage'); ?></h3>
						</div> <!-- end div .post -->
					<?php endif; ?>
			      										
				</div> <!-- end div .in30 -->
			</div> <!-- end div #content -->
			
<?php get_footer(); ?>
