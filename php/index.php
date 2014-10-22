<?php

require_once 'vendor/autoload.php';

function memoize($key, $callback) {
  $content = apc_fetch($key);
  if (!$content) {
    $content = $callback($key);
    apc_store($key, $content);
  }
  return $content;
}

$layout_file = 'https://andyvanee.github.io/htttemplate/basic/layout.html';

$layout = memoize($layout_file, function($key) {
  return file_get_contents($key);
});

$data = array(
  'site_title' => 'My PHP Site',
  'title' => 'Home',
  'main' => '<p>Welcome to my PHP site using htttemplates!!</p>'
);

$m = new Mustache_Engine;

echo $m->render($layout, $data);
