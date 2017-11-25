<?php
session_start();
require 'functions.php';

require 'config.php';
require 'data/data.php';

require 'data/form.php';
require 'data/lot.php';

error_reporting(-1);
ini_set("display_errors", 1);

$index = true;
$nav = null;

$errors = false;

if(isset($_GET['success']) && $_GET['success'] === 'true') {
  var_dump($_SESSION['form_data']);
}

if(isset($_GET['success']) && $_GET['success'] === 'false') {
  $errors = true;
  $error_key = $_SESSION['error_key'];

  $error_message = $form_errors[$error_key]['error_empty'];
  // Geeting error message for the specific key
  // that was received for $_POST
  $form[$error_key]['error_message'] = $error_message;

//  foreach ($_SESSION['form_data'] as $error_key) {
//    //
//  }

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

if(isset($_GET['add']) || $errors === true){
  $index = null;

  $title = $add_lot_title;
  $content = include_template('templates/add-lot.php', [

    'categories' => $categories, 'nav' => $nav,
    'lot_name' => $form['lot_name'], 'category' => $form['category'],
    'file' => $form['file'], 'lot_rate' => $form['lot_rate'],

    'lot_step' => $form['lot_step'], 'lot_date' => $form['lot_date'], 'all' => $form['all'],
    'message' => $form['message'], 'errors' => $errors, 'error_key' => $error_key
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

