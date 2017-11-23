<?php
header('Content-Type: text/html; charset=utf8');
session_start();
require 'functions.php';

$lot_name = $category_name = $message
  = $lot_rate = $lot_step = $lot_date = '';

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

function test_input($field) {
  $field = htmlspecialchars($field);

  return $field;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $lot_name = test_input($_POST['lot-name']);

  echo(htmlspecialchars($lot_name));
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

//if(!count($error_messages)){
//  // Better to use for cycle or for.. of
//  // Or maybe use array map
//
//  array_push(
//    $form_data, $lot_name, $category_name,
//    $message, $lot_rate, $lot_step, $lot_date
//  );
//
//  $_SESSION['form-data'] = $form_data;
//  header('Location: index.php?success=true');
//}
//if(count($error_messages)){
//  $_SESSION['error-messages'] = $error_messages;
//
//  header('Location: index.php?success=false');
//}
//
//
