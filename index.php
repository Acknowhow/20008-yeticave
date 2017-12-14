<?
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
ob_start();
require 'init.php';
require 'functions.php';
require 'config.php';
require 'data/data.php';
require 'data/lot.php';

error_reporting(-1);
ini_set("display_errors", 1);

$cookie_name = 'cookie_bet';
$cookie_value = isset($_COOKIE['cookie_bet']) ?
  $_COOKIE['cookie_bet'] : '';
$expire = time() + 60 * 60 * 24 * 30;
$path = '/';

$is_auth = isset($_SESSION['user']) ?
  true : false;

// id
$user_id = null;
$lot_id = null;
$bet_id = null;
$category_id = null;

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
$form_data = [];

$error = '';
$errors = [];
$errors_all =

$is_login = '';
$is_register = '';
$lot_added = '';
$bet_added = '';

// Form data user
$user = [];
$user_name = '';

$avatar = '';

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

// All keys for $_GET array
$get_keys = [
  'id', 'add', 'login', 'register',
  'lot_added', 'is_login', 'bet_added', 'is_register'
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

if (!empty($is_auth)) {
  $user = $_SESSION['user'];
  $user_id = $user['id'];

  $user_name = $user['name'];
  $user_avatar = $user['url'];

  // Unset open password for security reasons
  unset($_SESSION['form_data']['login']);
}

if (isset($_GET['is_register'])) {
  if ($_GET['is_register'] === 'true') {
    $is_register = true;
    $is_auth = true;

    $user = $_SESSION['form_data']['register'];
    $_SESSION['user'] = $user;

    // Add current timestamp in MySQL format
    $date_add = convertTimeStampMySQL(
      strtotime('now'));

    $name = $user['name'];
    $email = $user['email'];

    $password = $user['password'];
    $contacts = $user['contacts'];

    $date_add = $user['date_add'];
    $url = $user['url'];

    $user_id = insert_data($link, 'users', [
        'name' => $user_name, 'email' => $user_email, 'password' => $user_password,
        'contacts' => $user_contacts, 'date_add' => $date_add, 'url' => $url
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

    // Assign id into SESSION
    $user['id'] = $user_id;

    $_SESSION['form_data']['register'] = [];


  } elseif ($_GET['is_register'] === 'false') {
    $is_register = false;
  }
}

// Add to database
if (isset($_GET['lot_added'])) {

  if ($_GET['lot_added'] === 'true') {
    $lot_added = true;

    $lot_name = $_SESSION['form_data']['lot'];
    // Add current timestamp in MySQL format
    $date_add = convertTimeStampMySQL(
      strtotime('now'));
    $date_end = $_SESSION['form_data']['date_end'];

    $description = $_SESSION['form_data']['description'];
    $url = $_SESSION['form_data']['url'];

    $rate = $_SESSION['form_data']['rate'];
    $step = $_SESSION['form_data']['step'];

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
      'name' => $lot_name, 'date_add' => $date_add, 'date_end' => $date_end,
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

if (isset($_SESSION['form_data'])) {
  $form_data = $_SESSION['form_data'];

  if ($lot_added === false) {
    $check_key = 'lot_add';

  } elseif ($is_login === false) {
    $check_key = 'login';

  } elseif ($is_register === false) {
    $check_key = 'register';

  } elseif ($bet_added === false) {
    $check_key = 'bet_add';
  }

  // Can use foreach function here
  foreach ($form_data as $key => $value) {
    if ($key === $check_key) {
      $form_defaults[$key]['input'] =
        $form_data[$key] ? $form_data[$key] : '';

    }
  }

  $_SESSION['form_data'] = [];
}

if (isset($_GET['bet_added'])) {
  $bet_id = $form_data['bet_add']['bet_id'];

  if ($_GET['bet_added'] === 'true') {
    $bet_added = true;
    $cookie_value = json_decode($cookie_value, true);

    $cookie_value[$bet_id]['bet_value'] = $form_data['bet_add']['bet_value'];
    $cookie_value[$bet_id]['date_add'] = strtotime('now');

    $cookie_value = json_encode($cookie_value);
    setcookie($cookie_name, $cookie_value, $expire, $path);
  } elseif ($_GET['bet_added'] === 'false') {
    $bet_added = false;

  }
}
// Set errors

if ($is_login === false) {
  $errors = $_SESSION['errors_login'];
}

if ($is_register === false) {
  $errors = $_SESSION['errors_register'];
  $errors['file'] = $_SESSION['errors_file'];

}

if ($lot_added === false) {
  $errors = $_SESSION['errors_lot'];
  $errors['file'] = $_SESSION['errors_file'];

}

if ($bet_added === false) {
  $errors = $_SESSION['errors_bet'];
}

if (!empty($is_nav)) {

  $nav = include_template('templates/nav.php', [
    'categories' => $categories
  ]);
}

if ($lot_added === true) {
  $index = false;

  // Here must add all data from the current session

  $lot = [
    'name' => $form_data['lot'], 'category' => $form_data['category'],
    'rate' => $form_data['rate'], 'step' => $form_data['step'],

    'date_end' => $form_data['date_end'], 'url' => $form_data['url'],
    'alt' => $form_data['alt'], 'description' => $form_data['description']
  ];
}

if (isset($_GET['id']) || $bet_added === false) {
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

if ($bet_added === true || !empty($lot)) {
  $cookie_value = json_decode($cookie_value, true);

  $my_bets = $cookie_value;
  $cookie_value = json_encode($cookie_value);
}

ob_end_flush();

if ($bet_added === true) {
  $index = false;

  $content = include_template('templates/my-lots.php', [
    'nav' => $nav, 'my_bets' => $my_bets, 'lots' => $lots
  ]);
}

if (!empty($lot)) {
  $index = false;
  $title = $lot['name'];

  if (!empty($my_bets)) {
    $bet_made = array_key_exists($bet_id, $my_bets) ? true : false;
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

  $content = include_template('templates/login.php', [
    'nav' => $nav, 'email' => $form_defaults['email'],

    'password' => $form_defaults['password'], 'errors' => $errors
  ]);
}

if (isset($_GET['register']) || $is_register === false) {
  $index = false;

  $content = include_template('templates/register.php', [
    'nav' => $nav, 'email' => $form_defaults['email'],
    'password' => $form_defaults['password'], 'all' => $form_defaults['all'],

    'name' => $form_defaults['name'], 'avatar' => $form_defaults['avatar'],
    'contacts' => $form_defaults['contacts'], 'errors' => $errors

  ]);
}

if (isset($_GET['lot_add']) || $lot_added === false) {
  $index = false;
  $title = $add_lot_title;

  $defaults = $form_defaults['lot_add'];


  $content = include_template('templates/add-lot.php', [
    'nav' => $nav,
    'categories' => $categories, 'name' => $defaults['name'],

    'category' => $defaults['category'], 'photo' => $defaults['photo'],
    'rate' => $defaults['rate'], 'step' => $defaults['step'],

    'date_end' => $defaults['date_end'], 'all' => $defaults['all'],
    'description' => $defaults['description'], 'errors' => $errors

  ]);
}

if (!empty($index)) {
  $content = include_template('templates/index.php', [

    'categories' => $categories, 'lots' => $lots
  ]);
}

print include_template('templates/layout.php', [
  'index' => $index, 'title' => $title, 'content' => $content, 'is_auth' => $is_auth,
  'url' => $url, 'name' => $name, 'categories' => $categories, 'year_now' => $year_now
]);



