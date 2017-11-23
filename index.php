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

$lot_name = '';

if(isset($_GET['success']) && $_GET['success'] === 'true') {
  var_dump($_SESSION['form-data']);
}

if(isset($_GET['success']) && $_GET['success'] === 'false') {
  // First must check if the key value in the array is null,
  // If so, display the default message from form data for that key

  // Best option is to make one function for filtering array keys.
  // 1.) If the key is null, then display message for that
  // Key from form data array
  // 2.) Else return key and its value to pick out item from lot array,
  // and display that error from error-messages array

  // 3.) The only thing to keep in mind is whether several messages should
  // be displayed, or only the first one which is wrong. Since function which
  // was offered on lecture checks error messages sequentially, it is probably
  // preferred to be implemented that way
  var_dump($_SESSION['error-messages']);

  // Included temporary for debugging purposes
  session_abort();
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

      'nav' => $nav, 'categories' => $categories, 'lot' => $lot,
      'lot_text' => $lot_text, 'bets' => $bets
    ]);
  }
}

if(isset($_GET['add'])){
  $index = null;

  $title = $add_lot_title;
  $content = include_template('templates/add-lot.php', [

    'categories' => $categories, 'nav' => $nav, 'lot_name' => $lot_name
//    'lot_name' => $form['lot-name'],
//    'category' => $form['category'], 'message' => $form['message'],
//
//    'file' => $form['file'], 'lot_rate' => $form['lot-rate'],
//    'lot_step' => $form['lot-step'], 'lot_date' => $form['lot-date'], 'all' => $form['all']
  ]);
}


if(isset($index)) {
  $content = include_template('templates/index.php', [

    'categories' => $categories,
    'items' => $items, 'lot_time_remaining' => $lot_time_remaining
  ]);
}

print include_template('templates/layout.php', [
  'index' => $index, 'title' => $title, 'content' => $content,

  'is_auth' => $is_auth, 'user_avatar' => $user_avatar,
  'user_name' => $user_name, 'categories' => $categories, 'year_now' => $year_now
]);

