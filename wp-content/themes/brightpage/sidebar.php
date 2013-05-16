<?php
/**
 * The Sidebar containing the widget area.
 *
 * @package WordPress
 * @subpackage Brightpage
 */
?>

<div id="sidebar" class="grid_2 last">
	<div class="in25">
			
	<?php if ( ! dynamic_sidebar( 'sidebar-top' ) ) : ?>
	<?php endif; ?>
	
	<div id="sidebar-split" class="clearfix full">
		
		<div id="sidebar-left" class="grid_22 first">
			<?php if ( ! dynamic_sidebar( 'sidebar-left' ) ) : ?>
			<?php endif; ?>			
		</div> <!-- end div #sidebar-left -->

		<div id="sidebar-right" class="grid_22 last">
			<?php if ( ! dynamic_sidebar( 'sidebar-right' ) ) : ?>
			<?php endif; ?>		
		</div> <!-- end div #sidebar-right -->
		
	</div> <!-- end div #sidebar-split -->

	</div> <!-- end div .in25 -->
</div> <!-- end div #sidebar -->

<div id="sidebar-bot" class="grid_2 last"></div>
