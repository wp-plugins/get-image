=== Get Image ===
Contributors: dgmike
Donate link: http://dgmike.wordpress.com
Tags: image, thumbnail, fullzise
Requires at least: 2.5
Tested up to: 2.5
Stable tag: 0.2

Take the last image daughter of a post on the selected size.

== Description ==

Take the last image daughter of a post. To use this plugin you just need to insert one of 
the following commands in your template:

- gi_fullsize ();
- gi_medium ();
- gi_thumbnail ();

Adding a parameter, it becames in the tag img generated. By default, the plugin will return 
a string containing the tag of the image, but you can pass the second parameter to true to 
make the impression of this string. 

== Installation ==

1. Upload `getimage.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php gi_fullsize ('plugin_name_hook'); ?>` in your templates