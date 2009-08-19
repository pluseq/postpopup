=== PostPopup ===
Contributors: pluseq
Tags: popup
Requires at least: 2.0.2
Tested up to: 2.8
Stable tag: trunk

Shows posts as Javascript popup windows using jquery dialog

== Description ==


Postpopup is a wordpress plugin allowing to create popup-windows (jquery dialog based) on your WP 
pages/post, while each popup is a separate post referred by name (slug) or id.

Say you have a post with slugs "hello" and "my-popup", and inside of "hello"-post you want you 
need to have a link which pops up a new JS windows with the content of "my-popup" post. 
All you have to do is just to put the following address as a URL somewhere in the "hello": 
popup://my-popup, so that in HTML it will look like:

   <a href="popup://my-popup">Click here to see popup</a>

== Installation ==

Of course you don't usually want to have the popup-posts to be displayed as posts in the homepage loop. 
To avoid it I recommend you to:

   1. install the advanced category excluder plugin – you'll see two plugins appear – activate both of them
      see http://wordpress.org/extend/plugins/advanced-category-excluder/
   1. create a category "Popup" (or any other name)
   1. create at least one popup post with this category
   1. exclude the category in ACE/Categories for the homepage,
   1. check **want the categories selected for Home section, to be hidden from category list as well** in main ACE settings
   1. use ACE Categoris widget instead of the standard one

== Frequently Asked Questions ==

== Changelog ==

= 1.0.2 =
* initial version of the plugin
