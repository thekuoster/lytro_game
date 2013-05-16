=== Responsive NextGEN Flex Slider Template ===
Contributors: mohsinrasool
Donate link: http://mohsinrasool.wordpress.com/2012/12/21/nextgen-flex-slider-template/
Tags: nextgen, gallery, slider, slideshow, nextgen-gallery, nextgen template, responsive slider, responsive nextgen slider, flexslider, nextgen slider, image slider, content slider, nextgen image slider, nextgen content slider, featured slider, nextgen featured slider
Requires at least: 3.0.1
Tested up to: 3.5
Stable tag: 1.7
Author: Mohsin Rasool
License: GPLv2

Adds "sliderview" template for the NextGen gallery. Use the shortcode [nggallery id=x template="sliderview"]

== Description ==

This plugin adds "sliderview" template for the NextGen gallery. Use the shortcode [nggallery id=x template="sliderview"] to display images as the slider. You can visit Settings -> NextGen Slider to select theme, toggle between image and content slider and change width of the image or content area.

If you are not sure how to set up this slider please read our tutorial on [creating and using gallery templates](http://wpdevsnippets.com/create-nextgen-gallery-and-templates/ "Create and Use NextGen Gallery Templates")

[Documentation](http://wpdevsnippets.com/nextgen-flex-image-content-slider-template/ "NextGen Responsive Flex Slider Documentation") | [Support](http://wordpress.org/support/plugin/nextgen-flex-slider-template "NextGen Flex Slider Support")

Note: It requires NextGen Gallery plugin that can be downloaded from http://wordpress.org/extend/plugins/nextgen-gallery.

= Attributes =
These will work only when shortcode is used on post/page contents.

    theme: 
    (string) (optional) Theme of the slider
    Possible Values: 'black', 'blue' or 'grey'

    display_content: 
    (boolean) (optional) Toggle between content and image slider. 
    Possible Values: 0 or 1

    order: 
    (string) (optional) Select order of the images. 
    Possible Values: empty or "random"

    slideshow_speed: 
    (numeric) (optional) Delay in animation 
    Possible Values: Any numeric value

    direction_nav: 
    (boolean) (optional) Enable or disable next/prev navigation arrows
    Possible Values: 0 or 1

    pagination: 
    (boolean) (optional) Enable or disable pagination bullets at bottom
    Possible Values: 0 or 1

    image_width: 
    (string) (optional) Set width of the images
    Possible Values: 100px or 100% or 80% etc

    text_width: 
    (string) (optional) Set width of the content area (in case of content slider)
    Possible Values: 100px or 20% etc

    link_title: 
    (boolean) (optional) Enable or disable whether title should be linked or not (for content slider). Please follow [this tutorial](http://wpdevsnippets/linking-image-and-title-nextgen-flex-slider-template "Linking Flex Sliders") to set it up
    Possible Values: 0 or 1

    link_image: 
    (boolean) (optional) Enable or disable whether image should be linked or not. Please follow [this tutorial](http://wpdevsnippets/linking-image-and-title-nextgen-flex-slider-template "Linking Flex Sliders") to set it up
    Possible Values: 0 or 1

    link_new_window: 
    (boolean) (optional) Enable to open slider url to be opened in a new window. Please follow [this tutorial](http://wpdevsnippets/linking-image-and-title-nextgen-flex-slider-template "Linking Flex Sliders") to set it up
    Possible Values: 0 or 1

    background: 
    (string) (optional) Set background color of the slider 
    Possible Values: Any valid HTML Code. #fff or #23423f or white or black 

    use_width_for_img_slider: 
    (boolean) (optional) To use the specifed img_width for image slider too.
    Possible Values: 0 or 1

    disable_img_stretching: 
    (boolean) (optional) Images in image slider are set to 100% width which may cause stretch for small or portrait size images. Please enable this option to fix it.
    Possible Values: 0 or 1

== Usage ==

[nggallery id=x template="sliderview" direction_nav="0"]

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `nextgen-flex-slider-template` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. You can now use "sliderview" template in nggallery shortcode.

== Frequently Asked Questions ==

= What is NextGen gallery? =

NextGEN Gallery is the most popular photo gallery plugin for WordPress. It provides a powerful engine for uploading and managing galleries of images, with the ability to batch upload, import meta data, add/delete/rearrange/sort images, edit thumbnails, group galleries into albums, and more.

= Does it work without NextGen gallery? =

No, It is solely developed for the NextGen gallery and does not work without it.

= Where I can download NextGen gallery? =

You can download NextGen gallery either from their official website http://www.nextgen-gallery.com or from WordPress plugin repositry http://wordpress.org/extend/plugins/nextgen-gallery.

= How can use text and title beside the image? =

You would use the photo description and the title text to populate the right side of the slider. Go to WP Admin -> Gallery -> Manage Gallery -> Click on Gallery Title.

= Can I place links or achor tags in the description? =

Yes, you can. You can not only place links but also can use any HTML tag in the description. But, make sure you HTML is properly formatted. An unclosed tag or quotes may mess up your page.

= Is it a content slider or an image slider? =

Both, You can configure it to be either a content slider or an image only slider.

= How to add the images in slider? =

Please check out our tutorial on how to use [NextGen Gallery Templates](http://wpdevsnippets.com/create-nextgen-gallery-and-templates/ "NextGen Gallery Templates") and set up slider for it.

= Where is the slider documentation? =

Please click here to visit the [documentation](http://wpdevsnippets.com/nextgen-flex-image-content-slider-template/ "NextGen Responsive Flex Slider Documentation").

== Screenshots ==

1. Content Slider
2. Image Slider
3. Slider Settings in Administration Panel
4. Populating Content for images

== Changelog ==

= 1.7 =
* Added feature to link the images and titles
* Fixed open_short_tag bug

= 1.6 =
* Allow multiple slider with different options on the same page or different pages
* Centering the portrait images
* Added option to change the background

= 1.5 =
* Fixed a critical bug of breaking words in content slider

= 1.4 =
* Added Grey Theme
* Check to apply width for image slider

= 1.3 =
* Feature of randomization of slides
* Feature of setting delay between transitions
* Feature of reverse slides
* Feature of setting bullet or no pagination navigation
* Feature of toggling next/prev slide navigation

= 1.2 =
* Fixed blank screen bug

= 1.1 =
* Added Configuration page where user can configure slider options.

= 1.0.1 =
* Fixed static title problem.

= 1.0 =
* First Revision

== Upgrade Notice ==

= 1.7 =
* Added feature to link the images and titles
* Fixed open_short_tag bug

= 1.6 =
* Allow multiple slider with different options on the same page or different pages
* Centering the portrait images
* Added option to change the background

= 1.5 =
* Fixed a critical bug of breaking words in content slider

= 1.4 =
* Added Grey Theme
* Check to apply width for image slider

= 1.3 =
* Added Feature of slide's randomisation and delay. Toggling of Nex/Prev and Pagination Navigation

= 1.2 =
* Fixes blank screen bug when activated. It may also conflict with another plugin.