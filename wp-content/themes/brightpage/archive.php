<?php
/**
 * The template for displaying Archive pages.
 *
 * @package WordPress
 * @subpackage Brightpage
 */

get_header(); ?>
	
	<!-- BEGIN INTRO -->
	<div id="intro">
		<p class="big-left">
			<?php if (have_posts()) : ?>
				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
					<?php /* If this is a category archive */ if (is_category()) { ?>
						<?php _e('Archive for the', 'brightpage'); ?> '<?php echo single_cat_title(); ?>' <?php _e('Category', 'brightpage'); ?>									
					<?php /* If this is a tag archive */  } elseif( is_tag() ) { ?>
						<?php _e('Archive for the', 'brightpage'); ?> <?php single_tag_title(); ?> Tag
					<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
						<?php _e('Archive for', 'brightpage'); ?> <?php the_time('F jS, Y'); ?>										
				 	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
						<?php _e('Archive for', 'brightpage'); ?> <?php the_time('F, Y'); ?>									
					<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
						<?php _e('Archive for', 'brightpage'); ?> <?php the_time('Y'); ?>										
				  	<?php /* If this is a search */ } elseif (is_search()) { ?>
						<?php _e('Search Results', 'brightpage'); ?>							
				  	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
						<?php _e('Author Archive', 'brightpage'); ?>										
					<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
						<?php _e('Blog Archives', 'brightpage'); ?>										
			<?php } ?>					
		</p>
	</div> <!-- end div #intro -->
	<!-- END INTRO -->
		
		<!-- BEGIN PAGE -->
		<div id="page" class="clearfix full">
			
			<div id="content" class="grid_1 first">
				<div class="in30">
					
						<?php get_template_part( 'post-excerpt' ); // Post Excerpt (post-excerpt.php) ?>
						<?php get_template_part( 'pagenav' ); // Page Navigation (pagenav.php) ?>

					<?php else : ?>
						<div class="post">
							<h3><?php _e('404 Error&#58; Not Found', 'Brightpage'); ?></h3>
						</div>
					<?php endif; ?>
			      										
				</div> <!-- end div .in30 -->
			</div> <!-- end div #content -->
			
<?php get_sidebar(); ?>
<?php get_footer(); ?>
