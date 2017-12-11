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
$cookie_value = isset($_COOKIE['cookie_bet']) ? $_COOKIE['cookie_bet'] : '';
$expire = time() + 60 * 60 * 24 * 30;
$path = '/';

$is_auth = isset($_SESSION['form_data']['user']) ? true : false;
$index = true;

$is_nav = null;
$nav = [];

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

// Form data user
$user_insert_id = '';
$email = '';
$password = '';
$name = '';
$contacts = '';
$date_add = '';
$url = '';

// MySQL vars
$categories_sql = '';
$result = '';

// Categories
$categories = [];
$categories_fetched = [];
$categories_eng = [];
$categories_insert_id = '';

// All keys for $_GET array
$get_keys = [
  'id', 'add', 'login', 'register',
  'lot_added', 'is_login', 'bet_added', 'is_register'
];

if (!empty($_GET)) {
  $get_keys = array_flip($get_keys);
  $is_nav = array_intersect($_GET, $get_keys) ? 'true' : 'false';
};

$categories_eng = [
  'boards', 'attachment', 'boots', 'clothing', 'tools', 'other'
];

$categories_sql = 'SELECT * FROM categories ORDER BY category_id ASC;';
if (!empty(select_data($link, $categories_sql, []))) {

  $categories_fetched = select_data($link, $categories_sql, []);
  $categories = makeAssocArray($categories_fetched, $categories_eng, 'name');

  if (empty($categories)) {
    mysqli_close($link);

    $error = 'Can\'t resolve categories list';

    print include_template('templates/404.php',[
      'container' => $container,
      'error' => $error
    ]);
    exit();

  }

}  else {
  // Insert default categories
  $categories_insert_id = insert_data($link, 'categories', [
      'name' => 'Доски и лыжи']
  );

  if (!is_int($categories_insert_id)) {
    mysqli_close($link);

    $error = mysqli_connect_error();

    print include_template('templates/404.php',[
      'container' => $container,
      'error' => $error
    ]);
    exit();

  }
  $categories_insert_id = insert_data($link, 'categories', [
      'name' => 'Крепления']
  );
  $categories_insert_id = insert_data($link, 'categories', [
      'name' => 'Ботинки']
  );
  $categories_insert_id = insert_data($link, 'categories', [
      'name' => 'Одежда']
  );
  $categories_insert_id = insert_data($link, 'categories', [
      'name' => 'Инструменты']
  );
  $categories_insert_id = insert_data($link, 'categories', [
      'name' => 'Разное']
  );

  $categories_fetched = select_data($link, $categories_sql, []);

  if (!$categories_fetched) {
    mysqli_close($link);

    $error = mysqli_connect_error();

    print include_template('templates/404.php',[
      'container' => $container,
      'error' => $error
    ]);
    exit();

  }

  $categories = makeAssocArray($categories_fetched, $categories_eng, 'name');

  if (empty($categories)) {
    mysqli_close($link);

    $error = 'Can\'t resolve categories list';

    print include_template('templates/404.php',[
      'container' => $container,
      'error' => $error
    ]);
    exit();

  }
}

if (!empty($is_auth)) {
  $user = $_SESSION['form_data']['user'];
  $user_name = $user['name'];

  // Unset open password for security reasons
  unset($_SESSION['form_data']['email']);
  unset($_SESSION['form_data']['password']);
}

