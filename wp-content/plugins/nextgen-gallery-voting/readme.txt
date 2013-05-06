=== NextGEN Gallery Voting ===
Contributors: shauno
Donate link: http://shauno.co.za/donate/
Tags: nextgen-gallery, nextgen, gallery, voting, rating, ratings, nextgen-gallery-voting
Requires at least: 2.9.1
Tested up to: 3.5.1
Stable tag: 2.4.1

This plugin adds the ability for users to vote and rate your NextGEN Galleries and Images. Simple to understand options give you the ability to limit who can vote on what.

== Description ==

This plugin adds the ability for users to vote on NextGEN Galleries and Images. A few basic options give the ability to limit who can vote on what.

NGG Voting was inspired by a request from Troy Schlegel of Schlegel Photography.  Please read the FAQ for more info on how it works.

**Please read the FAQ**, as you are required to add a tag to templates for certain functionality to work!

== Frequently Asked Questions ==

= In a nutshell, what is this? =
This plugin adds options that can allow your users to vote on (more like rate) your Galleries and Images. There are options to limit which Gallery/Image to allow voting on, if the user needs to be registered and logged in, if they can vote more that once, and if they can see the current results.

= How do I add the voting form? =
For Galleries it's easy.  You just need to enable voting on the gallery, and the voting form will automatically be appended to the gallery.  There is some basic styling, but the markup has got plenty of classes and ids that you should easily be able to hook into with your own stylesheets to make suit your site.

= How do I make the voting form appear for images? =
For images there's an extra step.  First you need to enable voing on the specific images you want.  Then you need to add a tag to the gallery template from NextGEN Gallery.  I'm going to use NextGEN version 1.9.6 to as the example, but it should be pretty much the same for all versions:
Between line 38 and line 53 in `/nextgen-gallery/view/gallery.php` is the loop that shows each image in a specific gallery.  You need to add the following tag anywhere in that loop: `<?php echo nggv_imageVoteForm($image->pid); ?>`.
That will output the vote form where you put it.  Personally I like to place it on a new line after the close `<a>` tag (new line created 45)
Do not put inside the `<a>` tag that wraps the image in some of the templates, or the link will conflict with the voting process.

= Ew, that looks hideous =
This plugin intentionally adds very little styling to the voting forms. It does provded plenty of ids and classes allowing you to style it to fit in with your site.

= Where are the results =
Under the Gallery or Image options, the current average vote show along with how many votes have been cast.  Click on the number of votes cast to show more info on those votes.

== Installation ==

