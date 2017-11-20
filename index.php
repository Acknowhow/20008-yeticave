<?php
require 'functions.php';
require 'config.php';

require 'data/data.php';
require 'data/lot.php';

$index = true;

if(isset($_GET['id'])){
  $index = null;
  $id = $_GET['id'];

  $lot = $items[$id];
  if(!$lot['name']) {
    $title = $error_title;

    http_response_code(404);
    $content = include_template('templates/404.php', [

      'container' => $container
    ]);
  } else {

    $title = $lot['name'];
    $content = include_template('templates/lot.php', [

      'categories' => $categories, 'lot' => $lot
    ]);
  }
}

if(isset($index)) {

  $content = include_template('templates/index.php', [
    'categories' => $categories, 'items' => $items, 'lot_time_remaining' => $lot_time_remaining
  ]);
}

print include_template('templates/layout.php', [
  'index' => $index, 'title' => $title, 'content' => $content,
  'is_auth' => $is_auth, 'user_avatar' => $user_avatar,

  'user_name' => $user_name, 'categories' => $categories, 'year_now' => $year_now
]);

