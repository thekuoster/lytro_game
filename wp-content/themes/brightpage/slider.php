<?php
/**
 * The template for displaying slider on home page, up to 5 posts. 
 * To display the Featured Slider, add category name 'Featured' to your post. 
 * If there is no post in Featured category, the slider will not appear.
 * If you want another category to be shown in the slider, please edit the category_name=Featured below.
 *
 * @package WordPress
 * @subpackage Brightpage
 */
?>

<?php if(!is_paged()) { ?>
	<?php query_posts('category_name=Featured&showposts=5'); ?>
		
		<?php if (have_posts()) : ?>
     
			<!-- BEGIN SLIDER -->
			<div id="sliderbox" class="clearfix">
						
	            <div id="slider" class="nivoSlider">
					<?php while (have_posts()) : the_post(); ?>
				
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(( 'slider-image' ), array( 'title' => get_the_title() )); ?></a>
			
					<?php endwhile; ?>
	            </div>

			</div> <!-- end div #sliderbox -->
			<!-- END SLIDER -->

		<?php endif; ?>

	<?php wp_reset_query(); ?>
<?php } ?>

