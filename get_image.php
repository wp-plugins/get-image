<?php
/*
    Plugin Name: getImage
    Description: Pega a última imagem filha de um post. Para usar este plugin basta você inserir um dos seguintes comandos no seu template: <strong>gi_fullsize(); gi_medium(); gi_thumbnail();</strong> Adicionando um parâmetro, ele vai parar dentro da tag de imagem gerada. Por padrão, o plugin retornará uma string contendo a tag da imagem gerada, mas você pode passar o segundo parametro como true para pedir que ele faça a impressão desta string."
    Version: 0.2
    Author: DGmike
    Author URI: http://dgmike.wordpress.com
 */

/**
 * Pega o primeiro arquivo que foi feito o upload filho (relacionado) deste post
 *
 * @param object $post Post global gerado pelo the_post()
 * @return object Primeiro anexo (imagem) do post
 */
function gi_file (){
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
  return reset($images);
}


function gi_fullsize($extra = '', $print = false) {
  $image = gi_file ();
  if ($url = gi_image($image,'fullsize',$print)) {
    $return = sprintf('<img src="%s" title="%s" %s  />', $url, $image->post_title, $extra);
    if ($print) print $return;
    else return $return;
  }
}
function gi_medium($extra = '', $print = false) {
  $image = gi_file ();
  if ($url = gi_image($image,'medium',$print)) {
    $return = sprintf('<img src="%s" title="%s" %s  />', $url, $image->post_title, $extra);
    if ($print) print $return;
    else return $return;
  }
}
function gi_thumbnail($extra = '', $print = false) {
  $image = gi_file ();
  if ($url = gi_image($image,'thumbnail',$print)) {
    $return = sprintf('<img src="%s" title="%s" %s  />', $url, $image->post_title, $extra);
    if ($print) print $return;
    else return $return;
  }
}


function gi_image($image, $size) {
  $image = gi_file();
  if (!$image || array_key_exists($size, array ('fullsize', 'medium', 'thumbnail') ) ) return;

  $meta = wp_get_attachment_metadata($image->ID);
  $pathinfo = pathinfo($image->guid);

  $urls = array ('fullsize' => $image->guid);

  if (!$meta['sizes']['medium']) $urls['medium'] = $image->guid;
  else $urls['medium'] = $pathinfo['dirname'] . '/' . $meta['sizes']['medium']['file'];

  if (!$meta['sizes']['thumbnail']) $urls['thumbnail'] =  $urls['medium'];
  else $urls['thumbnail'] = $pathinfo['dirname'] . '/' . $meta['sizes']['thumbnail']['file'];

  return $urls[$size];
}
?>