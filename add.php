<?php
session_start();
require 'functions.php';

$lot_name = $_POST['lot-name'] ?? '';
$category = $_POST['category'] ?? '';

$message = $_POST['message'] ?? '';
$lot_rate = $_POST['lot-rate'] ?? '';

$lot_step = $_POST['lot-step'] ?? '';
$lot_date = $_POST['lot-date'] ?? '';

$error_messages = [];
$form_data = [];

$required = [
  'lot-name', 'category', 'message',
  'lot-rate', 'lot-step', 'lot-date'
];

$rules = [
  'lot-rate' => 'validateNumericValue',
  'lot-date' => 'validateDate'
];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $key => $value) {

    if (in_array($key, $required) && $value == '') {
      $error_messages[$key] = '';

      break; // Only one message if several errors
    }

    // If the date is in wrong format need to figure
    // out which string message to return
    if (array_key_exists($key, $rules)) {
      $result = call_user_func($rules[$key], $value);

      if (!empty($result)) {
        $error_messages[$key] = $result;
      }
    }
  }
}

ob_start();
if(!count($error_messages)){
  foreach ($_POST as $key => $value){

    $form_data[$key] = $value;
  }

  $_SESSION['form-data'] = $form_data;
  header('Location: index.php?success=true');
}
if(count($error_messages)){
  $_SESSION['error-messages'] = $error_messages;

  header('Location: index.php?success=false');
}


