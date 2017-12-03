<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
require 'functions.php';
require 'data/form.php';
require 'data/users.php';

if($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_SESSION['form_data']['user'])) {
  http_response_code(403);
  die();
}

// Login
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Add lot
$lot_name = isset($_POST['lot_name']) ? $_POST['lot_name'] : '';
$category = $_POST['category'] === 'Выберите категорию' ?
  $_POST['category'] = '' : $_POST['category'];

$message = isset($_POST['message']) ? $_POST['message'] : '';
$lot_rate = isset($_POST['lot_rate']) ? $_POST['lot_rate'] : '';

$lot_step = isset($_POST['lot_step']) ? $_POST['lot_step'] : '';
$lot_date = isset($_POST['lot_date']) ? $_POST['lot_date'] : '';

// Bet
$user_name = isset($_SESSION['form_data']['user']) ?
  $_SESSION['form_data']['user']['name'] : '';

$lot_id = isset($_GET['lot_id']) ? $_GET['lot_id'] : '';
$bet_value = isset($_POST['cost']) ? $_POST['cost'] : '';

$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];

// Form errors
$errors_lot = [];
$errors_user = [];
$errors_bet = [];

$url_param = '';

$required_user = [
  'email', 'password'
];

$rules_user = [
  'email' => 'validateEmail', 'password' => 'validateUser'
];

$required_lot = [
  'lot_name', 'category',
  'message', 'lot_rate', 'lot_step', 'lot_date'
];

$rules_lot = [
  'lot_rate' => 'validateLotRate',
  'lot_step' => 'validateLotStep', 'lot_date' => 'validateDate',
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['add_lot'])) {
  if (isset($_FILES['photo'])) {

    $file = $_FILES['photo'];

    if ($file["error"] == 0) {
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

  } $form_data[$key] = $value;
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['add_user'])) {
  foreach ($_POST as $key => $value) {

    if (in_array($key, $required_user) && $value == '') {
      $errors_user[$key]['error_message'] = $form_errors[$key]['error_empty'];
    }
  }

  if (!empty($result = call_user_func(
    'validateEmail', $email))) {
    $errors_user['email']['error_message'] = $result;
  }

  elseif (is_string($validate = call_user_func(
    'validateUser', $email, $users, $password))) {

    $errors_user['password']['error_message'] = $validate;
  }

  elseif (is_array($validate = call_user_func(
    'validateUser', $email, $users, $password))) {

    $form_data['user'] = $validate;
  }

  $form_data['email'] = $email;
  $form_data['password'] = $password;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['add_bet'])) {
  if(empty($bet_value)) {

    $errors_bet['value']['error_message'] = 'Пожалуйста, введите минимальное значение ставки';
  }

  $form_data['lot_id'] = $lot_id;
  $form_data['bet_value'] = $bet_value;

  $form_data['bet_time'] = strtotime('now');

}

$_SESSION['form_data'] = $form_data;

if (isset($_GET['add_lot'])) {
  $_SESSION['errors_lot'] = $errors_lot;

  $result = count($errors_lot) ? 'false' : 'true';
  $url_param = 'lot_added=' . $result;
}

if (isset($_GET['add_user'])) {
  $_SESSION['errors_user'] = $errors_user;

  $result = count($errors_user) ? 'false' : 'true';
  $url_param = 'user_added=' . $result;
}

if (isset($_GET['add_bet'])) {
  $_SESSION['errors_bet'] = $errors_bet;

  $result = count($errors_bet) ? 'false' : 'true';
  $url_param = 'bet_added=' . $result;
}

header('Location: index.php?' . $url_param);




