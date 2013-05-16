<?php
/**
 * The template for displaying Bottom Menu widget areas.
 *
 * @package WordPress
 * @subpackage Brightpage
 */
?>

<?php
	/* The bottom menu widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the bottom menu have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'bottom-menu-left'  )
		&& ! is_active_sidebar( 'bottom-menu-center' )
		&& ! is_active_sidebar( 'bottom-menu-right'  )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>

<!-- BEGIN BOTTOM-MENU -->
<div id="bottom-menu">
	<div class="in30 clearfix">
	
	<?php if ( is_active_sidebar( 'bottom-menu-left' ) ) : ?>
	<div id="bottom-menu-left" class="grid_03 first">
		<?php dynamic_sidebar( 'bottom-menu-left' ); ?>
	</div> <!-- end div #bottom-menu-left -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'bottom-menu-center' ) ) : ?>
	<div id="bottom-menu-center" class="grid_03">
		<?php dynamic_sidebar( 'bottom-menu-center' ); ?>
	</div> <!-- end div #bottom-menu-center -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'bottom-menu-right' ) ) : ?>
	<div id="bottom-menu-right" class="grid_03 last">
		<?php dynamic_sidebar( 'bottom-menu-right' ); ?>
	</div> <!-- end div #bottom-menu-right -->
	<?php endif; ?>

	</div> <!-- end div#in30 -->
</div> <!-- end div #bottom-menu -->

<div id="bottom-menu-bot" class="clearfix full"></div>
<!-- END BOTTOM-MENU -->


