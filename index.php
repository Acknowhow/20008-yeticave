<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
require 'functions.php';
require 'config.php';

require 'data/data.php';
require 'data/lot.php';

require 'mysql_helper.php';
require 'init.php';

$cookie_name = 'cookie_bet';
$cookie_value = isset($_COOKIE['cookie_bet']) ? $_COOKIE['cookie_bet'] : '';
$expire = time()+60*60*24*30;
$path = '/';

$is_auth = isset($_SESSION['form_data']['user']) ? true : false;
$index = true;
$nav = null;

$lot = [];
$bet = [];
$bet_made = false;
$my_bets = [];

$id = '';
$form_data = [];

$errors_lot = [];
$errors_user = [];
$errors_bet = [];

$lot_added = '';
$user_added = '';
$bet_added = '';

$user = [];
$user_name = '';

error_reporting(-1);
ini_set("display_errors", 1);

if(!empty($is_auth)) {
  $user = $_SESSION['form_data']['user'];
  $user_name = $user['name'];

  // Unset open password for security reasons
  unset($_SESSION['form_data']['email']);
  unset($_SESSION['form_data']['password']);
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

    // If is_auth is NOT empty, all data stored
    // in $_SESSION['form_data']['user']
  } elseif (is_bool($user_added) && empty($is_auth)) {
    $form_defaults['email']['input_data'] =
      $form_data['email'] ? $form_data['email'] : '';

    $form_defaults['password']['input_data'] =
      $form_data['password'] ? $form_data['password'] : '';

  } elseif (is_bool($bet_added)) {
    $form_defaults['bet']['input_data'] =
      $form_data['bet'] ? $form_data['bet'] : '';
  }
}

if (isset($_GET['lot_added'])) {
  if ($_GET['lot_added'] === 'true') {
    $lot_added = true;
  }
  elseif ($_GET['lot_added'] === 'false') {
    $lot_added = false;
  }
}

if (isset($_GET['user_added'])) {
  if ($_GET['user_added'] === 'true') {
    $user_added = true;
  }
  elseif ($_GET['user_added'] === 'false') {
    $user_added = false;
  }
}

ob_start();
if (isset($_GET['bet_added'])) {
  $id = $_SESSION['form_data']['bet_id'];

  if ($_GET['bet_added'] === 'true') {
    $bet_added = true;
    $cookie_value = json_decode($cookie_value, true);

    $cookie_value[$id]['value'] = $form_data['bet'];
    $cookie_value[$id]['date'] = strtotime('now');

    $cookie_value = json_encode($cookie_value);
    setcookie($cookie_name, $cookie_value, $expire, $path);
  }
  elseif ($_GET['bet_added'] === 'false') {
    $bet_added = false;
  }
}

// Set errors
if (is_bool($lot_added) && $lot_added === false) {
  $errors_lot = $_SESSION['errors_lot'];
}

if (is_bool($user_added) && $user_added === false) {
  $errors_user = $_SESSION['errors_user'];
}

if (is_bool($bet_added) && $bet_added === false) {
  $errors_bet = $_SESSION['errors_bet'];
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

if (isset($_GET['id']) || is_bool($bet_added) && $bet_added === false){
  $index = false;

  $id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['form_data']['bet_id'];
  $bet = $form_defaults['bet'];
  ob_end_flush();

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

if (is_bool($bet_added) && $bet_added === true || !empty($lot)) {
  $cookie_value = json_decode($cookie_value, true);

  $my_bets = $cookie_value;
  $cookie_value = json_encode($cookie_value);
}

if (is_bool($bet_added) && $bet_added === true) {
  $index = false;

  $content = include_template('templates/my-lots.php', [
    'nav' => $nav, 'my_bets' => $my_bets, 'lots' => $lots
  ]);
}

if (!empty($lot)){
  $index = false;
  $title = $lot['name'];

  if (!empty($my_bets)) {
    $bet_made = array_key_exists($id, $my_bets) ? true : false;
  }

  $content = include_template('templates/lot.php', [
    'nav' => $nav, 'is_auth' => $is_auth,

    'categories' => $categories, 'id' => $id, 'lot' => $lot,
    'bet' => $bet, 'bets' => $bets, 'errors_bet' => $errors_bet, 'bet_made' => $bet_made
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

    'categories' => $categories, 'lots' => $lots, 'lot_time_remaining' => $lot_time_remaining
  ]);
}

print include_template('templates/layout.php', [
  'index' => $index, 'title' => $title, 'content' => $content, 'is_auth' => $is_auth,
  'user_avatar' => $user_avatar, 'user_name' => $user_name, 'categories' => $categories, 'year_now' => $year_now
]);



