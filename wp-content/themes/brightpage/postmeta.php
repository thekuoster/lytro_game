<?php
/**
 * The template for displaying post meta. 
 *
 * @package WordPress
 * @subpackage Brightpage
 */
?>

<div class="postmeta clearfix">

	<div class="meta_left">
		<?php _e('Posted by', 'brightpage'); ?> <?php the_author(); ?> <?php _e('on', 'brightpage'); ?> <?php the_time('M d, Y') ?><br />
		<?php the_category(', '); ?><?php if(function_exists("the_tags")) the_tags(' &bull; Tags: ', ', ', ''); ?> <?php if ( comments_open() ) : ?>&bull; <?php _e('Comment feed', 'brightpage'); ?> <?php post_comments_feed_link('RSS 2.0'); ?><?php endif; ?> - <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('Read this post', 'brightpage'); ?></a> <?php edit_post_link('Edit', ' &#124; ', ''); ?>
	</div>

	<?php if ( comments_open() ) : ?><div class="meta_right">&bull; <?php comments_popup_link('No Comment', '1 Comment', '% Comments'); ?></div><?php endif; ?>

</div> <!-- end div .postmeta -->