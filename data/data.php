<?php
$title = 'Главная';
$error_title = 'This page is lost';

$add_lot_title = 'Добавление лота';
$container = 'main';


$users = [
  [
    'email' => 'ignat.v@gmail.com',
    'name' => 'Игнат',
    'password' => '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'
  ],
  [
    'email' => 'kitty_93@li.ru',
    'name' => 'Леночка',
    'password' => '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa'
  ],
  [
    'email' => 'warrior07@mail.ru',
    'name' => 'Руслан',
    'password' => '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW'
  ]
];

$categories = ['boards' => 'Доски и лыжи', 'attachment' => 'Крепления', 'boots' => 'Ботинки',
  'clothing' => 'Одежда', 'tools' => 'Инструменты', 'other' => 'Разное'];

$items = [
  ['name' => '2014 Rossignol District Snowboard', 'category' =>	'Доски и лыжи',
    'price' =>	10999, 'img_url' =>	'img/lot-1.jpg', 'img_alt' => 'Сноуборд'],

  ['name' => 'DC Ply Mens 2016/2017 Snowboard',  'category' => 'Доски и лыжи',
    'price' => 159999, 'img_url' => 'img/lot-2.jpg', 'img_alt' => 'Сноуборд'],

  ['name' => 'Крепления Union Contact Pro 2015 года размер L/XL',  'category' => 'Крепления',
    'price' => 8000, 'img_url' => 'img/lot-3.jpg', 'img_alt' => 'Крепления'],

  ['name' => 'Ботинки для сноуборда DC Mutiny Charocal',  'category' => 'Ботинки',
    'price' => 10999, 'img_url' => 'img/lot-4.jpg', 'img_alt' => 'Ботинки'],

  ['name' => 'Куртка для сноуборда DC Mutiny Charocal',  'category' => 'Одежда',
    'price' => 7500, 'img_url' => 'img/lot-5.jpg', 'img_alt' => 'Куртка'],

  ['name' => 'Маска Oakley Canopy',  'category' => 'Разное',
    'price' => 5400, 'img_url' => 'img/lot-6.jpg', 'img_alt' => 'Маска']
];




