<?php

session_start(); 

/*
Plugin Name: WP_UnityObject3
Description: A plugin that provides the ability to add Unity 3.0 Web Player content to your WordPress blog posts (modified from the official Unity plugin).
Version: 0.1
Author: Adam Zwakenberg
Author URI: http://www.adamzwakk.com

*/

function WP_ParseEntry ($aEntry) {
	// Find/replace all UnityObject tags in the entry
	$tPattern = "/(\[WP_UnityObject.*\/\])/";
	$tNewEntry = preg_replace_callback($tPattern,"WP_WriteTags",$aEntry);
	// Return the new entry string
	return $tNewEntry;

}

function WP_WriteTags ($aMatchArray) {				
	$tUOString = $aMatchArray[0];
	$tUOString = str_replace("[WP_UnityObject", "", $tUOString);
	$tUOString = str_replace("/]", "", $tUOString);
	$tUOString = trim($tUOString);
	$tUOParams = split(" ", $tUOString);

	$returnMe = '<script type="text/javascript" src="http://webplayer.unity3d.com/download_webplayer-3.x/3.0/uo/UnityObject.js"></script>
		<script type="text/javascript">
			function GetUnity() {
				if(typeof unityObject != "undefined"){
					return unityObject.getObjectById("unityPlayer");
				}
				return null;
			}
			if(typeof unityObject != "undefined"){
				unityObject.embedUnity("unityPlayer", "'.substr($tUOParams[0],5,-1).'", '.substr($tUOParams[1],7,-1).', '.substr($tUOParams[1],7,-1).');
			}
		</script>';
		
	$returnMe .= '<div id="unityPlayer">
				<div class="missing">
					<a href="http://unity3d.com/webplayer/" title="Unity Web Player. Install now!">
						<img alt="Unity Web Player. Install now!" src="http://webplayer.unity3d.com/installation/getunity.png" width="193" height="63" />
					</a>
				</div>
			</div>';
	return preg_replace('/<p>(\s*)(<script .* \/>)(\s*)<\/p>/iU', '\2', $returnMe);
}

// Enable a filter to find/replace each UnityObject block
add_filter("the_content", "WP_ParseEntry", 1, 1);
?>