<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
require 'functions.php';
require 'config.php';

require 'data/data.php';
require 'data/lot.php';

$cookie_name = 'cookie_bet';
$cookie_value = 'black';
$expire = time()+60*60*24*30;
$path = '/';

if(isset($_COOKIE['cookie_bet'])) {
  $cookie_value = $_COOKIE['cookie_bet'];
  $cookie_value = json_decode($cookie_value, true);

  $cookie_value['bet_name'] = 'bet_time';
  $cookie_value['bet_date'] = strtotime('now');

  $cookie_value['bet_value'] = 84;
  $cookie_value = json_encode($cookie_value);

  setcookie($cookie_name, $cookie_value, time() - 9000, $path);
}

setcookie($cookie_name, $cookie_value, $expire, $path);
print_r($cookie_value);

error_reporting(-1);
ini_set("display_errors", 1);

$is_auth = isset($_SESSION['form_data']['user']) ? true : false;

$index = true;
$nav = null;

$lot = [];
$form_data = [];

$errors_lot = [];
$errors_user = [];

$lot_added = '';
$user_submitted = '';

$user = [];
$user_name = '';

if(!empty($is_auth)) {
  $user = $_SESSION['form_data']['user'];
  $user_name = $user['name'];
}

if (isset($_GET['lot_added'])) {
  if ($_GET['lot_added'] === 'true') {
    $lot_added = true;
  }
  elseif ($_GET['lot_added'] === 'false') {
    $lot_added = false;
  }
}

if (isset($_GET['user_submitted'])) {
  if ($_GET['user_submitted'] === 'true') {
    $user_submitted = true;
  }
  elseif ($_GET['user_submitted'] === 'false') {
    $user_submitted = false;
  }
}

if (is_bool($lot_added) && $lot_added === false) {
  $errors_lot = $_SESSION['errors_lot'];
}

if (is_bool($user_submitted) && $user_submitted === false) {
  $errors_user = $_SESSION['errors_user'];
}

if (isset($_SESSION['form_data'])) {
  $form_data = $_SESSION['form_data'];

  if(is_bool($lot_added)) {
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

  } elseif (is_bool($user_submitted)) {
    $form_defaults['email']['input_data'] =
      $form_data['email'] ? $form_data['email'] : '';

    $form_defaults['password']['input_data'] =
      $form_data['password'] ? $form_data['password'] : '';
  }
}

if (isset($_GET['id']) || isset($_GET['add']) || isset($_GET['login'])) {
  $nav = include_template('templates/nav.php', [

    'categories' => $categories
  ]);
}

if (is_bool($lot_added) && $lot_added === true) {
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
  $index = false;
  $title = $lot['name'];

  $content = include_template('templates/lot.php', [
    'nav' => $nav, 'categories' => $categories,
    'lot' => $lot, 'bets' => $bets, 'is_auth' => $is_auth
  ]);
}

if (isset($_GET['login']) || !empty($errors_user)) {
  $index = false;

  $content = include_template('templates/login.php', [
    'nav' => $nav, 'email' => $form_defaults['email'],

    'password' => $form_defaults['password'], 'errors_user' => $errors_user
  ]);
}

if (isset($_GET['add']) || !empty($errors_lot)) {
  $index = false;

  $title = $add_lot_title;
  $form_defaults['category']['input_data'] = 'Выберите категорию';

  $content = include_template('templates/add-lot.php', [

    'nav' => $nav, 'categories' => $categories,
    'lot_name' => $form_defaults['lot_name'], 'category' => $form_defaults['category'],
    'file' => $form_defaults['file'], 'lot_rate' => $form_defaults['lot_rate'],

    'lot_step' => $form_defaults['lot_step'], 'lot_date' => $form_defaults['lot_date'],
    'all' => $form_defaults['all'], 'message' => $form_defaults['message'], 'errors_lot' => $errors_lot
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


