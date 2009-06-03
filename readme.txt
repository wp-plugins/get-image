=== Get Image ===
Contributors: dgmike
Donate link: http://dgmike.com.br
Tags: image, thumbnail, fullzise, get-image, images, galery
Requires at least: 2.6
Tested up to: 2.7.1
Stable tag: 1.0

Take the last image daughter of a post on the selected size.

== Description ==

Note: This version only works on Wordpress 2.6. If you wants to use on wordpress 2.5, please get
the version 0.5 on download repository.

Take the last image daughter of a post. To use this plugin you just need to insert one of
the following commands in your template:

- `gi_fullsize ();`
- `gi_medium ();`
- `gi_thumbnail ();`

Adding a parameter, it becames in the tag img generated. By default, the plugin will return
a string containing the tag of the image, but you can pass the second parameter to true to
make the impression of this string.

= Updated in version 0.5 =

Now you have a `gi_library ()` function. It returns all images from yout post - not only the
last daughter, where you can pass some parameters like size and type of return you wants.

The sizes of `gi_library ()` are: 'all', 'fullsize', 'medium', 'thumbnail'

= Upgraded in version 0.8 =

# Added shortcuts for `gi_thumb ()` and `gi_full()`.
# Upgraded for wordpress 2.6
# Added width and height in `gi_library`.
# Using the native `wp_get_attachment_image ()` function.

= Upgraded in version 0.9 =

Now, `gi_fullsize()`, `gi_full()`, `gi_medium()`, `gi_thumbnail()` and `gi_thumb()` recives two parameters.

The first is $print, this param prints the return, use it to shorcur yours call. So, if you wants
to print do not use:

`<?php echo gi_full(); ?>`

But use:

`<?php gi_full(1); ?>`

The second param says the number of image you want to use. This number is the number of image in
galery order. The next code prints the third image in galery on format thumbnail.

`<?php gi_thumb(true, 3); ?>`

The function `gi_library()` have shortcuts for thumb and full sizes. Now you can use
`gi_library('thumb')` or `gi_library('full')` in your templates/scripts.

== Upgrated in version 1.0 ==

Now the function `gi_library()` on mode `brute_array` returns the `post_ID`, `title`, `caption` and `description`
from the image.

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
