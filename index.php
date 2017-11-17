<?php
require 'functions.php';
require 'config.php';
require 'data.php';

$content = include_template('templates/index.php',
  compact('categories', 'items', 'lot_time_remaining'));

print include_template('templates/layout.php',
  compact('content', 'title', 'is_auth', 'user_avatar', 'user_name', 'categories', 'year_now'));
