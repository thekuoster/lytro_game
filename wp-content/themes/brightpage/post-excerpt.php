<?php
/**
 * The template for displaying post excerpts. 
 *
 * @package WordPress
 * @subpackage Brightpage
 */
?>

<?php if(have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>		
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	 	
		<?php the_post_thumbnail('post-image', array('class' => 'imgthumb')); ?>
				
		<div id="post-title-<?php the_ID(); ?>" class="clearfix full">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>			
		</div> <!-- end div .post-title -->
		
		<?php the_excerpt(); ?> 
		
		<?php get_template_part( 'postmeta' ); // Post Meta (postmeta.php) ?>
		
	</div> <!-- end div #post -->
<?php endwhile; ?>	
<?php endif; ?>
