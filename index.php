<?php
require 'functions.php';
require 'config.php';
require 'data.php';

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $lot = include_template('lot.php', [
    'bets' => $bets
  ]);
}

$index = include_template('templates/index.php', [
  'categories' => $categories, 'items' => $items, 'lot_time_remaining' => $lot_time_remaining]);


print include_template('templates/layout.php', [
  'index' => $index, 'lot' => $lot, 'title' => $title, 'is_auth' => $is_auth,

  'user_avatar' => $user_avatar, 'user_name' => $user_name, 'categories' => $categories, 'year_now' => $year_now
]);

