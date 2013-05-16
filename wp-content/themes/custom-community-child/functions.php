<?php
	add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
 
	function add_login_logout_link($items, $args) {
 
        	if ( $args->theme_location == 'primary' ) {       
 
 		ob_start();

        	wp_loginout('index.php');
 
        	$loginoutlink = ob_get_contents();
 
        	ob_end_clean();
 
        	$items .= '<li>'. $loginoutlink .'</li>';
    	}
 
    	return $items;
 
	}

	add_filter('upload_mimes', 'custom_upload_mimes');
	function custom_upload_mimes ( $existing_mimes=array() ){	
		$existing_mimes['unity3d'] = 'application/vnd.unity';
		return $existing_mimes;
	}
	
	function modify_post_mime_types($post_mime_types){
		//define an array with the label values
		$post_mime_types['application/vnd.unity'] = array(__( 'Games' ), __( 'Manage games' ), _n_noop( 'Games (%s)', 'Games (%s)') );
		// return the $post_mime_types variable
		return $post_mime_types;
	}

	add_filter('post_mime_types', 'modify_post_mime_types' );
?>	
