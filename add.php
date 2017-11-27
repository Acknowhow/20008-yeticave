<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
require 'functions.php';
require 'data/form.php';

$lot_name = $_POST['lot_name'] ?? '';
$category = $_POST['category'] === 'Выберите категорию' ?
  $_POST['category'] = '' : $_POST['category'];

$message = $_POST['message'] ?? '';
$lot_rate = $_POST['lot_rate'] ?? '';

$lot_step = $_POST['lot_step'] ?? '';
$lot_date = $_POST['lot_date'] ?? '';

$error_state = [];
$form_data = [];

$required = [
  'lot_name', 'category', 'message',
  'lot_rate', 'lot_step', 'lot_date'
];

$rules = [
  'lot_rate' => 'validateLotRate',
  'lot_step' => 'validateLotStep', 'lot_date' => 'validateDate'
];


if($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
    $allowed = array(
      "jpeg" => "image/jpeg",
      "png" => "image/png"
    );

    $file_name = $_FILES['avatar']['name'];
    $file_name_tmp = $_FILES["avatar"]["tmp_name"];
    $file_type = $_FILES["avatar"]["type"];

    $file_size = $_FILES["avatar"]["size"];
    $file_path = __DIR__ . '/uploads/';
    $file_url = '/uploads/' . $file_name;




    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file_type = finfo_file($finfo, $file_name);

    $result = array_filter(array_values($allowed), function($value) use ($file_type) {
      return $value == $file_type;
    }, ARRAY_FILTER_USE_KEY);

    if(empty($result)) {
      return 'Пожалуйста, выберите файл правильного формата';
    }

    if($file_size > 200000) {
      return 'Максимальный размер файла: 200Кб';
    }

    $final_path = $file_path . $file_name;
    move_uploaded_file($file_name, $final_path);



  }


    foreach ($_POST as $key => $value) {

    if (in_array($key, $required) && $value == '') {
      $error_state[$key]['error_message'] = $form_errors[$key]['error_empty'];
    }

    if (array_key_exists($key, $rules)) {
      $result = call_user_func($rules[$key], $value);

      if (!empty($result)) {
         $error_state[$key]['error_message'] = $result;
       }

     } $form_data[$key] = $value;
  }
}



ob_start();
$_SESSION['form_data'] = $form_data;

if(!count($error_state)){
  header('Location: index.php?success=true');
}
if(count($error_state)){
  $_SESSION['error_state'] = $error_state;

  header('Location: index.php?success=false');
}


