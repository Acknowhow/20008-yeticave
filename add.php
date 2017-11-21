<?php
session_start();
require 'functions.php';

$errors = [];

$lot_name = htmlspecialchars($_POST['lot-name']) ?? '';
$category_name = $_POST['category'] ?? '';
$message = htmlspecialchars($_POST['message']) ?? '';


$lot_rate = $_POST['lot-rate'] ?? '';
$lot_step = $_POST['lot-step'] ?? '';
$lot_date = $_POST['lot-date'] ?? '';

$required = [
  'lot_name', 'category_name', 'message',
  'lot_rate', 'lot_step', 'lot_date'
];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  foreach ($_POST as $key => $value) {

    if (in_array($key, $required) && $value == '') {
      $errors[] = $key;

      break;
    }

    if (array_key_exists($key, $rules)) {
      $result = call_user_func($rules[$key], $value);

      if (!$result) {
        $errors[] = $key;
      }
    }
  }
}


if(!count($errors)){
  $_SESSION['form-data'] = $_POST;

  header('Location: index.php?success=true');
}

