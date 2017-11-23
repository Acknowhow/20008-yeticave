<?php
session_start();
require 'functions.php';

$error_messages = [];
$form_data = [];

$lot_name = htmlspecialchars($_POST['lot-name']) ?? '';
$category_name = $_POST['category'] ?? '';
$message = htmlspecialchars($_POST['message']) ?? '';

// Start price
$lot_rate = $_POST['lot-rate'] ?? '';
$lot_step = $_POST['lot-step'] ?? '';

$lot_date = $_POST['lot-date'] ?? '';
$required = [
  'lot-name', 'category', 'message',
  'lot-rate', 'lot-step', 'lot-date'
];

$rules = ['lot-rate' => 'validateNumericValue', 'lot-date' => 'validateDate'];

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

      if (is_string($result)) { // if the result is string or not
        $error_messages[$key] = $result;
      }
    }
  }
}


if(!count($error_messages)){
  // Better to use for cycle or for.. of
  // Or maybe use array map
  array_push(
    $form_data, $lot_name, $category_name,

    $message, $lot_rate, $lot_step, $lot_date
  );

  $_SESSION['form-data'] = $form_data;
  header('Location: index.php?success=true');
}
if(count($error_messages)){
  $_SESSION['error-messages'] = $error_messages;

  header('Location: index.php?success=false');
}


