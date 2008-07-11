<?php
/*
    Plugin Name: getImage
    Description: Pega a última imagem filha de um post. Para usar este plugin basta você inserir um dos seguintes comandos no seu template: <strong>gi_fullsize(); gi_medium(); gi_thumbnail();</strong> Adicionando um parâmetro, ele vai parar dentro da tag de imagem gerada. Por padrão, o plugin retornará uma string contendo a tag da imagem gerada, mas você pode passar o segundo parametro como true para pedir que ele faça a impressão desta string."
    Version: 0.5
    Author: DGmike
    Author URI: http://dgmike.wordpress.com
 */

/**
 * Pega o primeiro arquivo que foi feito o upload filho (relacionado) deste post
 *
 * @param object $post Post global gerado pelo the_post()
 * @return object Primeiro anexo (imagem) do post
 */
function gi_file ($all = false){
  global $post;
  $images = array ();
  if ($itens = get_children($post->ID))
    foreach ($itens as $item)
      # Versão antiga de como pegar um arquivo de imagem (pela extensão)
      # A função anterior usava expressões regulares, o que diminui o
      # desempenho do PHP.
      #
      # preg_match ('/\.(jpg|jpeg|png|gif|bmp)$/', $item->guid)
      #
      # Nova versão: pelo mime
      if (false !== strpos($item->post_mime_type, 'image'))
        $images[] = $item;
  return $all ? $images : reset($images);
}

/**
 * Get a library of images from a post
 *
 * @param string $size Choose: all, fullsize, medium, thumbnail
 * @param string $extra Extra for your img tag
 * @param bool $print Do you want to print (only used if yout $return_as are 'string')
 * @param string $return_as Choose: array, brute_array, string
 * @return string|array
 */

function gi_library ($size = 'thumbnail', $extra = '', $print = false, $return_as = 'string') {
  $images = gi_file(true);
  $imgs = array();
  foreach ($images as $image)
  	$imgs[] = gi_image($image, 'all');
  $images = array();
  foreach ($imgs as $img) {
    if ($size == 'all') $images[] = $img;
  	else $images[] = array ('title' => $img['title'], $size => $img[$size]);
  }
  if ($return_as == 'brute_array') return $images;
  $imgs = array();
  foreach ($images as $image) {
  	if (in_array($size, array('fullsize', 'medium', 'thumbnail'))) $imgs[] = sprintf('<img src="%s" title="%s" %s  />', $image[$size], $image['title'], $extra);
  	if ($size == 'all') {
  	  $imgs[] = sprintf('<img src="%s" title="%s" %s  />', $image['fullsize'], $image['title'], $extra);
  	  $imgs[] = sprintf('<img src="%s" title="%s" %s  />', $image['medium'], $image['title'], $extra);
  	  $imgs[] = sprintf('<img src="%s" title="%s" %s  />', $image['thumbnail'], $image['title'], $extra);
  	}
  }
  if ($return_as == 'array') return $imgs;
  $imgs = implode("\n", $imgs);
  if ($return_as == 'string') {
    if ($print) print $imgs;
    return $imgs;
  }
}


function gi_fullsize($extra = '', $print = false) {
  $image = gi_file ();
  if ($url = gi_image($image,'fullsize')) {
    $return = sprintf('<img src="%s" title="%s" %s  />', $url, $image->post_title, $extra);
    if ($print) print $return;
    else return $return;
  }
}
function gi_medium($extra = '', $print = false) {
  $image = gi_file ();
  if ($url = gi_image($image,'medium')) {
    $return = sprintf('<img src="%s" title="%s" %s  />', $url, $image->post_title, $extra);
    if ($print) print $return;
    else return $return;
  }
}
function gi_thumbnail($extra = '', $print = false) {
  $image = gi_file ();
  if ($url = gi_image($image,'thumbnail')) {
    $return = sprintf('<img src="%s" title="%s" %s  />', $url, $image->post_title, $extra);
    if ($print) print $return;
    else return $return;
  }
}

function gi_image($image, $size) {
  if (!$image) $image = gi_file();
  if (!$image || array_key_exists($size, array ('fullsize', 'medium', 'thumbnail') ) ) return;

  $meta = wp_get_attachment_metadata($image->ID);
  $pathinfo = pathinfo($image->guid);

  $urls = array ('title' => $image->post_title, 'fullsize' => $image->guid);

  if (!$meta['sizes']['medium']) $urls['medium'] = $image->guid;
  else $urls['medium'] = $pathinfo['dirname'] . '/' . $meta['sizes']['medium']['file'];

  if (!$meta['sizes']['thumbnail']) $urls['thumbnail'] =  $urls['medium'];
  else $urls['thumbnail'] = $pathinfo['dirname'] . '/' . $meta['sizes']['thumbnail']['file'];

  if ($size == 'all') return $urls;
  return $urls[$size];
}
?>