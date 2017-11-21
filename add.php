<?php
session_start();
require 'functions.php';

$error_messages = [];

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
  $error_messages[$lot_step] = 'Ставка больше цены';

}

if(!count($error_messages)){
  $_SESSION['form-data'] = $_POST;

  header('Location: index.php?success=true');
}

