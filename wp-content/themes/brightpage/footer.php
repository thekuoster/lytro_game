<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=page div and all content after
 *
 * @package WordPress
 * @subpackage Brightpage
 */
?>

	</div> <!-- end div #page -->
	<!-- END PAGE -->

	<?php get_template_part( 'bottom-menu' ); // 3-Column Bottom Menu (bottom-menu.php) ?>

	<!-- BEGIN FOOTER -->
	<div id="footer" class="clearfix">
		
		<div id="footer-left" class="grid_02 first">
			<p><a href="http://wordpress.org/"><?php _e('Proudly powered by WordPress', 'brightpage'); ?></a> | <?php _e('Theme design by', 'brightpage'); ?> <a href="http://www.templatepanic.com/">TemplatePanic.com</a></p>
		</div> <!-- end div #footer-left -->

		<div id="footer-right" class="grid_02 last">
			<p>&copy; <?php echo date('Y');?> <a href="<?php echo home_url(''); ?>/" title="<?php bloginfo('name');?>" ><?php bloginfo('name');?></a></p>
		</div> <!-- end div #footer-right -->
			
	</div> <!-- end div #footer -->
	<!-- END FOOTER -->
		
</div> <!-- end wrapper w_960 -->
	
<?php wp_footer(); ?>

</body>
</html>