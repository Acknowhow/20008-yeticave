<?
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
ob_start();
require 'init.php';
require 'functions.php';
require 'config.php';
require 'data/defaults.php';
require 'data/lot.php';

error_reporting(-1);
ini_set("display_errors", 1);

$cookie_name = 'cookie_bet';
$cookie_value = isset($_COOKIE['cookie_bet']) ?
  $_COOKIE['cookie_bet'] : '';
$expire = time() + 60 * 60 * 24 * 30;
$path = '/';

$is_auth = '';


// id
$user_id = null;
$lot_id = null;
$bet_id = null;
$category_id = null;

$form_data = isset($_SESSION['form_data']) ?
  $_SESSION['form_data'] : '';

$defaults = [];

// Templates
$index = true;
$is_nav = null;
$nav = [];
$content = [];

// Helper vars
$name = '';
$url = '';
$date_add = '';

// Bets
$bet = [];
$bet_made = false;
$my_bets = [];

// Lots
$lots = [];

// Form
$check_key = '';
$user_auth = isset($_SESSION['form_data']['user']) ?
  $_SESSION['form_data']['user'] : '';

$error = '';
$errors = isset($_SESSION['errors']) ?
  $_SESSION['errors'] : [];
$errors_upload = isset($_SESSION['errors_upload']) ?
  $_SESSION['errors_upload'] : [];

$is_login = '';
$is_register = '';
$is_lot_add = '';
$is_bet_add = '';

// Form data user
$user = [];

$email = '';
$password = '';
$contacts = '';

// MySQL vars
$categories_sql = '';
$lots_sql = '';
$result = '';

// Categories
$categories = [];
$category_id_sql = '';

var_dump($_SESSION);


// All keys for $_GET array
$get_keys = [
  'id', 'add', 'login', 'register',
  'is_lot_add', 'is_login', 'is_bet_add', 'is_register'
];

$categories_eng = [
  'boards', 'attachment', 'boots', 'clothing', 'tools', 'other'
];


if (!empty($_GET)) {
  $get_keys = array_flip($get_keys);
  $is_nav = array_intersect($_GET, $get_keys) ? 'true' : 'false';
};

$categories_sql = 'SELECT * FROM categories ORDER BY category_id ASC;';
$categories = select_data($link, $categories_sql, []);
$categories = makeAssocArray($categories, $categories_eng, 'name');

if (empty($categories)) {
  mysqli_close($link);

  $error = 'Can\'t resolve categories list';
  print include_template('templates/404.php',[
    'container' => $container,
    'error' => $error
  ]);
  exit();

}

$lots_sql = 'SELECT l.lot_id,l.name,l.date_add,
l.date_end,l.description,l.url,l.rate,l.step,l.author_id,
l.category_id,c.name as category from lots l JOIN
 categories c ON l.category_id=c.category_id
  WHERE l.date_add < l.date_end ORDER BY l.date_add DESC;';

if (!empty(select_data($link, $lots_sql, []))) {

  $lots = select_data($link, $lots_sql, []);

  if (empty($lots)) {
    mysqli_close($link);

    $error = 'Can\'t resolve lots list';

    print include_template('templates/404.php',[
      'container' => $container,
      'error' => $error
    ]);
    exit();

  }
}

if (!empty($user)) {
  $is_auth = true;
  $user = $form_data['user'];

  $user_id = $user['user_id'];

  $name = $user['name'];
  $url = $user['url'];

}

if (isset($_GET['is_register'])) {
  if ($_GET['is_register'] === 'true') {
    $is_register = true;
    $is_auth = true;

    $user = $form_data;

    // Add current timestamp in MySQL format
    $date_add = convertTimeStampMySQL(
      strtotime('now'));

    $name = $user['name'];
    $email = $user['email'];

    $password = $user['password'];
    $contacts = $user['contacts'];

    $url = isset($user['url']) ? $user['url'] : $url_default;

    $user_id = insert_data($link, 'users', [
        'name' => $name, 'email' => $email, 'password' => $password,
        'contacts' => $contacts, 'date_add' => $date_add, 'url' => $url
      ]);

    if (!is_int($user_id)) {
      mysqli_close($link);

      $error = mysqli_connect_error() . 'Can\'t insert user';

      print include_template('templates/404.php',[
        'container' => $container,
        'error' => $error
      ]);
      exit();
    }

    $_SESSION['user'] = $user;



  } elseif ($_GET['is_register'] === 'false') {
    $is_register = false;
    $check_key = 'register';
  }
}

// Add to database
if (isset($_GET['is_lot_add'])) {

  if ($_GET['is_lot_add'] === 'true') {
    $is_lot_add = true;

  } elseif ($_GET['is_lot_add'] === 'false') {
    $is_lot_add = false;
    $check_key = 'lot_add';
  }
}

if (isset($_GET['is_login'])) {
  if ($_GET['is_login'] === 'true') {
    $is_login = true;
    $is_auth = true;


    var_dump($user);


  } elseif ($_GET['is_login'] === 'false') {
    $is_login = false;
    $check_key = 'login';
  }
}

