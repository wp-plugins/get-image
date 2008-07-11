=== Get Image ===
Contributors: dgmike
Donate link: http://dgmike.wordpress.com
Tags: image, thumbnail, fullzise
Requires at least: 2.5
Tested up to: 2.5
Stable tag: 0.5

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

= Upgradeg in version 0.5 =

Now you have a `gi_library ()` function. It returns all images from yout post - not only the
last daughter, where you can pass some parameters like size and type of return you wants.

The sizes of `gi_library ()` are: 'all', 'fullsize', 'medium', 'thumbnail'

== Installation ==

1. Upload `getimage.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php gi_fullsize (); ?>` in your templates
2. You can place `<?php gi_library ('thumbnail'); ?>`

= Using gi_library =

It returns all images from yout post - not only the last daughter, where you can pass some
parameters like size and type of return you wants. Sintax:

`gi_library ($size, $extra, $print, $return_as)`

1. The `size`s of `gi_library ()` are: 'all', 'fullsize', 'medium', 'thumbnail'. Default: 'thumbnail'
1. The `extra` is an extra string that you wants to put in your image tag. Default: ''
1. The `print` is used if the `return_as` is `string`. It prints the string genered. Default: true
1. The `return_as` is the return that you wants. Here is the powerfull way to manipulate your results. The `result_as` can be: 'string', 'array', 'brute_array'
