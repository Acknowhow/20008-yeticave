<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
require 'functions.php';
require 'config.php';

require 'data/data.php';
require 'data/lot.php';

error_reporting(-1);
ini_set("display_errors", 1);

$index = true;
$nav = null;

$form_data = [];
$errors = [];

$lot_added = [];
$success = (isset($_GET['success']) && $_GET['success'] === 'true') ? true : null;


if(isset($_SESSION['form_data'])) {
  $form_data = $_SESSION['form_data'];

  $form_defaults['lot_name']['input_data'] =
    $form_data['lot_name'] ? $form_data['lot_name'] : '';

  $form_defaults['category']['input_data'] =
    $form_data['category'] ? $form_data['category'] : '';

  $form_defaults['message']['input_data'] =
    $form_data['message'] ? $form_data['message'] : '';

  $form_defaults['lot_rate']['input_data'] =
    $form_data['lot_rate'] ? $form_data['lot_rate'] : '';

  $form_defaults['lot_step']['input_data'] =
    $form_data['lot_step'] ? $form_data['lot_step'] : '';

  $form_defaults['lot_date']['input_data'] =
    $form_data['lot_date'] ? $form_data['lot_date'] : '';

}

if(isset($_GET['success']) && $_GET['success'] === 'false') {
  $error = true;
  $errors = $_SESSION['error_state'];

}
if (isset($success)) {
  $lot_added = [
    'name' => $form_data['lot_name'], 'category' => $form_data['category'],
    'price' => $form_data['lot_rate'], 'step' => $form_data['lot_step'],

    'date' => $form_data['lot_date'], 'img_url' => $form_data['lot_url'],
    'img_alt' => $form_data['lot_alt'], 'description' => $form_data['message']
  ];
}

if(isset($_GET['id']) || isset($_GET['add']) || isset($success)) {
  $nav = include_template('templates/nav.php', [

    'categories' => $categories
  ]);
}

if(isset($_GET['id']) || isset($success)){
  $index = null;
  $id = isset($_GET['id']) ? $_GET['id'] : 0;

  if($id !== 0){
    $lot = $lots[$id];
  } else {
    $lot = $lot_added;
  }

  $title = $lot['name'];
  $content = include_template('templates/lot.php', [

    'nav' => $nav,
    'categories' => $categories, 'lot' => $lot, 'bets' => $bets
  ]);
}

if(isset($_GET['add']) || !empty($errors)) {
  $index = null;

  $title = $add_lot_title;
  $content = include_template('templates/add-lot.php', [

    'nav' => $nav, 'categories' => $categories,
    'lot_name' => $form_defaults['lot_name'], 'category' => $form_defaults['category'],
    'file' => $form_defaults['file'], 'lot_rate' => $form_defaults['lot_rate'],

    'lot_step' => $form_defaults['lot_step'], 'lot_date' => $form_defaults['lot_date'],
    'all' => $form_defaults['all'], 'message' => $form_defaults['message'], 'errors' => $errors
  ]);
}

if(isset($index)) {
  $content = include_template('templates/index.php', [

    'categories' => $categories,
    'lots' => $lots, 'lot_time_remaining' => $lot_time_remaining
  ]);
}

print include_template('templates/layout.php', [

  'index' => $index, 'title' => $title, 'content' => $content, 'is_auth' => $is_auth,
  'user_avatar' => $user_avatar, 'user_name' => $user_name, 'categories' => $categories, 'year_now' => $year_now
]);
session_destroy();

