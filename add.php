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

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $key => $value) {

    if (in_array($key, $required) && $value == '') {
      $error_messages[$key] = '';

      break;
    }

    if (array_key_exists($key, $rules)) {
      $result = call_user_func($rules[$key], $value);

      if (is_string($result)) { // is string or numeric
        $error_messages[$key] = $result;
      }
    }
  }
}

if($lot_step > $lot_rate){
  $error_messages[$lot_step] = 'Ставка превышает цену';
}
if(!count($error_messages)){
  $to_push = extract([
    'lot-name' => $lot_name, 'category' => $category_name, 'message' => $message,
    'lot-rate' => $lot_rate, 'lot-step' => $lot_step, 'lot-date' => $lot_date
    ]);

  array_push(
    $form_data, $lot_name, $category_name,
    $message, $lot_rate, $lot_step, $lot_date
  );

  $_SESSION['form-data'] = $form_data;

  header('Location: index.php?success=true');
}
if(count($error_messages)){
  $_SESSION['error-messages'] = $error_messages;
}
header('Location: index.php?success=false');