1. Unzip the plugin to your `wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to 'Manage Gallery' in NextGEN, and select a gallery to see the new options
1. Remember to add the tag to the gallery template for image voting to work!

== Changelog ==

= 2.4.1 =
* Fixed a bug introduced in 2.4, stopping the 'drop down' voting type registering votes.

= 2.4 =
* Added database autoupdater if there are changes.
* Added hooks and filters for the premium add-on to use.

= 2.3.2 =
* Fixed a bug where new images weren't taking on all the default settings correctly.

= 2.3.1 =
* Fixed a table definition that was breaking completely fresh installs (thanks besso for the bug report).

= 2.3 =
* Lots of hooks and filters added for premium add-on to use.
* Added 'gallery' filter option to top voted search screen.

= 2.2.2 =
* Allowed drop down rating message to be edited in premium add-on.

= 2.2.1 =
* Changed some GET variables to work around a small bug with NGG. Voting will work with `[nggtags]` shortcode now, as well as with NGG option "The gallery will open the ImageBrowser instead the effect." on.
* Changed `get_bloginfo('url')` to `get_admin_url()` for URLs in the backend, to help with WordPress installs in sub directories.

= 2.2 =
* Changed the AJAX JavaScript to play nicely with themes running WordPress' auto formatting.
* Fixed a bunch of PHP notices.

= 2.1 =
* Rewrote voting functions to allow for better future compatibility.

= 2.0 =
* Massive rewrite, with many under-the-hood changes, but very few visible. This rewrite is to make adding features easier in the future.
* Update default options screen to use new WP styling.
* Updated gallery voting options to not need javascript to load and save.
* Changed order of voting options so star is out-the-box default (star, drop down, like/dislike).
* Fixed bug including CSS more than once on occations.
* Improved voting results in dashboard, to not always reflect out of 10.

= 1.10.1 =
* Fixed a bug that saved a vote for all galleries on the page if there was more than one (thanks oxiw for the report and Torteg for the confirmation example)

= 1.10 =
* Fixed admin viewing details of votes cast
* Made drop down voting jump down to last image voted on (simple anchor).
* Added 'Clear Votes' button to images.

= 1.9.3 =
* Added honey pot spam protection for drop down voting. Not perfect, but it's a start.

= 1.9.2 =
* Changed the HTML comments used as markers for JS output when AJAX voting to not be so similar to Apache SSIs.

= 1.9.1 =
* Fixed a bug that contiuned to show voting form even if option to not show results was selected (It didn't reveal results, just was a confusing interaction, thanks to Iced_Plum for reporting it)

= 1.9.0 =
* Added ability to allow only 1 image vote per gallery

= 1.8.2 =
* Removed 'Gallery' filter from top images report as it was buggy

= 1.8.1 =
* Made compatible with NGG 1.8.0 (Thanks to csillery for reporting the issue)

= 1.8 =
* Fixed a bug stopping votes saving if MySQL was in STRICT MODE
* Fixed a bug showing floating numbers for low rated images
* Added report to list top images

= 1.7.2 =
* Added 'Voting Type' default when creating a new gallery

= 1.7.1 =
* Fixed a bug stopping voting working when including the gallery with the [nggtags] shortcode (Thanks migf1 for finding and reporting it)

= 1.7 =
* Made 'like/dislike' and 'star' ratings use ajax to cast votes.  But it will fall back if javascripti is not enabled

= 1.6.2 =
* I screwed up the backwards compatibility, sorry.  Use 1.5 for < NGG1.7

= 1.6.1 =
* Made it backwards compatible with NGG 1.6.x and lower. Should have been done with the last update, but I was spaced on pain meds

= 1.6 =
* Made this plugin compatibile with NextGEN Galley 1.7.x and greater, which breaks compatibility with lower versions of NGG

= 1.5 =
* Added a new type of voting, the "Like / Dislike"

= 1.4 =
* Added the ability to set default voting options for new Galleries and Images

= 1.3.1 =
* Fixed a broken close label tag that caused some issues with the drop down voting (Thanks to Mae Paulino for pointing it out)

= 1.3 =
* Fixed a bug that directed users to a 404 if using star ratings with pretty URLs enabled

= 1.2 =
* Added the ability to choose to vote using 5 star rating
* Removed hook that was creating a blank admin menu item in the Wordpress backend

= 1.1 =
* Added voting to images
* Fixed bug that broke the admin layout in Internet Explorer

= 1.0 =
* Initial Release

== Upgrade Notice ==

= 2.4 =
This update fixes a bug that stopped the drop down voting type working for images

= 2.4 =
This update adds a database autoupdater, as well as many new hooks and filters for new Premium features coming soon

= 2.3.2 =
Fixes a bug where new images weren't taking on all the default settings correctly.

= 2.3.1 =
Fixed a bug that stopped fresh installs from builing the tables correctly.

= 2.3 =
Updates required for NextGEN Gallery Voting Premium 1.2 to run.

= 2.2.1 =
This update fixes a small conflict that stopped voting working with the [nggtags] shortcode, or if "The gallery will open the ImageBrowser instead the effect" option is on.

= 2.2 =
This update makes AJAX voting play nicely with themes that use WordPress' auto formatting.

= 2.1 =
Updates to voting engine for future compatibility.

= 2.0 =
Version 2.0 is a big restructure of the plugin. If you have made customizations or are calling APIs externally, please test thoroughly before updating your live site!

