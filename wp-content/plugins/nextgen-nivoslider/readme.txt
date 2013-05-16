=== NextGen NivoSlider ===
Contributors: paperfeed
Donate link: http://www.redcross.org.nz/donate
Tags: image, picture, photo, widgets, gallery, images, nextgen-gallery, jquery, nivo-slider, nivo, slider, javascript
Requires at least: 2.8
Tested up to: 3.5.1
Stable tag: 3.2.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The NextGen Nivoslider plugin allows you to create a NivoSlider, using images from your NextGen gallery, with a simple shortcode or widget.

== Description ==

NextGen NivoSlider allows you to create a [NivoSlider](http://nivo.dev7studios.com/) as a widget or with a shortcode.
This plugin uses the 'NextGen Gallery' plugin to obtain the images using tags or gallery IDs.

NivoSlider is a great responsive image slideshow that is highly customizable. With a large array of effects and many additional options you are sure to find a combination that will suit your website.



**Requirements:**

- [NextGen Gallery Plugin](http://wordpress.org/extend/plugins/nextgen-gallery/)


**Features:**

NextGen NivoSlider has been completely overhauled and is continually being added to. It currently supports all the of NivoSlider's original functions and even has some extra's!

* Responsive!
* Fully integrated with NextGen gallery
* Theme support
* Automatic URL linking (put a mailto:, http://, ftp:// or local / into your alt text)
* Extra effect(s)
* Shortcode and Widget support
* Touchscreen support (experimental)


**Parameters:**

You can use the following parameters in the [ngg-nivoslider] shortcode.
Defaults, where applicable, are shown between parentheses (), available options between brackets [].

- title: Title for slider. Leave blank for no title. (ex: title="My Slider")
- gallery: Leave blank to use all galleries or choose a gallery to use. (ex: gallery="galleryid")
- order [random"|"asc"|"desc"|"sortorder"]: Order to display results in. You can choose; Random, Latest First, Oldest First, or NextGen Sortorder. Random will still work when a page is cached. (ex: order="random"|"asc"|"desc"|"sortorder")
- tags: comma separated list of tags to filter results by. (ex: tags="tag1, tag2")
- shuffle ["true"|"false"]: If order is random and this is true will shuffle images with javascript. Useful if your are caching your pages. (ex: shuffle="true"|"false")
- max_pictures: The maximum amount of pictures to load. (ex: max_pictures="6")
- html_id ("slider"): HTML id to use. Defaults to 'slider'. Needs to be different for multiple sliders on same page. (ex: html_id="slider")
- width: Width to use on slider. (ex: width="200")
- height: Height to use on slider. (ex: height="150")
- center: Centers content in container. Requires width to be set. (ex: center="1")
- resize: Resizes the images using TimThumb(v2). Available options are: (ex: resize="3")
          1 - Resize to Fit specified dimensions (no cropping) 	
          2 - Crop and resize to best fit the dimensions (default)
          3 - Resize proportionally to fit entire image into specified dimensions, and add borders if required
          4 - Resize proportionally adjusting size of scaled image so there are no borders gaps
- resizewidth: The width TimThumb will use to resize the image (sc: resizewidth="800")
- resizeheight: The height TimThumb will use to resize the image (sc: resizeheight="600")
- resizebg ("ffffff"): The color (denoted in hex) to use for the borders that are generated when using resizing option 3 (ex: resizebg="a0fb69")
- caption ["alttext"|"description"|"both"]: Show a caption with the slide, showing either the alttext or description as set up in NextGen gallery or both as "Bolded AltText - Description"
- htmlcaption: HTML formatted caption to show on all images (ex: htmlcaption="<strong>Title</strong> Welcome to <a src='http:/google.com'>this website</a>")



**Nivo slider settings:**

Please check the NivoSlider website for [more details](http://nivo.dev7studios.com/#usage).

- effect: What effect to use as transition. You can specify sets like: 'fold,fade,sliceDown'. See list below for available effects.(ex: effect="sliceDown,sliceUp")
- slices: The amount of slices to divide the image to for the slice effects(ex: slices="3")
- boxCols: Amount of columns to split the image into for the box effects (ex: boxcols="10")
- boxRows: Amount of row to split the image into for the box effects (ex: boxrows="8")
- animSpeed: Slide transition speed in milliseconds (1000ms = 1 second). (ex: animspeed="300")
- pauseTime: Time to pause in milliseconds (1000ms = 1 second) before continueing to the next image (ex: pausetime="5000")
- startSlide: Set starting Slide. It's 0-index so use 0 for the first slide. (ex: startslide="3")
- directionNav ["true"|"false"]: Whether to display the Next & Prev controls or not. (ex: directionnav="true")
- controlNav ["true"|"false"]: 1,2,3... (ex: controlnav="setting")
- controlNavThumbs ["true"|"false"]: Use thumbnails for Control Nav if set to true. (ex: controlnavthumbs="true")
- thumbsWidth: Resize thumbnail to this width. Recommended to set if using thumbnails. (ex: thumbswidth="20")
- thumbsHeight: Resize thumbnail to this height. Recommended to set if using thumbnails. (ex: thumbsheight="20")
- thumbsContainerHeight: Height for thumbnails container. Calculation should be 'number of thumbnail image rows' x 'thumbsheight'. (ex: thumbscontainerheight="20")
- thumbsGap: Gap between thumbnails. (ex: thumbsgap="5")
- controlNavThumbsFromRel: Use image rel for thumbs. (ex: controlnavthumbsfromrel="setting")
- controlNavThumbsSearch: Replace this with... (ex: controlnavthumbssearch="setting")
- controlNavThumbsReplace: ...this in thumb Image src. (ex: controlnavthumbsreplace="setting")
- keyboardNav: Use left & right arrows. (ex: keyboardnav="setting")
- pauseOnHover: Stop animation while hovering. (ex: pauseonhover="setting")
- manualAdvance: Force manual transitions. (ex: manualadvance="setting")
- prexText: Text to display for previous (ex: prevtext="prev")
- nextText: Text to display for next (ex: prevtext="next")
- randomStart ["true"|"false"]: Start with a random slide (ex: randomstart="true")
- captionOpacity: Universal caption opacity. (ex: captionopacity="setting")
- disableCaptions: (ex: disablecaptions="1")
- beforeChange: (ex: beforechange="setting")
- afterChange: (ex: afterchange="setting")
- slideshowEnd: Triggers after all slides have been shown. (ex: slideshowend="setting")
- lastSlide: Triggers when last slide is shown. (ex: lastslide="setting")
- afterLoad: Triggers when slider has loaded. (ex: afterload="setting")



**Nivo Effects:**

- random
- sliceDown
- sliceDownLeft
- sliceUp
- sliceUpLeft
- sliceUpDown
- sliceUpDownLeft
- fold
- foldReverse
- fade
- slideInRight
- slideInLeft
- boxRandom
- boxRain
- boxRainReverse
- boxRainGrow
- boxRainGrowReverse



**Shortcode examples:**

- [ngg-nivoslider html_id="about-slider"]
- [ngg-nivoslider title="Hello" gallery="1" html_id="about-slider" width="200" height="150" center="1"]
- [ngg-nivoslider html_id="about-slider" directionnav="false" controlnav="false"]
- [ngg-nivoslider tags=slideshow order="random" effect="fade" shuffle="true" max_pictures="12" html_id="slider" resizebg="fdfdfd" resizewidth="900" resizeheight="620" resize="3" center="1" directionNav="false" controlNav="false" pauseTime="10000" animSpeed="1000" pauseOnHover="false"]

== Installation ==

**Important: You need to have NextGen Gallery installed for this to work!**

**Installation through Wordpress Dashboard:**
1. Find the plugin by searching for "NextGen NivoSlider" and click install. That's it!

**Manual installation:**
1. Copy the entire directory from the downloaded zip file into the /wp-content/plugins/ folder.
2. Activate the "NextGen NivoSlider" plugin in the Plugin Management page.
3. Refer to the description to use the plugin as a widget and or a shortcode.

== Frequently Asked Questions ==

= What is the Nextgen NivoSlider plugin? =
It’s a plugin that allows you to use a NivoSlider in WordPress by using a shortcode. It allows you to populate the NivoSlider with images pulled from your NextGen Gallery by gallery ID, image tags or simply everything!

= The resizing options are not working, why? =
You may need to give TimThumb's cache folder permissions by using CHMOD 775.

= How come the effects aren't working? =
In order for the effects to work the max-width of ".nivoSlider img" needs to be none. By default this will be set as !important, however it might be that you altered the CSS and that another stylesheet is overriding the style.

== Screenshots ==

1. The NextGen NivoSlider widget configuration panel

== Changelog ==
= 3.2.5 =
* Fixed: Widget should be working again
* Fixed: Default widget settings no longer resize the images
* Fixed: Removed several deprecated settings
* Fixed: 
* Changed: Widget configuration, immensely cleaned up code


= 3.2.4 =
* Fixed: Some effects not working for some people (Make sure that .nivoSlider img has a max-width of none, or effects won't work)
* Changed: If a URL is not found in alt text, it will now also check description (note: the URLs still need to be at the beginning in either field)
* Changed: Majorly overhauled the plugin
* Changed: Wrapped everything in classes (OOP)
* Added: Touchscreen support (untested)
* Added: Will now also check for 'mailto:' (besides /, html:// and ftp://)
* Added: Admin menu (Gallery -> Nivo Slider)
* Added: Theme support. You can pick your Nivo Slider theme from the new admin menu
* Added: HTML Captioning
* Added: New effect 'foldReverse'

= 3.2.3 =
* Fixed: Trying to wp_register jquery with only one argument (don't need to register it at all)
* Fixed: Trying to use variables that didn't exist
* Added: Caption options to widget

= 3.2.2 =
* Added: More options to the widget configuration panel (resizing, background color selection, width and height)
* Added: randomStart, prevText and nextText options to NivoSlider settings
* Added: caption ["alttext"|"description"|"both"]
* Changed: The script is now only loaded when necessary (eg. when the shortcode/widget has been used on the page)
* Changed: Cleaned up code
* Fixed: Thumbnail navigation now works correctly


= 3.2.1 =
* First release. 
* I will keep the first two version numbers equal to the version of the NivoSlider built in. The version of the plugin itself will be shown in the last number(s).
* Please report any bugs!

== Upgrade Notice ==

Note that I am the only one to have tested this version. It works fine for me so far, but as always, be aware that there might be bugs. If you encounter them let me know and I WILL fix them.


== To do ==

Feel free to suggest new features or things you'd like to see in this plugin!

* Create some extra themes.
* Scrollable thumbnails?