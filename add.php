<?
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
require 'functions.php';
require 'data/form.php';
require 'data/users.php';

require 'mysql_helper.php';
require 'init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_SESSION['form_data']['user'])) {
  http_response_code(403);
  die();
}

// Login + Register
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = null;

// Add lot
$lot = isset($_POST['lot']) ? $_POST['lot'] : '';
$category = $_POST['category'] === 'Выберите категорию' ?
  $_POST['category'] = '' : $_POST['category'];

$description = isset($_POST['description']) ? $_POST['description'] : '';
$rate = isset($_POST['rate']) ? $_POST['rate'] : '';

$step = isset($_POST['step']) ? $_POST['step'] : '';
$end = isset($_POST['end']) ? $_POST['end'] : '';

// Bet
$bet = isset($_POST['bet']) ? $_POST['bet'] : '';
$bet_id = isset($_POST['bet_id']) ? $_POST['bet_id'] : '';

$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];

// Form errors

$errors_login = [];
$errors_register = [];

$errors_lot = [];
$errors_bet = [];

$url_param = '';

$login = [
  'email', 'password', 'name'
];

$register = [
  'email' => ['validateEmail', 'searchUserByEmail'
  ], 'password'
];

$rules_register = [
  'email' => 'validateEmail', 'password' => 'validatePassword'
];

$required_lot = [
  'lot', 'category',
  'description', 'rate', 'step', 'end'
];

$rules_lot = [
  'rate' => 'validateLotRate',
  'step' => 'validateLotStep', 'end' => 'validateDate'
];

if (isset($_POST['lot'])) {
  if (isset($_FILES['photo'])) {
    $file = $_FILES['photo'];

    if ($file['error'] == 0) {
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
        $errors_lot['file']['error_message'] = $result;
      }
      $destination_path = $file_path . $file_name;
      move_uploaded_file($file_name_tmp, $destination_path);

      $form_data['lot_url'] = $file_url;
      $form_data['lot_alt'] = 'uploaded';

    } else {
      $errors_lot['file']['error_message'] = $form_errors['file']['error_empty'];

    }
  }

  foreach ($_POST as $key => $value) {
    if (in_array($key, $required_lot) && $value == '') {
      $errors_lot[$key]['error_message'] = $form_errors[$key]['error_empty'];
    }

    if (array_key_exists($key, $rules_lot)) {
      $result = call_user_func($rules_lot[$key], $value);

      if (!empty($result)) {
        $errors_lot[$key]['error_message'] = $result;
      }
    }
    $form_data[$key] = $value;
  }
}

if (isset($_POST['login'])) {
  foreach ($_POST as $key => $value) {
    if (in_array($key, $login) && $value == '') {
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
  $form_data['email'] = $email;
  $form_data['password'] = $password;
}

if (isset($_POST['register'])) {
  $form_data['email'] = [];
  $form_data['password'] = [];

  foreach ($_POST as $key => $value) {

    if (in_array($key, $login) && $value == '') {
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

    $form_data['email'] = $email;
  }

  if (!empty($_POST['password'])) {
    if (is_string($result = call_user_func('validatePassword', $_POST['password']))){
      $errors_register['password']['error_message'] = $result;

    }
    elseif (is_array($password = call_user_func('validatePassword', $_POST['password']))){
      $form_data['password'] = $password;
    }

  }
}

if (isset($_POST['bet'])) {
  if (empty($bet)) {
    $errors_bet['value']['error_message'] = 'Пожалуйста, введите минимальное значение ставки';

  }
  $form_data['bet'] = $bet;
  $form_data['bet_id'] = $bet_id;
}

$_SESSION['form_data'] = $form_data;

if (isset($_POST['lot'])) {
  $_SESSION['errors_lot'] = $errors_lot;

  $result = count($errors_lot) ? 'false' : 'true';
  $url_param = 'lot_added=' . $result;
}

if (isset($_POST['login'])) {
  $_SESSION['errors_login'] = $errors_login;

  $result = count($errors_login) ? 'false' : 'true';
  $url_param = 'is_login=' . $result;
}

if (isset($_POST['bet'])) {
  $_SESSION['errors_bet'] = $errors_bet;

  $result = count($errors_bet) ? 'false' : 'true';
  $url_param = 'bet_added=' . $result;
}

if (isset($_POST['register'])) {
  $_SESSION['errors_register'] = $errors_register;

  $result = count($errors_register) ? 'false' : 'true';
  $url_param = 'is_register=' . $result;
}

header('Location: index.php?' . $url_param);




