<?php
require 'functions.php';
require 'config.php';

require 'data/data.php';
require 'data/lot.php';

$lot_selected = '';

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $lot_selected = true;

  if(!$items[$id]['name']) {

    http_response_code(404);
    $error = include_template('templates/404.php', [
      'container' => $container
    ]);
  }
}

if(isset($lot_selected)) {
  $lot_title = $items[$id]['name'];

  $lot = include_template('templates/lot.php', [
    'categories' => $categories, 'bets' => $bets,

    'items' => $items, 'id' => $id, 'lot_SAMPLE_text' => $lot_SAMPLE_text
  ]);
}

$index = include_template('templates/index.php', [
  'categories' => $categories, 'items' => $items, 'lot_time_remaining' => $lot_time_remaining
]);


print include_template('templates/layout.php', [
  'index' => $index, 'index_title' => $index_title, 'lot' => $lot, 'lot_title' => $lot_title,
  'error' => $error, 'error_title' => $error_title,

  'is_auth' => $is_auth, 'user_avatar' => $user_avatar, 'user_name' => $user_name,
  'categories' => $categories, 'year_now' => $year_now
]);

