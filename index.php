<?php
require 'functions.php';
require 'config.php';

require 'data/data.php';
require 'data/lot.php';

$index = true;

$lot_selected= null;


if(isset($_GET['id'])){
  $id = $_GET['id'];

  $lot = $items[$id];
  $lot_title = $lot['name'];

  // If lot is not in the database
  if(!$lot['name']) {
    $index = null;
    $title = $error_title;

    http_response_code(404);
    $content = include_template('templates/404.php', [

      'container' => $container
    ]);
  } else {
    $index = null;

    $title = $lot_title;
    $content = include_template('templates/index.php', [

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

