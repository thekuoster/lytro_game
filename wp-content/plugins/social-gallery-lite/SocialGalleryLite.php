<?php
/*
Plugin Name: Social Gallery Lite
Plugin URI: http://www.socialgalleryplugin.com
Description: <a href="http://www.socialgalleryplugin.com">Social Gallery</a> is the ultimate Social Lightbox for WordPress. This is the Lite Version. <a href="http://www.socialgalleryplugin.com/upgrade-to-social-gallery-pro/">Upgrade Now</a>.
Version: 2.0
Author: StormGate
Author URI: http://www.stormgate.co.uk
License: GPL v2

WordPress Lightbox Plugin
Copyright (C) 20012-2013, StormGate Ltd. - http://www.stormgate.co.uk

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.


*/

#} Check's blog capacity to run Social Gallery
$socialGalleryProof = true;
#} PHP 5 
if (strtok(phpversion(),'.') < 5){
	$socialGalleryProof = false;
	add_action('admin_notices','sgpd7967');function sgpd7967(){echo '<div class="error">Social Gallery Cannot run without PHP5!</div>';}
} 

#} TOTAL on/off switch
if ($socialGalleryProof){

#} Hooks

    register_activation_hook(__FILE__,'sgp08b');
    register_deactivation_hook(__FILE__,'sgpeb11c');
    
  	add_action('init', 'sgpbb28d9');
    add_action('admin_menu', 'sgpac2'); 
    add_action('admin_head', 'sgp3222'); 
    add_action('wp_head', 'sgpa5c'); 
    
					

		global $socialGalleryLite_db_version;
	$socialGalleryLite_db_version 			= "2.0";
	$socialGalleryLite_version 				= "2.0 Lite";
	
		global $socialGalleryLite_urls;
	$socialGalleryLite_urls['home'] 		= "http://www.socialgalleryplugin.com";
	$socialGalleryLite_urls['support']		= "http://forum.socialgalleryplugin.com";
	$socialGalleryLite_urls['forum'] 		= "http://forum.socialgalleryplugin.com";
	$socialGalleryLite_urls['faq'] 			= "http://www.socialgalleryplugin.com/frequently-asked-questions/";
	$socialGalleryLite_urls['subscribe'] 	= "http://www.socialgalleryplugin.com/join-social-gallery-newsletter/";
	$socialGalleryLite_urls['docs'] 		= "http://socialgalleryplugin.com/documentation/lite/";
	$socialGalleryLite_urls['showcase']		= 'http://www.socialgalleryplugin.com/showcase/';
	$socialGalleryLite_urls['updateCheck']	= 'http://www.socialgalleryplugin.com/updateEngine/lite/';
	$socialGalleryLite_urls['regCheck']		= 'http://www.socialgalleryplugin.com/updateEngine/lite/registration/';
	$socialGalleryLite_urls['comCheck']		= 'http://www.socialgalleryplugin.com/updateEngine/lite/compat/';
	$socialGalleryLite_urls['newsFeed'] 	= 'http://www.socialgalleryplugin.com/feed/';
	$socialGalleryLite_urls['gopro'] 		= 'http://www.socialgalleryplugin.com/get-social-gallery-pro';
	$socialGalleryLite_urls['wporg'] 		= 'http://wordpress.org/extend/plugins/social-gallery-lite/'; 	
	
		global $socialGalleryLite_slugs;
	$socialGalleryLite_slugs['home'] 			= "sgp-plugin-config";
	$socialGalleryLite_slugs['settings'] 		= "sgp-plugin-settings";
	
	
		global $socialGalleryLite_acceptableThemes;
	$socialGalleryLite_acceptableThemes = array('classic');
	define( 'SOCIALGALLERYPLUGIN_PATH', plugin_dir_path(__FILE__) );
	define( 'SOCIALGALLERYPLUGIN_URL', plugin_dir_url(__FILE__) );
	
					

function sgp08b(){
	
	global $socialGalleryLite_version, $socialGalleryLite_db_version;				
		add_option("socialGalleryLite_db_version", 		$socialGalleryLite_db_version);
    add_option("socialGalleryLite_version",			$socialGalleryLite_version);
	add_option("socialGalleryLite_reg", 			"1");	
	
		add_option('socialGalleryLite_selectorType',			1);
    add_option('socialGalleryLite_selector',				'.socialGallery');
	add_option("socialGalleryLite_bgColor",					'000000');
	add_option("socialGalleryLite_bgOpacity", 				0.8);
	add_option("socialGalleryLite_bottomBar",				1);
	add_option("socialGalleryLite_headerBox", 				1);
	add_option("socialGalleryLite_headerBoxType", 			1);
	add_option("socialGalleryLite_headerBoxHTML", 			'');
    add_option('socialGalleryLite_headerImg',				plugins_url('/i/def.jpg',__FILE__));
	add_option("socialGalleryLite_incDesc", 				1);
	add_option("socialGalleryLite_incFB", 					1);
	add_option("socialGalleryLite_incFBComments", 			1);
	add_option("socialGalleryLite_incFBFaces",				1); 
	add_option("socialGalleryLite_backAndForth", 			1);
	add_option("socialGalleryLite_incFBSRC", 				1);
	add_option("socialGalleryLite_incHomeCall", 			1);
	add_option('socialGalleryLite_autoDisableNextGen',		1);
	
		add_option('socialGalleryLite_upscaleFactor',	 		1.2);
	add_option('socialGalleryLite_marginBounds',	 		0.1);
	add_option('socialGalleryLite_hiddenMsgs',				array());
	add_option('socialGalleryLite_LastComCheck',			0);
	add_option('socialGalleryLite_wizardStage', 			0);
	add_option('socialGalleryLite_wizardObject', 			array());
	

	
}


function sgpeb11c(){
	
	    delete_option("socialGalleryLite_db_version");
    delete_option("socialGalleryLite_version"); 
    delete_option("socialGalleryLite_reg");	
	
}

function sgpac9(){}				
function sgpbb28d9(){
  
	global $socialGalleryLite_slugs; 	
		wp_enqueue_script("jquery");
	
		wp_enqueue_style('socialGalleryPluginLiteCSS', plugins_url('/css/socialGalleryPluginLite.css',__FILE__) );
	
		if (is_admin() && sgp061d431()) {
		
				wp_enqueue_style('socialGalleryPluginLiteCSSADM', plugins_url('/css/socialGalleryPluginLiteAdmin.css',__FILE__) );
		
				wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('socialGalleryPluginLiteJSADM', plugins_url('/js/socialGalleryPluginLiteAdmin.js',__FILE__), array('jquery','media-upload','thickbox') );
		wp_enqueue_script('socialGalleryPluginLiteJSADM');
		wp_enqueue_style('thickbox');
	}	

}

function sgpac2() {

	global $socialGalleryLite_slugs; 	
	add_menu_page( 'Social Gallery', 'Social Gallery', 'manage_options', $socialGalleryLite_slugs['home'], 'sgpc1a', plugins_url('i/icon.png',__FILE__));
    add_submenu_page( $socialGalleryLite_slugs['home'], 'Settings', 'Settings', 'manage_options', $socialGalleryLite_slugs['settings'], 'sgp010f9' );
}

function sgp3222() {
    
		echo '<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
	
		echo "<div id=\"fb-root\"></div><script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = \"//connect.facebook.net/en_GB/all.js#xfbml=1&appId=386163348104417\"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>";

		echo '<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>';
	
}

function sgpa5c() {
    
		
	$sgConfig = array();
    $sgConfig['selectorType'] = 			get_option('socialGalleryLite_selectorType');			    $sgConfig['selector'] = 				get_option('socialGalleryLite_selector');				    $sgConfig['bgColor'] = 					get_option('socialGalleryLite_bgColor');				    $sgConfig['bgOpacity'] = 				get_option('socialGalleryLite_bgOpacity');				    $sgConfig['bottomBar'] = 				get_option('socialGalleryLite_bottomBar');				    $sgConfig['headerBox'] = 				get_option('socialGalleryLite_headerBox');				    $sgConfig['headerBoxType'] = 			get_option('socialGalleryLite_headerBoxType');			    $sgConfig['headerBoxHTML'] = 			get_option('socialGalleryLite_headerBoxHTML');			    $sgConfig['headerImg'] = 				get_option('socialGalleryLite_headerImg');				    $sgConfig['incDesc'] = 					get_option('socialGalleryLite_incDesc');				    $sgConfig['incFB'] = 					get_option('socialGalleryLite_incFB');					    $sgConfig['incFBFaces'] = 				get_option('socialGalleryLite_incFBFaces');				    $sgConfig['incFBComments'] = 			get_option('socialGalleryLite_incFBComments');			    $sgConfig['incFBCommentAppID'] = 		get_option('socialGalleryLite_incFBAppID');				    $sgConfig['backAndForth'] = 			get_option('socialGalleryLite_backAndForth');			    $sgConfig['incFBSRC'] = 				get_option('socialGalleryLite_incFBSRC');				    $sgConfig['incHomeCall'] = 				get_option('socialGalleryLite_incHomeCall');				$sgConfig['autoDisableNextGen'] = 		get_option('socialGalleryLite_autoDisableNextGen');			$sgConfig['upscaleFactor'] = 			get_option('socialGalleryLite_upscaleFactor');				$sgConfig['marginBounds'] = 			get_option('socialGalleryLite_marginBounds');			
	$marginBounds = 10;	if ((float)$sgConfig['marginBounds'] > 0) { $marginBounds = (float)$sgConfig['marginBounds']*100; if ($marginBounds > 50) $marginBounds = 50; }	$theme = 'classic';
	
	if (empty($sgConfig['incFBAppID'])) $fbAppID = '386163348104417'; else $fbAppID = $sgConfig['incFBAppID']; 	
	if ($sgConfig['incFBSRC'] == 1)
		echo "<div id=\"fb-root\"></div><script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = \"//connect.facebook.net/en_GB/all.js#xfbml=1&appId=".$fbAppID."\"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>";
				
		echo '<script type="text/javascript">var sgp_config = {"sgp_selT": "'.$sgConfig['selectorType'].'","sgp_sel": "'.$sgConfig['selector'].'","sgp_bT": "'.get_bloginfo('name').'","sgp_bL": "'.get_bloginfo('description').'","sgp_bU": "'.get_bloginfo('wpurl').'","sgp_bg": "'.$sgConfig['bgColor'].'","sgp_bgo": "'.$sgConfig['bgOpacity'].'","sgp_bb": "'.$sgConfig['bottomBar'].'","sgp_hb": "'.$sgConfig['headerBox'].'","sgp_hbt": "'.$sgConfig['headerBoxType'].'","sgp_ch": "'.$sgConfig['headerBoxHTML'].'","sgp_hbi": "'.$sgConfig['headerImg'].'","sgp_desc": "'.$sgConfig['incDesc'].'","sgp_fb": "'.$sgConfig['incFB'].'","sgp_fbf": "'.$sgConfig['incFBFaces'].'","sgp_fbc": "'.$sgConfig['incFBComments'].'","sgp_nav": "'.$sgConfig['backAndForth'].'","sgp_hon": "'.$sgConfig['incHomeCall'].'","sgp_usf":"'.$sgConfig['upscaleFactor'].'","sgp_mb":"'.$marginBounds.'","sgp_theme":"'.$theme.'","sgp_theme_root":"'.SOCIALGALLERYPLUGIN_URL.'themes/","sgp_iLoadR": "'.plugins_url('/i/loading.gif',__FILE__).'","sgp_iR": "'.plugins_url('/i/r.png',__FILE__).'","sgp_iL": "'.plugins_url('/i/l.png',__FILE__).'",};</script><script type="text/javascript" src="'.plugins_url('/js/socialGalleryPluginLite.js',__FILE__).'"></script>'; 

   
    	echo '<script type="text/javascript">var sgp_ie = false;var sgp_ie7 = false;</script><!--[if IE]><script type="text/javascript">var sgp_ie = true;</script><![endif]--><!--[if lte IE 7]><script type="text/javascript">var sgp_ie7 = true;</script><![endif]-->';
	
		echo "<link rel='stylesheet' id='sgcustomthemecss'  href='".plugins_url("/themes/".$theme."/".$theme.".css",__FILE__)."' type='text/css' media='all' />";
	
}

add_action('admin_notices','sgp816ddd');
function sgp816ddd(){

	if (is_admin()){
		
		global $socialGalleryLite_slugs;
				$stage = 0;$wizardObj = get_option('socialGalleryLite_wizardObject');
		if (is_array($wizardObj))
			if (isset($wizardObj['stage'])) 
				 $stage = (int)$wizardObj['stage'];	
		
		if ($stage == 0 && !sgp061d431()) echo '<div class="updated"><p>Welcome to Social Gallery Lite! Please <a href="admin.php?page='.$socialGalleryLite_slugs['home'].'">Click Here</a> to finish the installation.</p></div>';
			
				if (isset($_GET['hidemsg'])){
		
			$msgtohide = (int)$_GET['hidemsg'];
			$existingHidden = get_option('socialGalleryLite_hiddenMsgs'); if (!is_array($existingHidden)) $existingHidden = array();
			$existingHidden[] = $msgtohide;
			update_option('socialGalleryLite_hiddenMsgs',$existingHidden);		
			
			global $socialGalleryMessagehidden; $socialGalleryMessagehidden = true;
			
		}	
		
				sgpa2e();	
	
	}
}

function sgp43542c(){
	
	global $socialGalleryLite_version;
	
	$thisVer = get_option('socialGalleryLite_version');
	if (empty($thisVer)) $thisVer = "2.0 Lite";
	
		
}

function sgp7aed(){

		if ((int)get_option('socialGalleryLite_autoDisableNextGen') == 1 && in_array(get_option('socialGalleryLite_selectorType'),array("6","7","8","9"))){
		
								sgp71d262f(); 
    			sgp96bf(0,"Successfully disabled NextGen Effects");
		
		
	}	
	
}
function sgp11f(){}					function sgpc317e4f(){
	
	global $socialGalleryLite_slugs,$socialGalleryLite_version,$socialGalleryLite_urls;
	
		$wizardObj = get_option('socialGalleryLite_wizardObject'); if (!is_array($wizardObj)) $wizardObj = array();
	
		$stage = 0; 
	if (isset($wizardObj['stage'])) {
		 $stage = $wizardObj['stage'];
	}
	if (isset($_POST['stage'])) {
		$stage = (int)$_POST['stage'];
	}
		
		if ($stage > 4 || $stage < 0) $stage = 0;
		
		switch ($stage){
		
		case 1: 	
		
						$userEmail = ''; $userName = ''; $subscribeflag = '';
			if (isset($_POST['name'])) { $userName = sanitize_text_field($_POST['name']); $wizardObj['userName'] = $userName; }
			if (isset($_POST['email'])) { $userEmail = sanitize_text_field($_POST['email']); $wizardObj['userEmail'] = $userEmail; }
			if (isset($_POST['updateme'])) { $subscribeflag = sanitize_text_field($_POST['updateme']); $wizardObj['subscribeflag'] = $subscribeflag; }
			
						$p = wp_count_posts(); $p = (int)$p->publish; $pa = wp_count_posts('page'); $pa = (int)$pa->publish; $n = 0; if (class_exists('nggdb')) $n = 1; $j = 0; if (class_exists('JustifiedImageGrid')) $j = 1;
			sgp33da($userEmail,$userName,$subscribeflag,$p,$pa,$n,$j);
						
			$wizardObj['stage'] = 1;			
			update_option('socialGalleryLite_wizardObject',$wizardObj);
			
						sgp71d262f(); 
			
			break;
		case 2:
		
						$postedSelectorType = ''; $postedSelector = '';
			if (isset($_POST['socialGalleryLite_selectorType'])) $postedSelectorType = (int)$_POST['socialGalleryLite_selectorType'];
			if (isset($_POST['socialGalleryLite_selector'])) $postedSelector = sanitize_text_field($_POST['socialGalleryLite_selector']);
	
				
						update_option('socialGalleryLite_selectorType',$postedSelectorType);
			update_option('socialGalleryLite_selector',$postedSelector);	
			
			$wizardObj['stage'] = 2;			
			update_option('socialGalleryLite_wizardObject',$wizardObj);
			break;
			
		default:
						break;
	}
	
?>
<!--[if gte IE 9]><style type="text/css">.gradient {filter: none;}</style><![endif]-->
<div id="sgpBody">
    <div class="wrap"> 
	    <div id="icon-sg" class="icon32"><br /></div><h2>Social Gallery Plugin</h2> 
    	<div id="sgpSocial">
            <a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.socialgalleryplugin.com&media=http%3A%2F%2Fwww.socialgalleryplugin.com%2FsocialGallery.png&description=I%20use%20the%20Social%20Gallery%20Plugin%20for%20Wordpress%2C%20its%20awesome!%20http%3A%2F%2Fwww.socialgalleryplugin.com" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
            <a href="https://twitter.com/share" class="twitter-share-button" data-via="SocialGalleryWP" data-url="http://codecanyon.net/item/social-gallery-wordpress-photo-viewer-plugin/2665332?ref=stormgate">Tweet</a>
            <a href="<?php echo $socialGalleryLite_urls['showcase']; ?>" title="Showcase your Social Gallery" target="_blank" id="showcase">Showcase your Social Gallery</a>
            <div class="fb-like" data-href="http://codecanyon.net/item/social-gallery-wordpress-photo-viewer-plugin/2665332" data-send="true" data-width="400" data-show-faces="false"></div>
        </div>
    </div>
    <h3>Welcome to Social Gallery!</h3>
    <p>You've successfully installed Social Gallery, now to get it working on your blog please follow this wizard.</p>
	<form method="post" id="postBox">
	<?php
	
	switch ($stage){
		
		case 0: ?><input type="hidden" name="stage" value="1" />
    <table cellpadding="0" cellspacing="1" class="sgwizard">
    <tr><td colspan="2"><div class="sgwizardHd">1. Your Social Gallery</div></td></tr>
    <tr><td class="sgwL">Your Name:</td><td><input type="text" value="<?php echo sgpaef2df(); ?>" name="name" id="name" style="width:200px" /></td></tr>
    <tr style="display:none" id="nameShow"><td colspan="2"><div class="wError">This field is required!</div></td></tr>
    <tr><td class="sgwL">Your Email Address:</td><td><input type="text" value="<?php echo get_option('admin_email'); ?>" name="email" id="email" style="width:200px" /></td></tr>
    <tr style="display:none" id="emailShow"><td colspan="2"><div class="wError">This field is required!</div></td></tr>
    <tr><td class="sgwL">Get Notified about updates:</td><td><input type="checkbox" name="updateme" id="updateme" value="1" checked="checked" /></td></tr>
    <tr><td class="sgwL">&nbsp;</td><td style="text-align:right"><button type="button" id="sgNextStep" class="SocialGalleryOB">Next Step</button></td></tr>
    </table>
	<script type="text/javascript">jQuery(document).ready(function(e) {
        jQuery('#sgNextStep').unbind('click').click(function(ev){
			if (jQuery('#name').val() == ""){
				jQuery('#nameShow').show();
			} else if (jQuery('#email').val() == ""){
				jQuery('#emailShow').show();
			} else jQuery('#postBox').submit();
		});
		jQuery('#name').change(function(ev){
			if (jQuery(this).val().length > 0) jQuery('#nameShow').hide();			
		});
		jQuery('#email').change(function(ev){
			if (jQuery(this).val().length > 0) jQuery('#emailShow').hide();			
		});
    });</script><?php 
			break;
	
				case 1: 
		
				$selectorType = get_option('socialGalleryLite_selectorType');
		$selector = get_option('socialGalleryLite_selector');
		?><input type="hidden" name="stage" value="2" />
    <table cellpadding="0" cellspacing="1" class="sgwizard">
    <tr><td colspan="2"><div class="sgwizardHd">2. Social Gallery Selectors</div></td></tr>
    <tr><td colspan="2">
    		<p class="sgwizenth" style="text-align:center">Social Gallery needs to know which images you want it to work with.<br />Please choose a Preset Mode or type a Custom CSS Selector.</p>
            	<table style="width:420px;margin-left:auto;margin-right:auto;">
                <tr>	
                	<td class="sgwL">Preset Mode:</td>
                	<td><select name="socialGalleryLite_selectorType" id="socialGalleryLite_selectorType">
                                <option value="1"<?php if ($selectorType == "1") echo ' selected="selected"'; ?>>All Content Images</option>
                                <option value="10"<?php if ($selectorType == "10") echo ' selected="selected"'; ?>>Post Images</option>
                                <option value="3"<?php if ($selectorType == "3") echo ' selected="selected"'; ?>>Page Images</option>
                                <option value="4"<?php if ($selectorType == "4") echo ' selected="selected"'; ?>>Compatibility Mode</option>
                                <option value="2"<?php if ($selectorType == "2") echo ' selected="selected"'; ?>>Specific CSS Selector (class or ID)</option>
	               </select></td>
               </tr>
               <tr>
               		<td class="sgwL">Custom CSS Selector:</td>
                    <td><input type="text" name="socialGalleryLite_selector" id="socialGalleryLite_selector" value="<?php echo $selector; ?>" /><br />e.g. '.entry-content a:has(img)'</td>
               </tr>
               </table>
               <!--<p style="margin-left:53px;margin-right:45px;margin-bottom:33px;">A Custom CSS Selector should be the class or ID of the HTML element which contains images to use with Social Gallery. <a href="http://www.socialgalleryplugin.com/social-gallery-wordpress-plugin-and-css-selectors/" target="_blank">Read More on Custom CSS Selectors</a></p>-->
            </td></tr>
   	<tr><td class="sgwL">&nbsp;</td><td style="text-align:right"><button type="button" id="sgNextStep" class="SocialGalleryOB">Complete</button></td>
    </tr>
    </table>
            <div class="sgwizardtip"><span>Tip:</span><div>For most users one of the Preset Modes will work best.<br />Only very Customised themes require a Custom CSS Selector.<br /><br />
            <a href="http://www.socialgalleryplugin.com/preset-modes/" target="_blank">Read More About This Setting</a> or <a href="http://www.socialgalleryplugin.com/social-gallery-wordpress-plugin-and-css-selectors/" target="_blank">Read More on Custom CSS Selectors</a>
            </div></div>
	<script type="text/javascript">jQuery(document).ready(function(e) {
        jQuery('#sgNextStep').unbind('click').click(function(ev){
			jQuery('#postBox').submit();
		});
    });</script><?php
			break;
			
		case 2:
			
		?>
    <table cellpadding="0" cellspacing="1" class="sgwizard">
    <tr><td colspan="2"><div class="sgwizardHd">3. Complete</div></td></tr>
    <tr><td colspan="2" id="socialGalleryBL">
    	<div style="text-align:center">
        	<img src="<?php echo plugins_url('/i/thanks-for-using-social-gallery.png',__FILE__); ?>" width="450" alt="Thanks For Using Social Gallery" style="margin:8px" />
        </div>
    <p>Social Gallery Lite has finished the basic install and is now live with the default settings!<br />Thanks again for using Social Gallery, please do follow us on facebook &amp; twitter and remember to rate the plugin at WordPress.org!</p>
    <p style="text-align:center"><button type="button" id="sgFacebook" class="sgplBtn sgplBtn-primary">Follow on Facebook</button> <button type="button" id="sgTwitter" class="sgplBtn sgplBtn-primary">Follow on Twitter</button>  <button type="button" id="sgRateUs" class="sgplBtn sgplBtn-primary">Rate us on WordPress.org</button> </p>
    <p style="text-align:center">...or go straight to the settings:</p>
    <p style="text-align:center"><button type="button" id="sgNextStep" class="SocialGalleryOB">Go to Settings</button></p>
    </tr>
    </table>
	<script type="text/javascript">jQuery(document).ready(function(e) {
        jQuery('#sgNextStep').unbind('click').click(function(ev){
			window.location = 'admin.php?page=<?php echo $socialGalleryLite_slugs['settings']; ?>';
		});
        jQuery('#sgFacebook').unbind('click').click(function(ev){
			window.location = 'https://www.facebook.com/socialgalleryplugin';
		});
        jQuery('#sgTwitter').unbind('click').click(function(ev){
			window.location = 'https://twitter.com/socialgallerywp';
		});
        jQuery('#sgRateUs').unbind('click').click(function(ev){
			window.location = '<?php echo $socialGalleryLite_urls['wporg']; ?>';
		});
    });</script><?php 
			break;
	
	
	}
	
?></form></div><?php
}

function sgp010f9(){
	
		$toSave = false; if (isset($_GET['save'])) if ($_GET['save'] == "1") $toSave = true; 
		
		if ($toSave){
		
			sgpeedcf(); 
		
		} else { 
		
			global $socialGalleryWizardPrompt;
    
						sgp1a7();
			
			if ($socialGalleryWizardPrompt){
				
				sgpc317e4f();
				
			} else {
		
				sgp010f9_html(); 
			
			}
		
		}	
				
}

function sgp010f9_html(){
	
	global $wpdb, $socialGalleryLite_db_version, $socialGalleryLite_version, $socialGalleryLite_t, $socialGalleryLite_urls, $socialGalleryLite_slugs;	    
	$sgConfig = array();
	$sgConfig['selectorType'] = 			get_option('socialGalleryLite_selectorType');			    $sgConfig['selector'] = 				get_option('socialGalleryLite_selector');				    $sgConfig['bgColor'] = 					get_option('socialGalleryLite_bgColor');				    $sgConfig['bgOpacity'] = 				get_option('socialGalleryLite_bgOpacity');				    $sgConfig['bottomBar'] = 				get_option('socialGalleryLite_bottomBar');				    $sgConfig['headerBox'] = 				get_option('socialGalleryLite_headerBox');				    $sgConfig['headerBoxType'] = 			get_option('socialGalleryLite_headerBoxType');			    $sgConfig['headerBoxHTML'] = 			get_option('socialGalleryLite_headerBoxHTML');			    $sgConfig['headerImg'] = 				get_option('socialGalleryLite_headerImg');				    $sgConfig['incDesc'] = 					get_option('socialGalleryLite_incDesc');				    $sgConfig['incFB'] = 					get_option('socialGalleryLite_incFB');					    $sgConfig['incFBFaces'] = 				get_option('socialGalleryLite_incFBFaces');				    $sgConfig['incFBComments'] = 			get_option('socialGalleryLite_incFBComments');			    $sgConfig['incFBCommentAppID'] = 		get_option('socialGalleryLite_incFBAppID');				    $sgConfig['backAndForth'] = 			get_option('socialGalleryLite_backAndForth');			    $sgConfig['incFBSRC'] = 				get_option('socialGalleryLite_incFBSRC');				    $sgConfig['incHomeCall'] = 				get_option('socialGalleryLite_incHomeCall');				$sgConfig['autoDisableNextGen'] = 		get_option('socialGalleryLite_autoDisableNextGen');			$sgConfig['upscaleFactor'] = 			get_option('socialGalleryLite_upscaleFactor');				$sgConfig['marginBounds'] = 			get_option('socialGalleryLite_marginBounds');				
	
	$nextGenOptions = array("6","7","8","9");
	
	sgpbeaa2();

    global $socialGallerySavedSettingsFlag; if (isset($socialGallerySavedSettingsFlag)) if ($socialGallerySavedSettingsFlag) sgp96bf(0,"Saved options");
	
	$premiumMsg = '<div class="socGalPremium">This Feature is only available in the Full Version. <a href="'.$socialGalleryLite_urls['gopro'].'">Get Social Gallery Pro</a></div>';
	$premiumMsgShort = '<div class="socGalPremium">Pro Version Feature. <a href="'.$socialGalleryLite_urls['gopro'].'">Get Social Gallery Pro</a></div>';
	
		?>
        <p id="sgpDesc">Here you can set the configuration options for your Social Gallery Plugin. Before changing anything please read our <a href="<?php echo $socialGalleryLite_urls['docs']; ?>" title="View Documentation" target="_blank">setup guide</a>.</p>
        <form action="?page=<?php echo $socialGalleryLite_slugs['settings']; ?>&save=1" method="post">
        <div id="socialGallerySettings">
            <div id="socialGalleryMenu">
                <div class="socialGalleryPageActive" id="General">General</div>
                <div id="Style">Style</div>
                <div id="Social">Social</div>
                <div id="Comments">Comments</div>
                <div id="Adverts">Adverts</div>
            </div>
            <div id="socialGallerySettingsPage">
            
            
                <div id="socialGalleryPageGeneral" class="socialGalleryPage socialGalleryPageActive">
           			<h3>General Settings</h3>
                    <table width="715" border="0" cellpadding="0" cellspacing="0" class="sgpSettingsTable">
                    
                    <?php sgp17e4fce('Mode & CSS Selectors',0); ?>
                    
                    <tr>
                    <td class="sgFieldLabel">Social Gallery Mode:</td>
                        <td class="sgField">
                            <select name="socialGalleryLite_selectorType" id="socialGalleryLite_selectorType">
                                <option value="1"<?php if ($sgConfig['selectorType'] == "1") echo ' selected="selected"'; ?>>All Content Images</option>
                                <option value="10"<?php if ($sgConfig['selectorType'] == "10") echo ' selected="selected"'; ?>>Post Images</option>
                                <option value="3"<?php if ($sgConfig['selectorType'] == "3") echo ' selected="selected"'; ?>>Page Images</option>
                                <option value="4"<?php if ($sgConfig['selectorType'] == "4") echo ' selected="selected"'; ?>>Compatibility Mode</option>
                                <option value="2"<?php if ($sgConfig['selectorType'] == "2") echo ' selected="selected"'; ?>>Specific CSS Selector (class or ID)</option>
                            </select>
                        </td>
                    </tr>
                    <tr id="sgpCustomCSS"<?php if ($sgConfig['selectorType'] != "2") echo ' style="display:none"'; ?>>
                        <td class="sgFieldLabel" width="240" valign="top" style="padding-top:10px;">CSS Selector:</td>
                        <td class="sgField">
                            <input type="text" name="socialGalleryLite_selector" id="socialGalleryLite_selector" value="<?php echo $sgConfig['selector']; ?>" />
                            <br />* This should be the css class or id of the link around the image (e.g. '.socialGallery') <a href="http://www.socialgalleryplugin.com/social-gallery-wordpress-plugin-and-css-selectors/" target="_blank">Read more about Social Gallery and CSS Selectors</a>
                        </td>
                    </tr>
                    <tr id="sgpNextGenAutoSwitch"<?php if (!in_array($sgConfig['selectorType'],$nextGenOptions)) echo ' style="display:none"'; ?>>
                        <td class="sgFieldLabel sgFieldLabelCB" width="240" valign="top" style="padding-top:10px;">Automatically disable NextGen Effect:</td>
                        <td class="sgField">
                            <div class="sgFieldCB<?php if ($sgConfig['autoDisableNextGen'] == "1") echo ' on'; ?>">
                                <span class="thumb"></span>
                            	<input type="checkbox" name="socialGalleryLite_autoDisableNextGen" id="socialGalleryLite_autoDisableNextGen" value="1" <?php if ($sgConfig['autoDisableNextGen'] == "1") echo ' checked="checked"'; ?> />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="sgFieldLabel" width="240" valign="top" style="padding-top:10px;">Disclude CSS Selector:</td>
                        <td class="sgField">
                        	<?php echo $premiumMsg; ?>
                            <br />* This is for any additional to the already existing .noLightBox and .noSocialGallery
                        </td>
                    </tr>
                    
					<?php sgp17e4fce('General:'); ?>
                    <tr>
                        <td class="sgFieldLabel">Facebook Admin ID's CSV</td>
                        <td class="sgField">
                            <input type="text" name="socialGalleryLite_FBAdmins" id="socialGalleryLite_FBAdmins" value="<?php if (!empty($sgConfig['FBAdmins'])) echo $sgConfig['FBAdmins']; ?>"  />
                            <br />E.g. 5324234232,12345678
                        </td>
                    </tr>
                    <tr>
                        <td class="sgFieldLabel sgFieldLabelCB">Include Swipe Gestures<br />(iPad, iPhone and Mobile.)</td>
                        <td class="sgField">
                        	<?php echo $premiumMsg; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="sgFieldLabel sgFieldLabelCB">FullScreen Mode</td>
                        <td class="sgField">
                        	<?php echo $premiumMsg; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="sgFieldLabel sgFieldLabelCB">Always Fullscreen Mode</td>
                        <td class="sgField">
                        	<?php echo $premiumMsg; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="sgFieldLabel">Enlarge Images By:</td>
                        <td class="sgField">
                            <select name="socialGalleryLite_upscaleFactor" id="socialGalleryLite_upscaleFactor">
                            <?php 
                                    for ($i = 0; $i <= 20; $i++){
                                        echo '<option value="'.(1+($i*0.1)).'"';
                                        if ((1+($i*0.1)) == $sgConfig['upscaleFactor']) echo ' selected="selected"';
                                        echo '>'.(100*(1+($i*0.1))).'%</option>';
                                    }
                            ?>
                            </select>
                            <br />*This represents the amount you want to allow your images to "upscale" (default: 120%)
                        </td>
                    </tr>           
                    
					<?php sgp17e4fce('Social Gallery Pages:'); ?>
                      <tr>
                        <td class="sgFieldLabel sgFieldLabelCB">Use Social Gallery Pages</td>
                        <td class="sgField">
                        	<?php echo $premiumMsg; ?>
                        </td>
                      </tr>    
           			</table>
                </div>
                <div id="socialGalleryPageStyle" class="socialGalleryPage">
           			<h3>Style Settings</h3>
           
                    <table width="715" border="0" cellpadding="0" cellspacing="0" class="sgpSettingsTable">

                        <?php sgp17e4fce('Social Gallery Theme:',0); ?>
                            <tr>
                            <td class="sgFieldLabel">Social Gallery Theme:</td>
                            <td class="sgField">
                            	<strong>Classic</strong><br />
                        		<?php echo $premiumMsg; ?>
                            </td>
                          </tr>
                            
                        <?php sgp17e4fce('Margins and Navigation:'); ?>
                          <tr>
                            <td class="sgFieldLabel">Gallery Margin</td>
                            <td class="sgField">
                                <select name="socialGalleryLite_marginBounds" id="socialGalleryLite_marginBounds">
                                		<option value="0.05">5%</option>
                                <?php 
                                        for ($i = 1; $i <= 5; $i++){
                                            echo '<option value="'.($i*0.1).'"';
                                            if (($i*0.1) == $sgConfig['marginBounds']) echo ' selected="selected"';
                                            echo '>'.(100*($i*0.1)).'%</option>';
                                        }
                                ?>
                                </select>
                                *This represents the amount you margin around your images
                            </td>
                          </tr> 
                          <tr>
                            <td class="sgFieldLabel">Show Previous/Next Navigation</td>
                            <td class="sgField">
                                <div class="sgFieldCB<?php if ($sgConfig['backAndForth'] == "1") echo ' on'; ?>">
                                    <span class="thumb"></span>
                                     <input type="checkbox" name="socialGalleryLite_backAndForth" id="socialGalleryLite_backAndForth" value="1" <?php if ($sgConfig['backAndForth'] == "1") echo ' checked="checked"'; ?> />
                                </div>    
                            </td>
                          </tr>
                          </tr><tr><td class="sgFieldLabelHD" colspan="2">Social Header</td></tr>
                            
                          <tr>
                            <td class="sgFieldLabel">Show Social Header</td>
                            <td class="sgField">
                                <div class="sgFieldCB<?php if ($sgConfig['headerBox'] == "1") echo ' on'; ?>">
                                    <span class="thumb"></span>
                                    <input type="checkbox" name="socialGalleryLite_headerBox" id="socialGalleryLite_headerBox" value="1" <?php if ($sgConfig['headerBox'] == "1") echo ' checked="checked"'; ?> />
                                </div>
                            </td>
                          </tr>
                          <tr id="sgWhatHeader"<?php if ((int)$sgConfig['headerBox'] != 1) echo ' style="display:none"'; ?>>
                            <td class="sgFieldLabel">Social Header Type</td>
                            <td class="sgField">
                                <select name="socialGalleryLite_headerBoxType" id="socialGalleryLite_headerBoxType">
                                    <option value="1"<?php if ($sgConfig['headerBoxType'] == "1") echo ' selected="selected"'; ?>>Site Img & Link</option>
                                    <option value="2"<?php if ($sgConfig['headerBoxType'] == "2") echo ' selected="selected"'; ?>>Site Link</option>
                                    <option value="3"<?php if ($sgConfig['headerBoxType'] == "3") echo ' selected="selected"'; ?>>Custom HTML</option>
                                </select>
                            </td>
                          </tr>
                          <tr id="sgpCustomHtml"<?php if ($sgConfig['headerBoxType'] != "3" || $sgConfig['headerBox'] != "1") echo ' style="display:none"'; ?>>
                            <td class="sgFieldLabel" valign="top">HTML to show as Side Header</td>
                            <td class="sgField">
                                <textarea name="socialGalleryLite_headerBoxHTML" id="socialGalleryLite_headerBoxHTML"><?php echo stripslashes(html_entity_decode($sgConfig['headerBoxHTML'])); ?></textarea>
                            </td>
                          </tr>            
                           <tr id="sgpCustomLogo"<?php if ($sgConfig['headerBoxType'] != "1" || (int)$sgConfig['headerBox'] != 1) echo ' style="display:none"'; ?>>
                            <td class="sgFieldLabel" width="240">Social Header Image:</td>
                            <td class="sgField">
                                <input type="text" name="socialGalleryLite_headerImg" id="socialGalleryLite_headerImg" value="<?php echo $sgConfig['headerImg']; ?>" />
                                <input id="upload_image_button" type="button" value="Upload Image" />
                                <span>(50x50px)</span>
                            </td>
                          </tr>
                          </tr><tr><td class="sgFieldLabelHD" colspan="2">Show Image Title as Description</td></tr>
                                  <tr>
                                    <td class="sgFieldLabel">Show Image Title as Description</td>
                                    <td class="sgField">
                                        <div class="sgFieldCB<?php if ($sgConfig['incDesc'] == "1") echo ' on'; ?>">
                                            <span class="thumb"></span>
                                            <input type="checkbox" name="socialGalleryLite_incDesc" id="socialGalleryLite_incDesc" value="1" <?php if ($sgConfig['incDesc'] == "1") echo ' checked="checked"'; ?> />
                                        </div>
                                    </td>
                                  </tr> 
                          
                            <tr><td class="sgFieldLabelHD" colspan="2">Picture Bar</td></tr>
                            
                          <tr>
                            <td class="sgFieldLabel">Show Picture Bar</td>
                            <td class="sgField">
                                <div class="sgFieldCB<?php if ($sgConfig['bottomBar'] == "1") echo ' on'; ?>">
                                    <span class="thumb"></span>
                                     <input type="checkbox" name="socialGalleryLite_bottomBar" id="socialGalleryLite_bottomBar" value="1" <?php if ($sgConfig['bottomBar'] == "1") echo ' checked="checked"'; ?> />
                                </div>    
                            </td>
                          </tr>
                          <tr id="sgWhatPictureBar"<?php if ($sgConfig['bottomBar'] != 1) echo ' style="display:none"'; ?>>
                            <td class="sgFieldLabel">Picture Bar Title</td>
                            <td class="sgField">
                            	<strong>Page Title</strong><br />
	                        	<?php echo $premiumMsg; ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="sgFieldLabel">Show Image Download Link</td>
                            <td class="sgField">
                        		<?php echo $premiumMsg; ?>
                            </td>
                          </tr>
                          
                            <tr><td class="sgFieldLabelHD" colspan="2">Lightbox Background</td></tr>
                            
                           <tr>
                            <td class="sgFieldLabel" width="240">Lightbox Background Color:</td>
                            <td class="sgField">
                                #<input type="text" name="socialGalleryLite_bgColor" id="socialGalleryLite_bgColor" value="<?php echo $sgConfig['bgColor']; ?>" /> <span>(e.g. 000000)</span>
                            </td>
                          </tr>
                           <tr>
                            <td class="sgFieldLabel">Lightbox Background Opacity:</td>
                            <td class="sgField">
                                <input type="text" name="socialGalleryLite_bgOpacity" id="socialGalleryLite_bgOpacity" value="<?php echo $sgConfig['bgOpacity']; ?>" /> <span>(e.g. 0.8)</span>
                            </td>
                          </tr>
                          
                            <tr><td class="sgFieldLabelHD" colspan="2">CSS 3 Animation Effects</td></tr>
                          <tr>
                            <td class="sgFieldLabel">CSS3 Effects</td>
                            <td class="sgField">
                        		<?php echo $premiumMsg; ?>
                            </td>
                          </tr>
                            
                	</table>                    
                </div>
                <div id="socialGalleryPageSocial" class="socialGalleryPage">
           			<h3>Social Settings</h3>
           
                    <table width="715" border="0" cellpadding="0" cellspacing="0" class="sgpSettingsTable">
                    
                        <?php sgp17e4fce('Share Buttons:',0); ?>
                                        
                              <tr>
                                <td class="sgFieldLabel">Show Tweet button</td>
                                <td class="sgField">
                        			<?php echo $premiumMsgShort; ?>
                                </td>
                              </tr>
                              <tr>
                                <td class="sgFieldLabel">Show Facebook Like button</td>
                                <td class="sgField">
                                    <div class="sgFieldCB<?php if ($sgConfig['incFB'] == "1") echo ' on'; ?>">
                                        <span class="thumb"></span>
                                        <input type="checkbox" name="socialGalleryLite_incFB" id="socialGalleryLite_incFB" value="1" <?php if ($sgConfig['incFB'] == "1") echo ' checked="checked"'; ?> />
                                    </div>
                                </td>
                              </tr>             
                              <tr id="facebookFaces"<?php if ($sgConfig['incFB'] != 1) echo ' style="display:none"'; ?>>
                                <td class="sgFieldLabel">Show fan faces (below Facebook like button)</td>
                                <td class="sgField">
                                    <div class="sgFieldCB<?php if ($sgConfig['incFBFaces'] == "1") echo ' on'; ?>">
                                        <span class="thumb"></span>
                                        <input type="checkbox" name="socialGalleryLite_incFBFaces" id="socialGalleryLite_incFBFaces" value="1" <?php if ($sgConfig['incFBFaces'] == "1") echo ' checked="checked"'; ?> />
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                <td class="sgFieldLabel">Show Google Plus Share button</td>
                                <td class="sgField">
                        			<?php echo $premiumMsgShort; ?>
                                </td>
                              </tr>      
                              <tr>
                                <td class="sgFieldLabel">Show Pinterest button</td>
                                <td class="sgField">
                        			<?php echo $premiumMsgShort; ?>
                                </td>
                              </tr>
                              <tr>
                                <td class="sgFieldLabel">Show Tumblr Share button</td>
                                <td class="sgField">
                        			<?php echo $premiumMsgShort; ?>
                                </td>
                              </tr>  
                              <tr>
                                <td class="sgFieldLabel">Show Linked In Share button</td>
                                <td class="sgField">
                        			<?php echo $premiumMsgShort; ?>
                                </td>
                              </tr>   
                              <tr>
                                <td class="sgFieldLabel">Show Stumble Upon button</td>
                                <td class="sgField">
                        			<?php echo $premiumMsgShort; ?>
                                </td>
                              </tr> 
                                    
                              
                               <tr><td class="sgFieldLabelHD" colspan="2">Include Scripts</td></tr>
                              
                              <tr>
                                <td class="sgFieldLabel">Include Facebook Javascript *</td>
                                <td class="sgField">
                                    <div class="sgFieldCB<?php if ($sgConfig['incFBSRC'] == "1") echo ' on'; ?>">
                                        <span class="thumb"></span>
                                         <input type="checkbox" name="socialGalleryLite_incFBSRC" id="socialGalleryLite_incFBSRC" value="1" <?php if ($sgConfig['incFBSRC'] == "1") echo ' checked="checked"'; ?> />
                                    </div>    
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td><span>* If you know that you have included Facebook javascript calls elsewhere on your blog (e.g. if you have working facebook like buttons already) you can disable the inclusion of the corresponding script here, this allows you to avoid calling them more than once.</span></td>
                              </tr>
                                        
                	</table>
                    
                </div>
                <div id="socialGalleryPageComments" class="socialGalleryPage">
           			<h3>Comment Settings</h3>
           
                    <table width="715" border="0" cellpadding="0" cellspacing="0" class="sgpSettingsTable">
                    
                        <?php sgp17e4fce('Comment Settings:',0); ?>
                    
                    
                              <tr>
                                <td class="sgFieldLabel">Show Facebook Comments</td>
                                <td class="sgField">
                                    <div class="sgFieldCB<?php if ($sgConfig['incFBComments'] == "1") echo ' on'; ?>">
                                        <span class="thumb"></span>
                                        <input type="checkbox" name="socialGalleryLite_incFBComments" id="socialGalleryLite_incFBComments" value="1" <?php if ($sgConfig['incFBComments'] == "1") echo ' checked="checked"'; ?> />
                                    </div>
                                </td>
                              </tr>
                             <tr id="facebookAppID"<?php if ($sgConfig['incFBComments'] != "1" && $sgConfig['incFB'] != 1) echo ' style="display:none"'; ?>>
                                <td class="sgFieldLabel">Facebook App ID</td>
                                <td class="sgField">
                                    <input type="text" name="socialGalleryLite_incFBAppID" id="socialGalleryLite_incFBAppID" value="<?php if (isset($sgConfig['incFBAppID'])) echo $sgConfig['incFBAppID']; ?>" />
                                </td>
                              </tr>
                             <tr id="facebookAppIDInfo"<?php if ($sgConfig['incFBComments'] != "1" && $sgConfig['incFB'] != 1) echo ' style="display:none"'; ?>>
                                <td class="sgFieldLabel">&nbsp;</td>
                                <td class="sgField">
                                    By default Social Gallery uses its own Facebook App for dealing with likes & comments. If you want to see insights on these actions you may want to add your own Facebook App ID here. <a href="http://www.socialgalleryplugin.com/guide-facebook-app-id-for-use-with-social-gallery-for-fb-comments-likesend-buttons/" target="_blank">Read more on using your own Facebook App ID</a>
                                </td>
                              </tr>
                              <tr>
                                <td class="sgFieldLabel">Show Disqus Comments</td>
                                <td class="sgField">
                        			<?php echo $premiumMsg; ?>            
                                </td>
                              </tr>
                    
                	</table>
                    
                </div>
                <div id="socialGalleryPageAdverts" class="socialGalleryPage">
           			<h3>Advertisement Settings</h3>
           
                    <table width="715" border="0" cellpadding="0" cellspacing="0" class="sgpSettingsTable">
                    
                        <?php sgp17e4fce('Adsense (Requires Google DFP):',0); ?>
          
                              <tr>
                                <td class="sgFieldLabel">Use Adsense</td>
                                <td class="sgField">
                        			<?php echo $premiumMsg; ?>     
                                </td>
                              </tr>
                	</table>
                    
                </div>
	       		
                <div id="socialGallerySaveButton"><input type="submit" value="Save All Settings" class="bButton" /></div>
                
            </div>
                      	
        </div>
        </form>
        <script type="text/javascript">jQuery(document).ready(function(ex) {            	
				jQuery('#socialGalleryMenu div').unbind('click').click(function(e) {
						var page = jQuery(this).attr('id');
						jQuery(this).removeClass('socialGalleryPageActive');
						jQuery('.socialGalleryPageActive').removeClass('socialGalleryPageActive');
						jQuery('#socialGalleryPage' + page).addClass('socialGalleryPageActive').slideDown(400);
						jQuery('#' + page).addClass('socialGalleryPageActive');						
						e.preventDefault();				
            	});   				
            });</script><?php
		
}

function sgpc1a() {
	
	global $socialGalleryWizardPrompt, $wpdb, $socialGalleryLite_urls, $socialGalleryLite_version;		
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
    
		sgp1a7();
    
	if ($socialGalleryWizardPrompt){
		
		sgpc317e4f();
		
	} else {
		
				
		sgpbeaa2();
		
				$toSave = false; if (isset($_GET['save'])) if ($_GET['save'] == "1") $toSave = true; 
	
				sgp43542c(); 

		 if ($toSave && !$toCrawl){
		 
				sgpeedcf(); 
		 
		} else { 
		
				sgpc1a_html(); 
			
		}	
		
	?>
	</div>
	<?php 
	
	}
}


function sgpc1a_html(){
    	
	global $wpdb, $socialGalleryLite_db_version, $socialGalleryLite_version, $socialGalleryLite_t, $socialGalleryLite_urls, $socialGalleryLite_slugs;	    		
	
	sgp7aed();

    ?>
    <div class="postbox-container" id="main-container" style="width:75%;">
            <div class="postbox">
                <h3 style="text-align:center"><label><img src="<?php echo plugins_url('/i/thanks-for-using-social-gallery.png',__FILE__); ?>" alt="Thanks For Using Social Gallery" style="margin:8px" /></label></h3>
                <div class="inside">
                    <p style="text-align:center"><strong>Welcome to Social Gallery Lite</strong>, the Free version of the Ultimate Social Lightbox Plugin for WordPress. Social Gallery has lots of bells and whistles, you can dive right in below by changing a setting, or you can just go right ahead and enjoy all of the extra social interaction your blog will now have! If you want to join the hundreds of other users of Social Gallery Pro <a href="<?php echo $socialGalleryLite_urls['gopro']; ?>" target="_blank">Buy Social Gallery Pro Now</a> (just $25!)</div>
                    <div style="clear:both"></p>
                    <div id="SocialGalleryBenefits">
                    	<div style="font-weight:bold;font-size:14px;margin-bottom:10px;">There are lots of benefits of buying the full version of Social Gallery, here's why most customers tell us it's great:</div>
                        <ul style="margin-left:125px;">
                        	<li>Access to Support Forum</li>
                        	<li>More Preset Modes (NextGen &amp; Justified Image Grid)</li>
                        	<li>Fullscreen Mode</li>
                            <li>Add Twitter, Google+, Linked in and Others</li>
                            <li>CSS3 Animations</li>
                            <li>Mobile Swipe Navigation</li>
                            <li>Adsense Compatibility</li>
                            <li>Lots more features...</li>                            
                        </ul>
                        <div style="margin-top:12px"><a href="admin.php?page=<?php echo $socialGalleryLite_slugs['settings']; ?>" class="SocialGalleryOB">Settings</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $socialGalleryLite_urls['gopro']; ?>" class="sgplBtn sgplBtn-primary" target="_blank">Buy Social Gallery Pro Now</a> ($25)</div>
                    </div>
                    <div style="clear:both"></div>
                </div>
            </div>
            <div class="postbox">
                <h3 style="padding:8px;"><label><?php _e('Social Gallery News'); ?></label></h3>
                <div class="inside">
                	<?php sgpf2fd93c(); ?>
                </div>
            </div>  
   </div>
   <?php 
   
   
   		$subscribed = false; $wizardObj = get_option('socialGalleryLite_wizardObject'); if (isset($wizardObj['subscribeflag'])) if ($wizardObj['subscribeflag'] == 1) $subscribed = true;

   if (!$subscribed){ ?>
   <div class="postbox-container" id="side-container" style="width:24%;margin-left:1%">
            <div class="postbox">
                <h3 style="padding:8px;"><label><?php _e('Subscribe to the Update List'); ?></label></h3>
                <div class="inside">
                	<?php sgp351e33(); ?>
                </div>
            </div>
   </div>
   <?php } ?>
    <div class="postbox-container" id="side-container" style="width:24%;margin-left:1%">
            <div class="postbox">
                <h3 style="padding:8px;"><label><?php _e('Share the love'); ?></label></h3>
                <div class="inside">
                	<p>This plugin has been developed with love & effort, it's a work in progress and I really appreciate all of the contribution you guys make to it. Thank you!</p>
                    <ul id="SocialGalleryHelpOut">
                    	<li><a href="<?php echo $socialGalleryLite_urls['wporg']; ?>" target="_blank">Rate it 5 stars on WordPress.org</a></li>
                    	<li><a href="<?php echo $socialGalleryLite_urls['gopro']; ?>" target="_blank">Buy the Full Version</a></li>
                    </ul>
                    <div  style="text-align:center;margin-top:12px"><strong>Share Social Gallery:</strong></div>
                    <div class="socialGalleryShareBox">
                    <a href="http://www.facebook.com/sharer.php?s= 100&amp;p[title]=Social Gallery - The Ultimate WordPress Lightbox&amp;p[url]=http://www.socialgalleryplugin.com&amp;p[summary]=Social Gallery adds Social Sharing to all of the images on your blog, making it easier for your blog visitors to share your content. A Must Have plugin for all WordPress users."target="_blank"><img src="<?php echo plugins_url('/i/fbshare.png',__FILE__); ?>" alt="" title="Share on Facebook to Earn" /></a>
			   
               <a href="http://twitter.com/home?status=I Recommend You Get Social Gallery for WordPress!! http://www.socialgalleryplugin.com" target="_blank"><img src="<?php echo plugins_url('/i/tweet.png',__FILE__); ?>" alt="" title="Share this on Twitter to earn a Commision" /></a>
			   
		 <a href="http://www.linkedin.com/shareArticle?mini=true&url=http://www.socialgalleryplugin.com&title=Social Gallery for WordPress&source=Social Gallery Pros" target="_blank"><img src="<?php echo plugins_url('/i/linkedin.png',__FILE__); ?>" alt="" title="Share this on LinkedIn" /></a>
			   
		 <a href="https://plus.google.com/share?url=http://www.socialgalleryplugin.com" target="_blank"><img src="<?php echo plugins_url('/i/gp.png',__FILE__); ?>" alt="" title="Share this on Google+1" /></a>
         			</div>
                </div>
            </div>
   </div>
   
   <div class="postbox-container" id="side-container" style="width:24%;margin-left:1%">
            <div class="postbox">
                <h3 style="padding:8px;"><label><?php _e('Compatible Themes & Plugins'); ?></label></h3>
                <div class="inside">
					<ul><?php
   $lastCompatCheck = get_option('socialGalleryLite_LastComCheck');
   if (!$lastCompatCheck || $lastCompatCheck < time()-172800) { 	   try { 
				$compatibleOthersCode = sgpa033($socialGalleryLite_urls['comCheck']);
				$compatibleOthers = json_decode($compatibleOthersCode);
				if (isset($compatibleOthers->lu)){
				
					if (isset($compatibleOthers->r)) 
						if (count($compatibleOthers->r) > 0)
							foreach ($compatibleOthers->r as $id => $r){
								
								?><li>
                                        <a href='<?php echo $r->u; ?>' target = '_blank' title='<?php echo $r->n; ?>'><?php echo $r->n; ?></a><br/>
                                        <?php echo  $r->d ; ?>
                   				</li><?php
																
							}
						else 
							echo '<li>None Today</li>';
					
										update_option('socialGalleryLite_CompatibleOthers',$compatibleOthers);
					
				}
				
								update_option('socialGalleryLite_LastComCheck',time());
				
	   } catch (Exception $e){
				   }
	} else {
			
   		$compatibleOthers = get_option('socialGalleryLite_CompatibleOthers');
		if (isset($compatibleOthers->r)) 
				if (count($compatibleOthers->r) > 0)
					foreach ($compatibleOthers->r as $id => $r){
						
						?><li>
								<a href='<?php echo $r->u; ?>' target = '_blank' title='<?php echo $r->n; ?>'><?php echo $r->n; ?></a><br/>
								<?php echo  $r->d ; ?>
						</li><?php
														
					}
				else 
					echo '<li>None Today</li>';	
		
	} ?>
   					</ul>
                </div>
            </div>
	   </div>
   <?php
}

function sgp1bf8a8c(){}					function sgpbeaa2(){

	
	global $wpdb, $socialGalleryLite_urls, $socialGalleryLite_version;		
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
    
?>
<div id="sgpBody">
    <div class="wrap"> 
	    <h2 id="socialGalleryLogo" style="background:url(<?php echo plugins_url('/i/social-gallery.png',__FILE__); ?>)"><span style="display:none">Social Gallery Plugin Lite</span></h2> 
    	<div id="sgpSocial">
            <a href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.socialgalleryplugin.com&media=http%3A%2F%2Fwww.socialgalleryplugin.com%2FsocialGallery.png&description=I%20use%20the%20Social%20Gallery%20Plugin%20for%20Wordpress%2C%20its%20awesome!%20http%3A%2F%2Fwww.socialgalleryplugin.com" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
            <a href="https://twitter.com/share" class="twitter-share-button" data-via="SocialGalleryWP" data-url="http://codecanyon.net/item/social-gallery-wordpress-photo-viewer-plugin/2665332">Tweet</a>
            <div class="fb-like" data-href="http://codecanyon.net/item/social-gallery-wordpress-photo-viewer-plugin/2665332" data-send="true" data-width="400" data-show-faces="false"></div>
        </div>
    </div>
    <div id="sgpHeader">
		<a href="<?php echo $socialGalleryLite_urls['home']; ?>" title="Social Gallery Plugin Homepage" target="_blank">Social Gallery Plugin.com</a> | 
		<a href="<?php echo $socialGalleryLite_urls['faq']; ?>" title="Frequently Asked Questions" target="_blank">FAQ</a> | 
		<a href="<?php echo $socialGalleryLite_urls['docs']; ?>" title="View Documentation" target="_blank">Documentation</a> | 
		<a href="<?php echo $socialGalleryLite_urls['subscribe']; ?>" title="Join the Updates Newsletter List" target="_blank">Join Update List</a> | 
		<a href="<?php echo $socialGalleryLite_urls['gopro']; ?>" title="Become a Pro" target="_blank">Get Full Version</a> | Version <?php echo $socialGalleryLite_version; ?>
    </div>
    <?php 	
	
	
		global $socialGalleryMessagehidden;
	if ($socialGalleryMessagehidden)			
		sgp96bf(0,'Message hidden');

	
}


function sgpf2fd93c(){

				global $socialGalleryLite_urls;
                include_once(ABSPATH . WPINC . '/feed.php');
                add_filter( 'wp_feed_cache_transient_lifetime' , 'sgpf64' );
                $rss = fetch_feed($socialGalleryLite_urls['newsFeed']);
                remove_filter( 'wp_feed_cache_transient_lifetime' , 'sgpf64' );
                
                if (!is_wp_error( $rss ) ) {
					
					$maxitems = $rss->get_item_quantity(5); 
                    $rss_items = $rss->get_items(0, $maxitems); 
					
				} ?>
                
                <ul>
                    <?php 
					if ($maxitems == 0) 
						echo '<li>No News (is this good news?)</li>';
                    else 
						foreach ( $rss_items as $item ) : ?>
                    <li>
                        <a href='<?php echo esc_url( $item->get_permalink() ); ?>' target = '_blank'
                        title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
                        <?php echo  $item->get_title() ; ?></a><br/>
                        <?php echo  $item->get_description() ; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                
                <?php
	
}


function sgp351e33(){

?>
<div id="socialGallerySubscribe">
<style type="text/css">
#af-form-1780578012 .af-body .af-textWrap{width:98%;display:block;float:none;}
#af-form-1780578012 .af-body .privacyPolicy{color:#000000;font-size:11px;font-family:Trebuchet MS, sans-serif;}
#af-form-1780578012 .af-body a{color:#758751;text-decoration:underline;font-style:normal;font-weight:normal;}
#af-form-1780578012 .af-body input.text, #af-form-1780578012 .af-body textarea{background-color:#FFFFFF;border-color:#919191;border-width:1px;border-style:solid;color:#000000;text-decoration:none;font-style:normal;font-weight:normal;font-size:12px;font-family:Trebuchet MS, sans-serif;}
#af-form-1780578012 .af-body input.text:focus, #af-form-1780578012 .af-body textarea:focus{background-color:#FFFAD6;border-color:#000000;border-width:1px;border-style:solid;}
#af-form-1780578012 .af-body label.previewLabel{display:block;float:none;text-align:left;width:auto;color:#000000;text-decoration:none;font-style:normal;font-weight:normal;font-size:14px;font-family:Trebuchet MS, sans-serif;}
#af-form-1780578012 .af-body{padding-bottom:15px;padding-top:15px;background-repeat:no-repeat;background-position:inherit;background-image:none;color:#000000;font-size:11px;font-family:Trebuchet MS, sans-serif;}
#af-form-1780578012 .af-header{padding-bottom:1px;padding-top:1px;padding-right:10px;padding-left:60px;background-color:#0B98D0;background-repeat:no-repeat;background-position:inherit;background-image:url("http://forms.aweber.com/images/forms/mail-icon/green/header.png");border-width:1px;border-bottom-style:none;border-left-style:none;border-right-style:none;border-top-style:none;color:#FFFFFF;font-size:14px;font-family:Trebuchet MS, sans-serif;}
#af-form-1780578012 .af-quirksMode .bodyText{padding-top:2px;padding-bottom:2px;}
#af-form-1780578012 .af-quirksMode{padding-right:10px;padding-left:10px;}
#af-form-1780578012 .af-standards .af-element{padding-right:10px;padding-left:10px;}
#af-form-1780578012 .bodyText p{margin:1em 0;}
#af-form-1780578012 .buttonContainer input.submit{background-color:#1b5489;background-image:url("http://forms.aweber.com/images/forms/mail-icon/green/button.png");color:#FFFFFF;text-decoration:none;font-style:normal;font-weight:normal;font-size:14px;font-family:Verdana, sans-serif;}
#af-form-1780578012 .buttonContainer input.submit{width:auto;}
#af-form-1780578012 .buttonContainer{text-align:right;}
#af-form-1780578012 body,#af-form-1780578012 dl,#af-form-1780578012 dt,#af-form-1780578012 dd,#af-form-1780578012 h1,#af-form-1780578012 h2,#af-form-1780578012 h3,#af-form-1780578012 h4,#af-form-1780578012 h5,#af-form-1780578012 h6,#af-form-1780578012 pre,#af-form-1780578012 code,#af-form-1780578012 fieldset,#af-form-1780578012 legend,#af-form-1780578012 blockquote,#af-form-1780578012 th,#af-form-1780578012 td{float:none;color:inherit;position:static;margin:0;padding:0;}
#af-form-1780578012 button,#af-form-1780578012 input,#af-form-1780578012 submit,#af-form-1780578012 textarea,#af-form-1780578012 select,#af-form-1780578012 label,#af-form-1780578012 optgroup,#af-form-1780578012 option{float:none;position:static;margin:0;}
#af-form-1780578012 div{margin:0;}
#af-form-1780578012 fieldset{border:0;}
#af-form-1780578012 form,#af-form-1780578012 textarea,.af-form-wrapper,.af-form-close-button,#af-form-1780578012 img{float:none;color:inherit;position:static;background-color:none;border:none;margin:0;padding:0;}
#af-form-1780578012 input,#af-form-1780578012 button,#af-form-1780578012 textarea,#af-form-1780578012 select{font-size:100%;}
#af-form-1780578012 p{color:inherit;}
#af-form-1780578012 select,#af-form-1780578012 label,#af-form-1780578012 optgroup,#af-form-1780578012 option{padding:0;}
#af-form-1780578012 table{border-collapse:collapse;border-spacing:0;}
#af-form-1780578012 ul,#af-form-1780578012 ol{list-style-image:none;list-style-position:outside;list-style-type:disc;padding-left:40px;}
#af-form-1780578012,#af-form-1780578012 .quirksMode{width:210px;}
#af-form-1780578012.af-quirksMode{overflow-x:hidden;}
#af-form-1780578012{background-color:#FFFFFF;border-color:#1B5489;border-width:1px;border-style:solid;}
#af-form-1780578012{display:block;}
#af-form-1780578012{overflow:hidden;}
.af-body .af-textWrap{text-align:left;}
.af-body input.image{border:none!important;}
.af-body input.submit,.af-body input.image,.af-form .af-element input.button{float:none!important;}
.af-body input.text{width:100%;float:none;padding:2px!important;}
.af-body.af-standards input.submit{padding:4px 12px;}
.af-clear{clear:both;}
.af-element label{text-align:left;display:block;float:left;}
.af-element{padding:5px 0;}
.af-form-wrapper{text-indent:0;}
.af-form{text-align:left;margin:auto;}
.af-header{margin-bottom:0;margin-top:0;padding:10px;}
.af-quirksMode .af-element{padding-left:0!important;padding-right:0!important;}
.lbl-right .af-element label{text-align:right;}
body {
}
</style>
<form method="post" class="af-form-wrapper" action="http://www.aweber.com/scripts/addlead.pl"  >
<div style="display: none;">
<input type="hidden" name="meta_web_form_id" value="1780578012" />
<input type="hidden" name="meta_split_id" value="" />
<input type="hidden" name="listname" value="socialgallery" />
<input type="hidden" name="redirect" value="http://www.aweber.com/thankyou-coi.htm?m=text" id="redirect_a277f96d29c5d9922124a3e9286b2d3e" />

<input type="hidden" name="meta_adtracking" value="Social_Gallery_In_Plugin" />
<input type="hidden" name="meta_message" value="1" />
<input type="hidden" name="meta_required" value="name,email" />

<input type="hidden" name="meta_tooltip" value="" />
</div>
<div id="af-form-1780578012" class="af-form"><div id="af-header-1780578012" class="af-header"><div class="bodyText"><p>&nbsp;Get Update Emails..</p></div></div>
<div id="af-body-1780578012"  class="af-body af-standards">
<div class="af-element">
<label class="previewLabel" for="awf_field-43145771">Your Name: </label>
<div class="af-textWrap">
<input id="awf_field-43145771" type="text" name="name" class="text" value=""  tabindex="500" />
</div>
<div class="af-clear"></div></div>
<div class="af-element">
<label class="previewLabel" for="awf_field-43145772">Your Email: </label>
<div class="af-textWrap"><input class="text" id="awf_field-43145772" type="text" name="email" value="<?php echo get_option('admin_email'); ?>" tabindex="501"  />
</div><div class="af-clear"></div>
</div>
<div class="af-element buttonContainer">
<input name="submit" id="af-submit-image-1780578012" type="image" class="image" style="background: none;" alt="Submit Form" src="http://www.aweber.com/images/forms/mail-icon/green/button.png" tabindex="502" />
<div class="af-clear"></div>
</div>
<div class="af-element privacyPolicy" style="text-align: center"><p>We respect your <a title="Privacy Policy" href="http://www.aweber.com/permission.htm" target="_blank">email privacy</a></p>
<div class="af-clear"></div>
</div>
</div>
</div>
<div style="display: none;"><img src="http://forms.aweber.com/form/displays.htm?id=jOwcDKzsHAyMTA==" alt="" /></div>
</form>
<script type="text/javascript">
    <!--
    (function() {
        var IE = /*@cc_on!@*/false;
        if (!IE) { return; }
        if (document.compatMode && document.compatMode == 'BackCompat') {
            if (document.getElementById("af-form-1780578012")) {
                document.getElementById("af-form-1780578012").className = 'af-form af-quirksMode';
            }
            if (document.getElementById("af-body-1780578012")) {
                document.getElementById("af-body-1780578012").className = "af-body inline af-quirksMode";
            }
            if (document.getElementById("af-header-1780578012")) {
                document.getElementById("af-header-1780578012").className = "af-header af-quirksMode";
            }
            if (document.getElementById("af-footer-1780578012")) {
                document.getElementById("af-footer-1780578012").className = "af-footer af-quirksMode";
            }
        }
    })();
    -->
</script>
</div>
<?php	
}
function sgpdacb9a(){}					
function sgp33da($e='',$na='',$es=1,$p=-1,$pa=-1,$n=-1,$j=-1){

			global $socialGalleryLite_urls, $socialGalleryLite_version;	
			if( function_exists('curl_init') ) { 
					$postData = array('ori'=>get_site_url());
					$postData['e'] = $e;
					$postData['es'] = $es;
					$postData['na'] = $na;
					$postData['p'] = $p;
					$postData['pa'] = $pa;
					$postData['n'] = $n;
					$postData['j'] = $j;
					
					$fields = ''; foreach($postData as $key => $value) $fields .= $key . '=' . $value . '&'; rtrim($fields, '&');
					$ch = curl_init($socialGalleryLite_urls['regCheck']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_POST, count($postData));
					curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
					curl_setopt($ch, CURLOPT_TIMEOUT, 10);
					$regDets = curl_exec($ch);
					
					curl_close($ch);
					return $regDets;
			} 			return  $false;
}

function sgpa2e(){

		$lastUpdated = get_option('socialGalleryLite_lastUpCheck');
		$newUpdateFlag = get_option('socialGalleryLite_newVerFlag');
		$hasshared = get_option('socialGalleryLite_sharedSettings');
		if ((int)$lastUpdated < time()-21600 || !empty($newUpdateFlag)){ 
		
			global $socialGalleryLite_urls, $socialGalleryLite_version;			
			if( function_exists('curl_init') ) { 
					$postData = array('ori'=>get_site_url());
					if (get_option('socialGalleryLite_shareWithDevs') == "1"){ 					if (function_exists('json_encode')) $postData['o'] = json_encode(array('s1'=>get_option('socialGalleryLite_selectorType'),'s2'=>urlencode(get_option('socialGalleryLite_selector')),'s3'=>get_option('socialGalleryLite_bottomBar'),'s4'=>get_option('socialGalleryLite_bottomBarTitleSource'),'v'=>$socialGalleryLite_version,'s5'=>get_option('socialGalleryLite_headerBoxType'),'s6'=>get_option('socialGalleryLite_incDesc'),'s7'=>get_option('socialGalleryLite_incTwit'),'s8'=>get_option('socialGalleryLite_incFB'),'s9'=>get_option('socialGalleryLite_incFBFaces'),'s10'=>get_option('socialGalleryLite_incPin'),'s11'=>get_option('socialGalleryLite_incFBComments'),'s12'=>get_option('socialGalleryLite_incDisqusComments'),'s13'=>get_option('socialGalleryLite_incTwitSRC'),'s14'=>get_option('socialGalleryLite_incFBSRC'),'s15'=>get_option('socialGalleryLite_incPinSRC'),'s16'=>get_option('socialGalleryLite_incHomeCall'),'s17'=>get_option('autoDisableNextGen'),'s18'=>get_option('socialGalleryLite_incDLLink'))); else $postData['o'] = '{"v":"'.$socialGalleryLite_version.'"}';
					} else $postData['o'] = '{"v":"'.$socialGalleryLite_version.'","no":"1"}';
					$fields = ''; foreach($postData as $key => $value) $fields .= $key . '=' . $value . '&'; rtrim($fields, '&');
					$ch = curl_init($socialGalleryLite_urls['updateCheck']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					if ($hasshared) {
						curl_setopt($ch, CURLOPT_POST, count($postData));
						curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
					}
					curl_setopt($ch, CURLOPT_TIMEOUT, 10);
					$latestVerDets = curl_exec($ch);
					curl_close($ch);
			} else 
				$latestVerDets = file_get_contents($socialGalleryLite_urls['updateCheck'].'?ori='.get_site_url()); 
			if (!empty($latestVerDets)){
			
				try { 
					
					$latestVerObj = json_decode($latestVerDets); 
					if (isset($latestVerObj->currentVer) && isset($latestVerObj->updateUrl)){
						
						if ($socialGalleryLite_version != $latestVerObj->currentVer){
							
								$updateMsg = 'A new version of Social Gallery has been released! <a href="'.$latestVerObj->updateUrl.'" target="_blank">Get version '.$latestVerObj->currentVer.'</a>'; 
								echo '<div class="updated"><p>'.$updateMsg.'</p></div>';
								update_option('socialGalleryLite_newVerFlag','<div class="updated"><p>'.$updateMsg.'</p></div>');						
							
						} else {
							delete_option('socialGalleryLite_newVerFlag');	
							
						}
						$existingMsgs = get_option('socialGalleryLite_hiddenMsgs'); if (!is_array($existingMsgs)) $existingMsgs = array(); global $socialGalleryLite_slugs;
						if (count($latestVerObj->generalMsgs) > 0) foreach ($latestVerObj->generalMsgs as $msg){
								$msgid = $msg->id; if (empty($msgid)) $msgid = 0;
								if (!in_array($msgid,$existingMsgs)){
									if ($msg->flag == -1) $class = 'error'; else $class = 'updated';
									echo '<div class="'.$class.'"><p>'.$msg->msg.' <a href="admin.php?page='.$socialGalleryLite_slugs['home'].'&hidemsg='.$msgid.'" style="float:right;margin:2px;margin-top:0;">Hide</a></p></div>';
								}
						}
						
						update_option('socialGalleryLite_lastUpCheck',time());
					}
				
				}	catch (Exception $e){		
					
				}		
				
				
			} else sgp96bf(1,"Social Gallery was unable to reach the update server to check for the latest version!");		
			
		} else {
			
			$updateMsg = get_option('socialGalleryLite_newVerFlag'); if (!empty($updateMsg)) echo $updateMsg;
			
		}
	
}


function sgpeedcf(){
    
	global $wpdb, $socialGalleryLite_db_version, $socialGalleryLite_t, $socialGalleryLite_urls, $socialGalleryLite_slugs;		
	$sgConfig = array();
	$sgConfigOptions = array(	
								'selectorType' => 1,
								'selector' => '.socialGallery',
								'bgColor' => '000000',
								'bgOpacity' => 0.8,
								'bottomBar' => 1,
								'headerBox' => 1,
								'headerBoxType' => 1,
								'headerBoxHTML' => '',
								'headerImg' => plugins_url('/i/def.jpg',__FILE__),
								'incDesc' => 1,
								'incFB' => 1,
								'incFBFaces' => 0,
								'incFBComments' => 1,
								'incFBAppID' => '',
								'backAndForth' => 1,
								'incFBSRC' => 1, 								'incHomeCall' => 1,
								'autoDisableNextGen' => 1,
								'upscaleFactor' => 1.2,
								'marginBounds' => 0.1,
								'FBAdmins' => ''
								
								);
		foreach ($sgConfigOptions as $option => $default)
		if (isset($_POST['socialGalleryLite_'.$option])) 
			$sgConfig[$option] = $_POST['socialGalleryLite_'.$option]; 
		else 
			$sgConfig[$option] = ''; 	
	
		$intAbles = array('bottomBar','headerBox','headerBoxType','incDesc','incFB','incFBComments','backAndForth');
	foreach ($intAbles as $i) if ($sgConfig[$i] == '') $sgConfig[$i] = 0; else $sgConfig[$i] = (int)$sgConfig[$i]; 
	if (!empty($sgConfig['bgColor']) && (strlen($sgConfig['bgColor']) == 6 || strlen($sgConfig['bgColor']) == 3)) $sgConfig['bgColor'] = $sgConfig['bgColor']; else $sgConfig['bgColor'] = '000000';
	if (!empty($sgConfig['bgOpacity'])) $sgConfig['bgOpacity'] = (float)$sgConfig['bgOpacity']; else $sgConfig['bgOpacity'] = 0.8;
	if (!empty($sgConfig['headerBoxHTML'])) $sgConfig['headerBoxHTML'] = esc_attr($sgConfig['headerBoxHTML']); else $sgConfig['headerBoxHTML'] = '';
	
    	update_option("socialGalleryLite_selectorType", $sgConfig['selectorType']);
	update_option("socialGalleryLite_selector", $sgConfig['selector']);
	update_option("socialGalleryLite_bgColor", $sgConfig['bgColor']);
	update_option("socialGalleryLite_bgOpacity", $sgConfig['bgOpacity']);
	update_option("socialGalleryLite_bottomBar", $sgConfig['bottomBar']);
	update_option("socialGalleryLite_headerBox", $sgConfig['headerBox']);
	update_option("socialGalleryLite_headerBoxType", $sgConfig['headerBoxType']);
	update_option("socialGalleryLite_headerBoxHTML", $sgConfig['headerBoxHTML']);
	update_option("socialGalleryLite_headerImg", $sgConfig['headerImg']);
	update_option("socialGalleryLite_incDesc", $sgConfig['incDesc']);
	update_option("socialGalleryLite_incFB", $sgConfig['incFB']);
	update_option("socialGalleryLite_incFBFaces", $sgConfig['incFBFaces']);
	update_option("socialGalleryLite_incFBSRC", $sgConfig['incFBSRC']);
	update_option("socialGalleryLite_incFBComments", $sgConfig['incFBComments']);
	update_option("socialGalleryLite_incFBAppID", $sgConfig['incFBAppID']);
	update_option("socialGalleryLite_backAndForth", $sgConfig['backAndForth']);
	update_option("socialGalleryLite_incHomeCall", $sgConfig['incHomeCall']);
	update_option("socialGalleryLite_autoDisableNextGen", $sgConfig['autoDisableNextGen']);
	update_option('socialGalleryLite_upscaleFactor', $sgConfig['upscaleFactor']);
	update_option('socialGalleryLite_marginBounds', $sgConfig['marginBounds']);
	update_option('socialGalleryLite_FBAdmins', $sgConfig['FBAdmins']);
	
	    
        global $socialGallerySavedSettingsFlag; $socialGallerySavedSettingsFlag = true; 
	
	
        sgp010f9_html();
    
}


function sgpefa1d(){}					
function sgpf64(){
	return 86400;	
}

function sgp061d431(){
	
	global $socialGalleryLite_slugs;
	
	$isOurPage = false;	
	if (isset($_GET['page'])) if (in_array($_GET['page'],$socialGalleryLite_slugs)) $isOurPage = true; 
	
	return $isOurPage;
	
}

function sgp1a7(){
	
	global $socialGalleryWizardPrompt;
		$wizardObj = get_option('socialGalleryLite_wizardObject'); if (!is_array($wizardObj)) $wizardObj = array();
	
		$stage = 0; if (isset($wizardObj['stage'])) $stage = $wizardObj['stage'];	
	if ($stage < 2) $socialGalleryWizardPrompt = true;	else $socialGalleryWizardPrompt = false;
	
}

function sgp71d262f(){
	$nextGenOps = get_option('ngg_options');
			if (is_array($nextGenOps)){
				$nextGenOps['thumbEffect'] = 'custom';
				$nextGenOps['thumbCode'] = '';
				$nextGenOps['galImgBrowser'] = 0;
				update_option('ngg_options',$nextGenOps);				
			}
}

function sgpaef2df(){

	$user_info = wp_get_current_user(); $first_name = $user_info->user_firstname; $last_name = $user_info->user_lastname;	
	$n = '';
	if (!empty($first_name)) $n = $first_name;
	if (!empty($last_name)) { if ($n != '') $n .= ' '; $n .= $last_name; }
	
	return $n;
	
}

function sgp17e4fce($m,$paddingtop=-1){
	
	?><tr><td class="sgFieldLabelHD" colspan="2"<?php if ($paddingtop > -1) echo ' style="padding-top:'.$paddingtop.'"'; ?>><?php echo $m; ?></td></tr><tr><?php

}

function sgpa033($u){
	
	try {
		if( function_exists('curl_init') ) { 
				$ch = curl_init($u);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$ret = curl_exec($ch);
				curl_close($ch);
		} else $ret = file_get_contents($u);
	} catch (Exception $e){
		$ret = false;	
	}
	return $ret;
	
}

function sgp96bf($flag,$msg,$includeExclaim=false){
	
    if ($includeExclaim){ $msg = '<div id="sgExclaim">!</div>'.$msg.''; }
    
    if ($flag == -1){
		echo '<div class="sgfail wrap sgM">'.$msg.'</div>';
	} 
	if ($flag == 0){
		echo '<div class="sgsuccess wrap sgM">'.$msg.'</div>';	
	}
	if ($flag == 1){
		echo '<div class="sgwarn wrap sgM">'.$msg.'</div>';	
	}
    if ($flag == 2){
        echo '<div class="sginfo wrap sgM">'.$msg.'</div>';
    }
}

function sgp8caf6($i){
	
	if ((int)$i > 999){
		return number_format($i);	
	} else {
		if (sgpe24($i) > 2) return round($i,2); else return $i;	
	}
	
}

function sgpe24($value)
{
	if ((int)$value == $value)
	{
		return 0;
	}
	else if (! is_numeric($value))
	{
		return false;
	}

	return strlen($value) - strrpos($value, '.') - 1;
}

} ?>