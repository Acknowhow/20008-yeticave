<?php
$index_title = 'Главная';
$error_title = 'This page is lost';

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
['name' => '2014 Rossignol District Snowboard', 'category_name' =>	'Доски и лыжи',
  'price' =>	10999, 'img_url' =>	'img/lot-1.jpg', 'img_alt' => 'Сноуборд'],

['name' => 'DC Ply Mens 2016/2017 Snowboard',  'category_name' => 'Доски и лыжи',
'price' => 159999, 'img_url' => 'img/lot-2.jpg', 'img_alt' => 'Сноуборд'],

['name' => 'Крепления Union Contact Pro 2015 года размер L/XL',  'category_name' => 'Крепления',
'price' => 8000, 'img_url' => 'img/lot-3.jpg', 'img_alt' => 'Крепления'],

['name' => 'Ботинки для сноуборда DC Mutiny Charocal',  'category_name' => 'Ботинки',
'price' => 10999, 'img_url' => 'img/lot-4.jpg', 'img_alt' => 'Ботинки'],

['name' => 'Куртка для сноуборда DC Mutiny Charocal',  'category_name' => 'Одежда',
'price' => 7500, 'img_url' => 'img/lot-5.jpg', 'img_alt' => 'Куртка'],

['name' => 'Маска Oakley Canopy',  'category_name' => 'Разное',
'price' => 5400, 'img_url' => 'img/lot-6.jpg', 'img_alt' => 'Маска']
];

$bets = [
  ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
  ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
  ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
  ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];

$lot_text = [
  'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег 
  мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, 
  наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в 
  сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. 
  А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску 
  и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.'
];


