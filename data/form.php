<?php
$form = [
  'lot-name' => ['title' => 'Наименование', 'error-message' => 'Введите наименование лота'],

  'category' => ['title' => 'Категория', 'option-initial' => 'Выберите категорию',
    'error-message' => 'Выберите категорию'],

  'message' => ['title' => 'Описание', 'error-message' => 'Напишите описание лота'],

  'file' => ['title' => 'Изображение', 'alt' => 'Изображение лота'],
  'lot-rate' => ['title' => 'Начальная цена', 'error-message' => 'Введите начальную цену'],

  'lot-step' => ['title' => 'Шаг ставки', 'error-message' => 'Введите шаг ставки'],
  'lot-date' => ['title' => 'Дата окончания торгов', 'error-message' => 'Введите дату завершения торгов'],

  'all' => ['error-message' => 'Пожалуйста, исправьте ошибки в форме.']
];

$form_errors = [
  'lot-name' => ['error-empty' => 'Введите наименование лота', 'error-format' => ''],

  'category' => ['error-empty' => 'Выберите категорию', 'error-format' => ''],
  'message' => ['error-empty' => 'Напишите описание лота', 'error-format' => ''],

  'file' => ['error-empty' => '', 'error-format' => ''],
  'lot-rate' => ['error-empty' => 'Введите начальную цену', 'error-format' => ''],

  'lot-step' => ['error-empty' => 'Введите шаг ставки', 'error-format' =>
    'Неправильный формат ставки', 'error-negative' => 'Значение меньше нуля',

    'error-value' => 'Цена больше максимального значения'],
  'lot-date' => ['error-empty' => 'Введите дату завершения торгов', 'error-format' =>

    'Неправильный формат даты', 'error-date' => 'Дата меньше текущего значения'],
  'all' => ['error-empty' => 'Пожалуйста, исправьте ошибки в форме.']
];