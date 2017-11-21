<?php
session_start();
require 'functions.php';
require 'config.php';

require 'data/data.php';
require 'data/lot.php';

error_reporting(-1);
ini_set("display_errors", 1);

$index = true;
$nav = null;

if(isset($_GET['success'])) {

  var_dump($_SESSION['form-data']);
}


if(isset($_GET['id']) || isset($_GET['add'])) {
  $nav = include_template('templates/nav.php', [

    'categories' => $categories
  ]);
}

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

      'nav' => $nav, 'categories' => $categories, 'lot' => $lot,
      'lot_text' => $lot_text, 'bets' => $bets
    ]);
  }
}

if(isset($_GET['add'])){
  $index = null;

  $title = $add_lot_title;
  $content = include_template('templates/add-lot.php', [

    'categories' => $categories, 'nav' => $nav
  ]);
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

