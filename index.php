<?php
require 'functions.php';
require 'config.php';
require 'data.php';

if(isset($_GET['id'])){
  var_dump($_GET);
}

$content = include_template('templates/index.php', [
  'categories' => $categories, 'items' => $items, 'lot_time_remaining' => $lot_time_remaining]);


print include_template('templates/layout.php', [
  'content' => $content, 'title' => $title, 'is_auth' => $is_auth,

  'user_avatar' => $user_avatar, 'user_name' => $user_name, 'categories' => $categories, 'year_now' => $year_now
]);

