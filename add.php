<?php
session_start();
require 'functions.php';
require 'data/data.php';

$errors = [];
$lot_name = htmlspecialchars($_POST['name']) ?? '';
$category = $_POST['category'] ?? '';
$message = htmlspecialchars($_POST['message']) ?? '';

$_SESSION['form-data'] = $_POST;


if(!$errors){
  header('Location: index.php?success=true');
  array_push($post_data, 'sdfdsf');
}

