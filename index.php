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
$lot = [];

$form_data = [];
$errors = [];

$success = (isset($_GET['success']) && $_GET['success'] === 'true') ? true : false;

if (isset($_SESSION['form_data'])) {
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

if (isset($_GET['success']) && $_GET['success'] === 'false') {
  $error = true;
  $errors = $_SESSION['error_state'];
}

if (isset($_GET['id']) || isset($_GET['add']) || !empty($success)) {
  $nav = include_template('templates/nav.php', [

    'categories' => $categories
  ]);
}

if (!empty($success)) {
  $index = false;

  $lot = [
    'name' => $form_data['lot_name'], 'category' => $form_data['category'],
    'price' => $form_data['lot_rate'], 'step' => $form_data['lot_step'],

    'date' => $form_data['lot_date'], 'img_url' => $form_data['lot_url'],
    'img_alt' => $form_data['lot_alt'], 'description' => $form_data['message']
  ];
}

if (isset($_GET['id'])){
  $index = false;
  $id = $_GET['id'];

  if (!isset($lots[$id])) {
    $title = $error_title;

    http_response_code(404);
    $content = include_template('templates/404.php', [

      'container' => $container
    ]);

  } else {
    $lot = $lots[$id];
  }
}

if (!empty($lot)){
  $title = $lot['name'];

  $content = include_template('templates/lot.php', [
    'nav' => $nav, 'categories' => $categories,
    'lot' => $lot, 'bets' => $bets
  ]);
}

if (isset($_GET['add']) || !empty($errors)) {
  $index = false;

  $title = $add_lot_title;
  $form_defaults['category']['input_data'] = 'Выберите категорию';

  $content = include_template('templates/add-lot.php', [

    'nav' => $nav, 'categories' => $categories,
    'lot_name' => $form_defaults['lot_name'], 'category' => $form_defaults['category'],
    'file' => $form_defaults['file'], 'lot_rate' => $form_defaults['lot_rate'],

    'lot_step' => $form_defaults['lot_step'], 'lot_date' => $form_defaults['lot_date'],
    'all' => $form_defaults['all'], 'message' => $form_defaults['message'], 'errors' => $errors
  ]);
}

if (!empty($index)) {
  $content = include_template('templates/index.php', [

    'categories' => $categories,
    'lots' => $lots, 'lot_time_remaining' => $lot_time_remaining
  ]);
}

print include_template('templates/layout.php', [

  'index' => $index, 'title' => $title, 'content' => $content, 'is_auth' => $is_auth,
  'user_avatar' => $user_avatar, 'user_name' => $user_name, 'categories' => $categories, 'year_now' => $year_now
]);