if (isset($_GET['is_bet_add'])) {

  if ($_GET['is_bet_add'] === 'true') {
    $is_bet_add = true;
    $bet_id = $form_data['bet_add']['bet_id'];

    $cookie_value = json_decode($cookie_value, true);

    $cookie_value[$bet_id]['bet'] = $form_data['bet_add']['bet'];
    $cookie_value[$bet_id]['date_add'] = strtotime('now');

    $cookie_value = json_encode($cookie_value);
    setcookie($cookie_name, $cookie_value, $expire, $path);

    $form_data['bet_add'] = [];

  } elseif ($_GET['is_bet_add'] === 'false') {
    $is_bet_add = false;
    $check_key = 'bet_add';
  }
}

if (!empty($check_key)) {

  $errors = $errors[$check_key];
  // Can use foreach function here
  foreach ($form_data[$check_key] as $key => $value) {
    $form_defaults[$check_key][$key]['input'] = $value ? $value : '';
  }
}


if (!empty($is_nav)) {

  $nav = include_template('templates/nav.php', [
    'categories' => $categories
  ]);
}

if ($is_lot_add === true) {
  $index = false;

  $lot = $form_data['lot_add'];

  $name = $lot['name'];
  // Add current timestamp in MySQL format
  $date_add = convertTimeStampMySQL(
    strtotime('now'));

  $date_end = $lot['date_end'];

  $description = $lot['description'];
  $url = $lot['url'];

  $rate = $lot['rate'];
  $step = $lot['step'];

  $category_id_sql = 'SELECT category_id FROM categories WHERE name=?;';
  $category_id = select_data($link, $category_id_sql, [$_SESSION['form_data']['category']]);


  if (!$category_id) {
    mysqli_close($link);

    $error = mysqli_connect_error() . 'Can\'t get category id';

    print include_template('templates/404.php',[
      'container' => $container,
      'error' => $error
    ]);
    exit();

  }
  // Get category id from fetched MySQL data
  $category_id = $category_id[0]['category_id'];

  $lot_id = insert_data($link, 'lots', [
    'name' => $name, 'date_add' => $date_add, 'date_end' => $date_end,
    'description' => $description, 'url' => $url, 'rate' => $rate,
    'step' => $step, 'author_id' => $user_id, 'category_id' => $category_id
  ]);

  if (!is_int($lot_id)) {
    mysqli_close($link);

    $error = mysqli_connect_error() . 'Can\'t insert lot';

    print include_template('templates/404.php',[
      'container' => $container,
      'error' => $error
    ]);
    exit();

  }

  $form_data['lot_add'] = [];
}

if (isset($_GET['lot_id'])) {
  $index = false;

  $lot_id = $_GET['lot_id'];

  if (!isset($lots[$lot_id])) {
    $title = $error_title;

    http_response_code(404);
    $content = include_template('templates/404.php', [

      'container' => $container
    ]);

  } else {
    $lot = $lots[$lot_id];
  }
}

if ($is_bet_add === true || !empty($lot)) {
  $cookie_value = json_decode($cookie_value, true);

  $my_bets = $cookie_value;
  $cookie_value = json_encode($cookie_value);
}

ob_end_flush();

if ($is_bet_add === true) {
  $index = false;

  $content = include_template('templates/my-lots.php', [
    'nav' => $nav, 'my_bets' => $my_bets, 'lots' => $lots
  ]);
}

if (!empty($lot)) {
  $index = false;
  $title = $lot['name'];

  if (!empty($my_bets)) {
    $bet_made = array_key_exists($lot_id, $my_bets) ? true : false;
  }
  // Here must set current bet value instead of id
  $content = include_template('templates/lot.php', [
    'nav' => $nav, 'is_auth' => $is_auth,

    'categories' => $categories, 'bet_id' => $bet_id, 'lot' => $lot,
    'bet' => $bet, 'bets' => $bets, 'errors' => $errors, 'bet_made' => $bet_made
  ]);
}

if (isset($_GET['login']) || $is_login === false) {
  $index = false;
  $defaults = $form_defaults['login'];

  $content = include_template('templates/login.php', [
    'nav' => $nav, 'email' => $defaults['email'],

    'password' => $defaults['password'], 'errors' => $errors
  ]);
}


if (isset($_GET['register']) || $is_register === false) {
  $index = false;


  $defaults = $form_defaults['register'];

  $content = include_template('templates/register.php', [
    'nav' => $nav, 'email' => $defaults['email'],
    'password' => $defaults['password'],

    'name' => $defaults['name'], 'url' => $defaults['url'],
    'contacts' => $defaults['contacts'], 'errors' => $errors,
    'errors_upload' => $errors_upload

  ]);
}

if (isset($_GET['lot_add']) || $is_lot_add === false) {
  $index = false;
  $title = $add_lot_title;

  $defaults = $form_defaults['lot_add'];

  $content = include_template('templates/add-lot.php', [
    'nav' => $nav,
    'categories' => $categories, 'lot' => $defaults['lot'],

    'category' => $defaults['category'], 'url' => $defaults['url'],
    'rate' => $defaults['rate'], 'step' => $defaults['step'],

    'date_end' => $defaults['date_end'],
    'description' => $defaults['description'], 'errors' => $errors,
    'errors_upload' => $errors_upload

  ]);
}

if (!empty($index)) {
  $content = include_template('templates/index.php', [

    'categories' => $categories, 'lots' => $lots
  ]);
}

$form_data = [];
$errors = [];

print include_template('templates/layout.php', [
  'index' => $index, 'title' => $title, 'content' => $content, 'is_auth' => $is_auth,
  'url' => $url, 'name' => $name, 'categories' => $categories, 'year_now' => $year_now
]);




