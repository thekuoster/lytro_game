<?php 
/**
Slider integration

Follow variables are useable :

	$gallery     : Contain all about the gallery
	$images      : Contain all images, path, title
	$pagination  : Contain the pagination content

 You can check the content when you insert the tag <?php var_dump($variable) ?>
 If you would like to show the timestamp of the image ,you can use <?php echo $exif['created_timestamp'] ?>
**/

?>
<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?><?php if (!empty ($gallery)) : ?>
<?php

    //  Parse the attributes
    $defaults = array (
        'ng_slider_theme' => get_option('ng_slider_theme'),
        'ng_slider_display_content' => get_option('ng_slider_display_content'),
        'ng_slider_order' => get_option('ng_slider_order'),
        'ng_slider_slideshow_speed' => get_option('ng_slider_slideshow_speed'),
        'ng_slider_direction_nav' => get_option('ng_slider_direction_nav'),
        'ng_slider_pagination' => get_option('ng_slider_pagination'),
        'ng_slider_image_width' => get_option('ng_slider_image_width'),
        'ng_slider_background' => get_option('ng_slider_background'),
        'ng_slider_text_width' => get_option('ng_slider_text_width'),
        'ng_slider_use_width_for_img_slider' => get_option('ng_slider_use_width_for_img_slider'),
        'ng_slider_disable_img_stretching' => get_option('ng_slider_disable_img_stretching'),
        'ng_slider_link_title' => get_option('ng_slider_link_title'),
        'ng_slider_link_image' => get_option('ng_slider_link_image'),
        'ng_slider_link_new_window' => get_option('ng_slider_link_new_window')
    );
    

    $ng_slider_theme_names = array('black','blue','grey');
        
    global $post;
    $regex_pattern = get_shortcode_regex();
    
    preg_match_all ('/'.$regex_pattern.'/s', $post->post_content, $regex_matches);

    foreach ($regex_matches[2] as $sc_num => $value) {
        $attribureStr = (shortcode_parse_atts(trim ($regex_matches[3][$sc_num])));
        if($value == 'nggallery' && $attribureStr['id']== $gallery->ID) {

            //  Found a NextGEN gallery find out what ID
            //  Turn the attributes into a URL parm string

            //if($attribureStr == $gallery)
            $sc_defaults = array();
            foreach ($defaults as $key => $value) {
                $key2 = str_replace('ng_slider_', '', $key );
                $sc_defaults[$key2] = $value;
            }
            $attributes = wp_parse_args($attribureStr, $sc_defaults);
            //print_r($attributes);

            foreach(array_keys($defaults) as $att ){
                $att = str_replace('ng_slider_', '', $att );
                if (isset($attributes[$att])) {
                    $defaults['ng_slider_'.$att] = $attributes[$att];
                }
            }
        }
    }

    extract($defaults);

    if(is_numeric($ng_slider_theme))
        $ng_slider_theme = $ng_slider_theme_names[$ng_slider_theme];
    
    $display_content = $ng_slider_display_content ? true: false ;
    if($ng_slider_order == 'reverse')
        $images = array_reverse($images);
?>
<div id="<?php echo $gallery->anchor ?>" class="flexslider <?php echo $ng_slider_theme?>">
   <ul class="slides">
  	<!-- Thumbnails -->
	<?php foreach ($images as $image) : ?>
	<li class="<?php if(!$display_content) echo 'full-width';?>">
            <div class="feature-image "> 
                <?php if(!empty($image->ngg_custom_fields['image_link']) && $ng_slider_link_image) { ?>
                    <a href="<?php echo $image->ngg_custom_fields['image_link'] ?>" <?php echo $ng_slider_link_new_window ? 'target="_blank"':'' ?> ><img class="full home_feature" src="<?php echo $image->imageURL ?>" alt="<?php echo $image->alttext ?>" title="<?php echo $image->alttext ?>"></a>
                <?php }else{ ?>
                    <img class="full home_feature" src="<?php echo $image->imageURL ?>" alt="<?php echo $image->alttext ?>" title="<?php echo $image->alttext ?>">
                <?php } ?>
                    
            </div>
            <?php if($display_content) {?>
            <div class="flex-caption">
                <?php if(!empty($image->ngg_custom_fields['image_link']) && $ng_slider_link_title) { ?>
                    <a href="<?php echo $image->ngg_custom_fields['image_link'] ?>" <?php echo $ng_slider_link_new_window ? 'target="_blank"':'' ?> ><h2 class="post-title"><?php echo ($image->alttext) ?></h2></a>
                <?php }else{ ?>
                    <h2 class="post-title"><?php echo ($image->alttext) ?></h2>
                <?php } ?>
                <p><?php echo html_entity_decode($image->description) ?></p>
            </div>
            <?php } ?>
	</li>
 	<?php endforeach; ?>
  </ul>
</div>


<script type="text/javascript" defer="defer">
    jQuery(document).ready(function($) {
      $('#<?php echo $gallery->anchor ?>').flexslider({
        <?php echo "slideshowSpeed: ".($ng_slider_slideshow_speed ? $ng_slider_slideshow_speed*1000: 6000).","?>
        <?php //echo "direction: '".(get_option('ng_slider_direction') ? get_option('ng_slider_direction'): 'horizontal')."',"?>
        <?php if($ng_slider_order == 'random')
                echo 'randomize:true,';
           
        ?>
        <?php echo "directionNav: ".($ng_slider_direction_nav ? 'true': 'false').","?>
        <?php echo "controlNav: ".($ng_slider_pagination ? 'true': 'false').","?>
        <?php //echo "animation: '".(get_option('ng_slider_animation') ? get_option('ng_slider_animation'): 'fade')."',"?>
        pauseOnHover:true
  });
    });	
</script>
<style>
    <?php
    $img_width = $ng_slider_image_width;
    $bg_color = $ng_slider_background;
    if(is_numeric($img_width) && !empty($img_width))
        $img_width = $img_width.'px';
    
    if($display_content){
        
        $txt_width = $ng_slider_text_width;
        if(is_numeric((int) $img_width) && ((int) $img_width)>1)
            echo '#'. $gallery->anchor .' .feature-image {width:'.$img_width.' !important;}';
        if(is_numeric((int) $txt_width) && ((int) $txt_width)>1)
            echo '#'. $gallery->anchor .' .flex-caption {width:'.$txt_width.' !important;}';
    }
    else {
        if($ng_slider_use_width_for_img_slider )
            echo '#'. $gallery->anchor .' {width:'.$img_width.' !important;}';
        if($ng_slider_disable_img_stretching)
            echo '#'. $gallery->anchor .' .feature-image img {display:inline; width:auto !important}';
    }
    if(!empty($bg_color)) {
        echo '#'. $gallery->anchor .' {background-color:'.$bg_color.' !important; box-shadow:none !important;}';
        echo '#'. $gallery->anchor .' .slides {background-color:'.$bg_color.' !important;}';
    }
    ?>
    
</style>

<?php endif; ?>