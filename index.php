<?
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

$errors = [];

$is_login = '';
$is_register = '';
$lot_added = '';
$bet_added = '';

$user = [];
$user_name = '';

$sql = '';
$result = '';

error_reporting(-1);
ini_set("display_errors", 1);

//$sql_lots = 'SELECT * FROM lots';
//$result_lots = mysqli_query($link, $sql_lots);
//
//$rows_lots = mysqli_fetch_all($result_lots, MYSQLI_ASSOC);
//print_r($rows_lots[0]);
//
//$sql_users = 'SELECT * FROM users';
//$result_users = mysqli_query($link, $sql_users);
//$rows_users = mysqli_fetch_all($result_users, MYSQLI_ASSOC);
//print_r($rows_users[0]);

if (!empty($is_auth)) {
  $user = $_SESSION['form_data']['user'];
  $user_name = $user['name'];

  // Unset open password for security reasons
  unset($_SESSION['form_data']['email']);
  unset($_SESSION['form_data']['password']);
}


if (isset($_GET['lot_added'])) {
  if ($_GET['lot_added'] === 'true') {
    $lot_added = true;

  } elseif ($_GET['lot_added'] === 'false') {
    $lot_added = false;
  }
}

if (isset($_GET['is_login'])) {
  if ($_GET['is_login'] === 'true') {
    $is_login = true;

  } elseif ($_GET['is_login'] === 'false') {
    $is_login = false;
  }
}

if (isset($_GET['is_register'])) {
  if ($_GET['is_register'] === 'true') {
    $is_register = true;

  } elseif ($_GET['is_register'] === 'false') {
    $is_register = false;
  }
}

ob_start();
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
  } elseif (empty($is_auth) && (is_bool($is_login) || is_bool($is_register))) {
    $form_defaults['email']['input_data'] =
      $form_data['email'] ? $form_data['email'] : '';

    $form_defaults['password']['input_data'] =
      $form_data['password'] ? $form_data['password'] : '';

  } elseif (is_bool($bet_added)) {
    $form_defaults['bet']['input_data'] =
      $form_data['bet'] ? $form_data['bet'] : '';

  }
}
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
if (is_bool($is_login) && $is_login === false) {
  $errors = $_SESSION['errors_login'];
}

if (is_bool($is_register) && $is_register === false) {
  $errors = $_SESSION['errors_register'];
}

if (is_bool($lot_added) && $lot_added === false) {
  $errors= $_SESSION['errors_lot'];
}

if (is_bool($bet_added) && $bet_added === false) {
  $errors = $_SESSION['errors_bet'];
}

if (isset($_GET['id']) || isset($_GET['add'])
  || isset($_GET['login']) || isset($_GET['register'])) {

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

ob_end_flush();

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
    'bet' => $bet, 'bets' => $bets, 'errors' => $errors, 'bet_made' => $bet_made
  ]);
}

if (isset($_GET['login']) || is_bool($is_login) && $is_login === false) {
  $index = false;

  $content = include_template('templates/login.php', [
    'nav' => $nav, 'email' => $form_defaults['email'],

    'password' => $form_defaults['password'], 'errors' => $errors
  ]);
}

if (isset($_GET['register']) || is_bool($is_register) && $is_register === false) {
  $index = false;

  $content = include_template('templates/register.php', [
    'nav' => $nav, 'email' => $form_defaults['email'],

    'password' => $form_defaults['password'], 'errors' => $errors
  ]);

}

if (isset($_GET['add']) || is_bool($lot_added) && $lot_added === false) {
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

    'categories' => $categories, 'lots' => $lots, 'lot_time_remaining' => $lot_time_remaining
  ]);
}

print include_template('templates/layout.php', [
  'index' => $index, 'title' => $title, 'content' => $content, 'is_auth' => $is_auth,
  'user_avatar' => $user_avatar, 'user_name' => $user_name, 'categories' => $categories, 'year_now' => $year_now
]);



