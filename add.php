<?php
// For faster validation checks
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

session_start();
require 'functions.php';
require 'data/form.php';

$lot_name = $_POST['lot_name'] ?? '';
$category = $_POST['category'] ?? '';

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

  'lot_step' => 'validateLotStep',
  'lot_date' => 'validateDate'
];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $key => $value) {

    if (in_array($key, $required) && $value == '') {
      $error_state[$key]['error_message'] = $form[$key]['error_empty'];
    }

    if (array_key_exists($key, $rules)) {
      $result = call_user_func($rules[$key], $value);

      if (!empty($result)) {
         $error_state[$key]['error_message'] = $result;
       }
     }
  }
}

ob_start();
if(!count($error_state)){
  foreach ($_POST as $key => $value){

    $form_data[$key] = $value;
  }

  $_SESSION['form_data'] = $form_data;
  header('Location: index.php?success=true');
}
if(count($error_state)){
  $_SESSION['error_state'] = $error_state;

  header('Location: index.php?success=false');
}


