<?php
/**
 * The Header for Brightpage theme.
 *
 * Displays all of the <head> section and everything up till end of top navigation
 *
 * @package WordPress
 * @subpackage Brightpage
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head>
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->

	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
	<link href='http://fonts.googleapis.com/css?family=Forum&amp;v2' rel='stylesheet' type='text/css' />
	
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<!--[if IE 6]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/DD_belatedPNG_0.0.8a-min.js"></script>
	<script>
		DD_belatedPNG.fix('*');
	</script>
	<![endif]-->
		
	<?php wp_get_archives('type=monthly&format=link&limit=12'); ?>
	<?php //comments_popup_script(); // off by default ?>
		
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
		
	<div class="wrapper grid_0">
		
		<!-- BEGIN HEADER -->
		<div id="header" class="clearfix">
			<div id="header-box" class="clearfix">
				<h1 id="site-title"><a href="<?php echo home_url(''); ?>/" title="<?php bloginfo('name'); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<div id="site-description"><p><?php bloginfo('description'); ?></p></div>
			</div> <!-- end div #header-box -->
		</div> <!-- end div #header -->
		<!-- END HEADER -->

		<!-- BEGIN TOP NAVIGATION -->		
		<div id="top-nav" class="clearfix">
			<div id="menu" class="grid_1 first">
				<?php
				if (function_exists('wp_nav_menu')) {
					wp_nav_menu(array('theme_location' => 'wpj-main-menu', 'menu_id' => 'dropmenu', 'fallback_cb' => 'wpj_default_menu'));
				}
				else {
					wpj_default_menu();
				}
				?>
			</div> <!-- end div #menu -->

			<div id="search" class="grid_2 last">
				<?php get_template_part( 'searchform' ); // Search Form (searchform.php) ?>
				<div class="icon-popup">
					<a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS', 'Brightpage'); ?>" id="rss-icon"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a> 
					<em><?php _e('Subscribe', 'Brightpage'); ?></em>
				</div> <!-- end div .icon-popup -->
					
			</div> <!-- end div #search -->
						
		</div> <!-- end div #top-nav -->
		<!-- END TOP NAVIGATION -->		
		