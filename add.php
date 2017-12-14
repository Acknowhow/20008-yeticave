<?
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
require 'functions.php';
require 'data/form.php';
require 'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_SESSION['form_data']['user'])) {
  http_response_code(403);
  die();
}
$users = [];

$users_sql = 'SELECT * FROM users ORDER BY user_id ASC;';
if (!empty(select_data($link, $users_sql, []))) {

  $users_fetched = select_data($link, $users_sql, []);
  $users = $users_fetched;

  if (empty($users)) {
    mysqli_close($link);

    $error = 'Can\'t resolve users list';

    print include_template('templates/404.php',[
      'container' => $container,
      'error' => $error
    ]);
    exit();

  }
}


// Login + Register
$user_name = isset($_POST['name']) ? $_POST['name'] : '';
$user_password = isset($_POST['password']) ? $_POST['password'] : '';

$user_contacts = isset($_POST['contacts']) ? $_POST['contacts'] : '';
$user_email = isset($_POST['email']) ? $_POST['email'] : '';


// Lot
$_POST['category'] === 'Выберите категорию' ?
  $_POST['category'] = '' : $_POST['category'];

$step = isset($_POST['step']) ? $_POST['step'] : '';
$end = isset($_POST['date_end']) ? $_POST['date_end'] : '';

// Bet
$bet = isset($_POST['bet']) ? $_POST['bet'] : '';
$bet_id = isset($_POST['bet_add']) ? $_POST['bet_add'] : '';

$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];

// Files
$file = [];
$file_params = isset($file['params']) ? $file['params'] : '';

// Form errors

$errors_file = [];
$errors_login = [];
$errors_register = [];

$errors_lot = [];
$errors_bet = [];

$url_param = '';

$login_keys = [
  'email', 'password'
];

$register_keys = [
  'email', 'password', 'name', 'contacts'
];

$rules_register = [
  'email' => 'validateEmail', 'password' => 'validatePassword'
];

$lot_keys = [
  'lot', 'category',
  'description', 'rate', 'step', 'date_end'
];

$rules_lot = [
  'rate' => 'validateLotRate',
  'step' => 'validateLotStep', 'date_end' => 'validateDate'
];


if (isset($_FILES)) {
  if (isset($_FILES['lot_photo'])) {
    $file['tag'] = 'lot_photo';
    $file_params = $_FILES['lot_photo'];
  }
  if (isset($_FILES['user_avatar'])) {
    $file['tag'] = 'user_avatar';
    $file_params = $_FILES['user_avatar'];
  }
}

// Also use this array for register form
if (isset($file_params['name'])) {

    if ($file_params['error'] == 0) {
      $allowed = [
        'jpeg' => 'image/jpeg',
        'png' => 'image/png'
      ];
      $file_name = $file_params['name'];
      $file_name_tmp = $file_params['tmp_name'];

      $file_type = $file_params['type'];
      $file_size = $file_params['size'];

      $file_path = __DIR__ . '/img/';
      $file_url = 'img/' . $file_name;
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $file_type = finfo_file($finfo, $file_name);
      $result = validateUpload($allowed, $file_type, $file_size);

      if (!empty($result)) {
        $errors_file['error_message'] = $result;
      }
      $destination_path = $file_path . $file_name;
      move_uploaded_file($file_name_tmp, $destination_path);

      $form_data['file']['url'] = $file_url;
      $form_data['file']['alt'] = 'uploaded';

    } elseif ($file['tag'] === 'lot_photo' && $file_params['error'] !== 0) {

      $errors_file['error_message'] = $form_errors['lot_photo']['error_empty'];

    }
}

if (isset($_POST['lot_add'])) {
  foreach ($_POST as $key => $value) {

    if (in_array($key, $lot_keys) && $value == '') {
      $errors_lot[$key]['error_message'] = $form_errors[$key]['error_empty'];
    }

    if (array_key_exists($key, $rules_lot)) {
      $result = call_user_func($rules_lot[$key], $value);

      if (!empty($result)) {
        $errors_lot[$key]['error_message'] = $result;
      }
    }
    $form_data['lot_add'][$key] = $value;
  }
}

if (isset($_POST['login'])) {

  foreach ($_POST as $key => $value) {

    if (in_array($key, $login_keys) && $value == '') {
      $errors_login[$key]['error_message'] = $form_errors[$key]['error_empty'];
    }
  }

  if (!empty($_POST['email']) && !empty($result = call_user_func(
      'validateEmail', $email))) {
    $errors_login['email']['error_message'] = $result;

  }
  if (!empty($_POST['password']) && is_string($validate = call_user_func(
      'validateUser', $email, $users, $password))) {
    $errors_login['password']['error_message'] = $validate;

  }

  if (!empty($_POST['password']) && is_array($validate = call_user_func(
      'validateUser', $email, $users, $password))) {
    $form_data['user'] = $validate;

  }
  $form_data['login']['email'] = $email;
  $form_data['login']['password'] = $password;
}

if (isset($_POST['register'])) {

  foreach ($_POST as $key => $value) {

    if (in_array($key, $register_keys) && $value == '') {
      $errors_register[$key]['error_message'] = $form_errors[$key]['error_empty'];
    }
  }

  if (!empty($_POST['email'])) {
    if (!empty($result = call_user_func('validateEmail', $email))) {
      $errors_register['email']['error_message'] = $result;

    } elseif (!empty($result = call_user_func(
      'searchUserByEmail', $email, $users, true))) {
      $errors_register['email']['error_message'] = $result;
    }

    $form_data['register']['email'] = $email;
  }

  if (!empty($_POST['password'])) {
    if (is_string($result = call_user_func('validatePassword', $password))){
      $errors_register['password']['error_message'] = $result;

    }
    elseif (is_array($password = call_user_func('validatePassword', $password))){
      $form_data['register']['password'] = $password;
    }
  }
  $form_data['register']['name'] = $name;
  $form_data['register']['contacts'] = $contacts;
}

if (isset($_POST['bet_add'])) {
  if (empty($bet)) {
    $errors_bet['error_message'] = 'Пожалуйста, введите минимальное значение ставки';

  }
  $form_data['bet_add']['bet_value'] = $bet;
  $form_data['bet_add']['bet_id'] = $bet_id;
}

$_SESSION['form_data'] = $form_data;

if (isset($form_data['lot_add'])) {
  $_SESSION['errors_lot'] = $errors_lot;
  $_SESSION['errors_file'] = $errors_file;

  $result = count($errors_lot) || count($errors_file) ? 'false' : 'true';
  $url_param = 'lot_added=' . $result;
}

if (isset($form_data['login'])) {
  $_SESSION['errors_login'] = $errors_login;

  $result = count($errors_login) ? 'false' : 'true';
  $url_param = 'is_login=' . $result;
}

if (isset($form_data['bet_add'])) {
  $_SESSION['errors_bet'] = $errors_bet;

  $result = count($errors_bet) ? 'false' : 'true';
  $url_param = 'bet_added=' . $result;
}

if (isset($form_data['register'])) {
  $_SESSION['errors_register'] = $errors_register;
  $_SESSION['errors_file'] = $errors_file;

  $result = count($errors_register) ? 'false' : 'true';
  $url_param = 'is_register=' . $result;
}

header('Location: index.php?' . $url_param);




