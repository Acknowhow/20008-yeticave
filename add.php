<?
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
require 'functions.php';
require 'data/errors.php';
require 'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_SESSION['form_data']['user'])) {
  http_response_code(403);
  die();
}
$form_data = [];
$users = [];
$errors = [];

$name = isset($_POST['name']) ? $_POST['name'] : '';

$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$contacts = isset($_POST['contacts']) ? $_POST['contacts'] : '';

$category = isset($_POST['category']) ? $_POST['category'] : '';
$step = isset($_POST['step']) ? $_POST['step'] : '';
$bet = isset($_POST['bet']) ? $_POST['bet'] : '';

$bet_id = isset($_POST['id']) ? $_POST['id'] : '';
$date_end = isset($_POST['date_end']) ? $_POST['date_end'] : '';

$url_param = '';

$users_sql = 'SELECT * FROM users ORDER BY user_id ASC;';
if (!empty(select_data($link, $users_sql, []))) {

  $users = select_data($link, $users_sql, []);

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

if(isset($_POST['category'])) {
  $_POST['category'] === 'Выберите категорию' ?
    $_POST['category'] = '' : $_POST['category'];
}

$check_key = '';

$login_keys = [
  'email', 'password'
];

$lot_keys = [
  'name', 'description',
  'category', 'rate', 'step', 'date_end'
];

$register_keys = [
  'name', 'email', 'password', 'contacts'
];

$rules_register = [
  'email' => 'validateEmail', 'password' => 'validatePassword'
];

$rules_lot = [
  'rate' => 'validateLotRate',
  'step' => 'validateLotStep', 'date_end' => 'validateDate'
];

// Photo and avatar validates separately
if (!isset($_FILES)) {
  $file = $_FILES['url'];

    if (isset($_POST['lot_add']) && $file['error'] !== 0) {
      $errors['file'] = $form_errors['lot_add']['url']['empty'];

    }
    elseif ($file['error'] == 0) {
      $allowed = [
        'jpeg' => 'image/jpeg',
        'png' => 'image/png'
      ];
      $file_name = $file['name'];
      $file_name_tmp = $file['tmp_name'];

      $file_type = $file['type'];
      $file_size = $file['size'];

      $file_path = __DIR__ . '/img/';
      $file_url = 'img/' . $file_name;
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $file_type = finfo_file($finfo, $file_name);
      $result = validateUpload($allowed, $file_type, $file_size);

      if (!empty($result)) {
        $errors['file'] = $result;
      }
      $destination_path = $file_path . $file_name;
      move_uploaded_file($file_name_tmp, $destination_path);

      $form_data['file']['url'] = $file_url;
      $form_data['file']['alt'] = 'uploaded';

    }
}

if (isset($_POST['lot_add'])) {
  $check_key = 'lot_add';

  foreach ($_POST as $key => $value) {

    if (in_array($key, $lot_keys) && $value == '') {
      $errors[$check_key][$key] = $form_errors[$check_key][$key]['empty'];
    }

    if (array_key_exists($key, $rules_lot)) {
      $result = call_user_func($rules_lot[$key], $value);

      if (!empty($result)) {
        $errors[$check_key][$key] = $form_errors[$check_key][$key][$result];
      }
    }
    $form_data[$check_key][$key] = $value;
  }
}

if (isset($_POST['login'])) {
  $check_key = 'login';

  foreach ($_POST as $key => $value) {

    if (in_array($key, $login_keys) && $value == '') {
      $errors[$check_key][$key] = $form_errors[$check_key][$key]['empty'];
    }
    $form_data[$check_key][$key] = $value;
  }

  if (!empty($_POST['email']) && !empty($result = call_user_func(
      'validateEmail', $email))) {
    $errors[$check_key]['email'] = $form_errors[$check_key]['email'][$result];

  }
  if (!empty($_POST['password']) && is_string($validate = call_user_func(
      'validateUser', $email, $users, $password))) {
    $errors[$check_key]['password'] = $form_errors[$check_key]['password'][$validate];

  }

  if (!empty($_POST['password']) && is_array($validate = call_user_func(
      'validateUser', $email, $users, $password))) {
    $form_data['user'] = $validate;

  }
}

if (isset($_POST['register'])) {
  $check_key = 'register';

  foreach ($_POST as $key => $value) {
    if (in_array($key, $register_keys) && $value == '') {
      $errors[$check_key][$key] = $form_errors[$check_key][$key]['empty'];
    }

    $form_data[$check_key][$key] = $value;
  }

  if (!empty($_POST['email'])) {
    $key = 'email';

    if (!empty($result = call_user_func('validateEmail', $email)) ||
      !empty($result = call_user_func('searchUserByEmail', $email, $users, true))) {

      $errors[$check_key][$key] = $form_errors[$check_key][$key][$result];
    }
  }

  if (!empty($_POST['password'])) {
    $key = 'password';

    if (is_string($result = call_user_func('validatePassword', $password))){
      $errors[$check_key][$key] = $form_errors[$check_key][$key][$result];

    }
    elseif (is_array($password = call_user_func('validatePassword', $password))){
      $form_data[$check_key][$key] = $password[0];

    }
  }
}

if (isset($_POST['bet_add'])) {
  $check_key = 'bet_add';

  if (empty($bet)) {
    $errors[$check_key] = $form_errors[$check_key]['bet']['empty'];

  }
  $form_data[$check_key]['bet'] = $bet;
  $form_data[$check_key]['bet_id'] = $bet_id;
}

if(!empty($errors['lot_add']) || !empty($errors['register'])) {
  $errors['all'] = $form_errors['all'];
}

$_SESSION['form_data'] = $form_data;
$_SESSION['errors'] = $errors;

$result = count($errors[$check_key]) || isset($errors['file']) ?
  'false' : 'true';
$url_param = "is_$check_key=" . $result;

header('Location: index.php?' . $url_param);




