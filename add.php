<?php
session_start();
require 'functions.php';
$errors = [];

$message = htmlspecialchars($_POST['message']) ?? '';
$lot_name = htmlspecialchars($_POST['lot-name']) ?? '';
$lot_rate = $_POST['lot-rate'] ?? '';
$lot_step = $_POST['lot-step'] ?? '';
$lot_date = $_POST['lot-date'] ?? '';




if(!$errors){
  $_SESSION['form-data'] = $_POST;

  header('Location: index.php?success=true');
}