if (isset($_GET['is_register'])) {
  if ($_GET['is_register'] === 'true') {
    $is_register = true;

    // Add current timestamp in MySQL format
    $date_add = convertTimeStampMySQL(
      strtotime('now'));

    $_SESSION['form_data']['date_add'] = $date_add;

    $name = $_SESSION['form_data']['name'];
    $email = $_SESSION['form_data']['email'];

    $password = $_SESSION['form_data']['password'];
    $contacts = $_SESSION['form_data']['contacts'];

    $date_add = $_SESSION['form_data']['date_add'];
    $url = $_SESSION['form_data']['url'];

    $user_insert_id = insert_data($link, 'users', [
        'name' => $name, 'email' => $email, 'password' => $password,
        'contacts' => $contacts, 'date_add' => $date_add, 'url' => $url
      ]
    );

    if (!is_int($user_insert_id)) {
      mysqli_close($link);

      $error = mysqli_connect_error() . 'Can\'t insert user';

      print include_template('templates/404.php',[
        'container' => $container,
        'error' => $error
      ]);
      exit();

    }

    $_SESSION['form_data']['user'] = $_SESSION['form_data'];
    $is_auth = true;



  } elseif ($_GET['is_register'] === 'false') {
    $is_register = false;
  }
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


if (isset($_SESSION['form_data'])) {
  $form_data = $_SESSION['form_data'];

  if (is_bool($lot_added)) {
    $form_defaults['lot']['input'] =
      $form_data['lot'] ? $form_data['lot'] : '';

    $form_defaults['category']['input'] =
      $form_data['category'] ? $form_data['category'] : '';

    $form_defaults['description']['input'] =
      $form_data['description'] ? $form_data['description'] : '';

    $form_defaults['rate']['input'] =
      $form_data['rate'] ? $form_data['rate'] : '';

    $form_defaults['step']['input'] =
      $form_data['step'] ? $form_data['step'] : '';

    $form_defaults['date_end']['input'] =
      $form_data['date_end'] ? $form_data['date_end'] : '';

    // If is_auth is NOT empty, all data stored
    // in $_SESSION['form_data']['user']
  } elseif (empty($is_auth) && is_bool($is_login)) {

    $form_defaults['email']['input'] =
      $form_data['email'] ? $form_data['email'] : '';

    $form_defaults['password']['input'] =
      $form_data['password'] ? $form_data['password'] : '';

  } elseif (empty($is_auth) && is_bool($is_register)) {

    $form_defaults['email']['input'] =
      $form_data['email'] ? $form_data['email'] : '';

    $form_defaults['password']['input'] =
      $form_data['password'] ? $form_data['password'] : '';

    $form_defaults['name']['input'] =
      $form_data['name'] ? $form_data['name'] : '';

    $form_defaults['contacts']['input'] =
      $form_data['contacts'] ? $form_data['contacts'] : '';

  }

  elseif (is_bool($bet_added)) {
    $form_defaults['bet']['input'] =
      $form_data['bet'] ? $form_data['bet'] : '';

  }
}
if (isset($_GET['bet_added'])) {
  $id = $_SESSION['form_data']['bet_id'];

  if ($_GET['bet_added'] === 'true') {
    $bet_added = true;
    $cookie_value = json_decode($cookie_value, true);

    $cookie_value[$id]['bet'] = $form_data['bet'];
    $cookie_value[$id]['date_add'] = strtotime('now');

    $cookie_value = json_encode($cookie_value);
    setcookie($cookie_name, $cookie_value, $expire, $path);
  } elseif ($_GET['bet_added'] === 'false') {
    $bet_added = false;
  }
}
// Set errors

if (is_bool($is_login) && $is_login === false) {
  $errors = $_SESSION['errors_login'];
}

if (is_bool($is_register) && $is_register === false) {
  $errors = $_SESSION['errors_register'];
  $errors['file'] = $_SESSION['errors_file'];

}

if (is_bool($lot_added) && $lot_added === false) {
  $errors = $_SESSION['errors_lot'];
  $errors['file'] = $_SESSION['errors_file'];

}

if (is_bool($bet_added) && $bet_added === false) {
  $errors = $_SESSION['errors_bet'];
}

if (!empty($is_nav)) {

  $nav = include_template('templates/nav.php', [
    'categories' => $categories
  ]);
}

if (is_bool($lot_added) && $lot_added === true) {
  $index = false;

  $lot = [
    'name' => $form_data['lot'], 'category' => $form_data['category'],
    'rate' => $form_data['rate'], 'step' => $form_data['step'],

    'date_end' => $form_data['date_end'], 'url' => $form_data['url'],
    'alt' => $form_data['alt'], 'description' => $form_data['description']
  ];
}

if (isset($_GET['id']) || is_bool($bet_added) && $bet_added === false) {
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

if (!empty($lot)) {
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
    'password' => $form_defaults['password'], 'all' => $form_defaults['all'],

    'name' => $form_defaults['name'], 'avatar' => $form_defaults['avatar'],
    'contacts' => $form_defaults['contacts'], 'errors' => $errors

  ]);
}

if (is_bool($is_register) && $is_register === true) {

//  var_dump($_SESSION);
}

if (isset($_GET['add']) || is_bool($lot_added) && $lot_added === false) {
  $index = false;
  $title = $add_lot_title;

  $form_defaults['category']['input'] = 'Выберите категорию';
  $content = include_template('templates/add-lot.php', [
    'nav' => $nav,
    'categories' => $categories, 'lot' => $form_defaults['lot'],

    'category' => $form_defaults['category'], 'photo' => $form_defaults['photo'],
    'rate' => $form_defaults['rate'], 'step' => $form_defaults['step'],

    'date_end' => $form_defaults['date_end'], 'all' => $form_defaults['all'],
    'description' => $form_defaults['description'], 'errors' => $errors

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



