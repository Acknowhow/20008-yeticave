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

$errors = [];

if(isset($_GET['success']) && $_GET['success'] === 'true') {

}

if(isset($_GET['success']) && $_GET['success'] === 'false') {
  $error = true;
  $errors = $_SESSION['error_state'];



}

if(isset($_GET['id']) || isset($_GET['add'])) {
  $nav = include_template('templates/nav.php', [

    'categories' => $categories
  ]);
}

if(isset($_GET['id'])){
  $index = null;
  $id = $_GET['id'];

  if(!isset($items[$id])) {
    $title = $error_title;

    http_response_code(404);
    $content = include_template('templates/404.php', [

      'container' => $container
    ]);

  } else {
    $lot = $items[$id];

    $title = $lot['name'];
    $content = include_template('templates/lot.php', [

      'nav' => $nav, 'categories' => $categories,
      'lot' => $lot, 'lot_text' => $lot_text, 'bets' => $bets
    ]);
  }
}

if(isset($_GET['add']) || !empty($errors)) {
  $index = null;

  $title = $add_lot_title;
  $content = include_template('templates/add-lot.php', [

    'categories' => $categories, 'nav' => $nav,
    'lot_name' => $form_defaults['lot_name'], 'category' => $form_defaults['category'],
    'file' => $form_defaults['file'], 'lot_rate' => $form_defaults['lot_rate'],

    'lot_step' => $form_defaults['lot_step'], 'lot_date' => $form_defaults['lot_date'],
    'all' => $form_defaults['all'], 'message' => $form_defaults['message'], 'errors' => $errors
  ]);
}

if(isset($index)) {
  $content = include_template('templates/index.php', [
    'categories' => $categories,
    'items' => $items, 'lot_time_remaining' => $lot_time_remaining
  ]);
}

ob_end_clean();
print include_template('templates/layout.php', [

  'index' => $index, 'title' => $title, 'content' => $content, 'is_auth' => $is_auth,
  'user_avatar' => $user_avatar, 'user_name' => $user_name, 'categories' => $categories, 'year_now' => $year_now
]);

