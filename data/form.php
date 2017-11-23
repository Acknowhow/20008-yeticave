<?php
$form = [
  'lot-name' => ['name' => 'lot-name', 'title' => 'Наименование', 'error-message' => 'Введите наименование лота'],
  'category' => ['name' => 'category', 'title' => 'Категория', 'option-initial' => 'Выберите категорию', 'error-message' => 'Выберите категорию'],

  'message' => ['name' => 'message', 'title' => 'Описание', 'error-message' => 'Напишите описание лота'],
  'file' => ['name' => 'file', 'title' => 'Изображение', 'alt' => 'Изображение лота'],

  'lot-rate' => ['name' => 'lot-rate', 'title' => 'Начальная цена', 'error-message' => 'Введите начальную цену'],
  'lot-step' => ['name' => 'lot-step', 'title' => 'Шаг ставки', 'error-message' => 'Введите шаг ставки'],

  'lot-date' => ['name' => 'lot-date', 'title' => 'Дата окончания торгов', 'error-message' => 'Введите дату завершения торгов'],
  'all' => ['name' => 'all', 'error-message' => 'Пожалуйста, исправьте ошибки в форме.']
];
// Отсюда можно доставать сообщение об ошибке на основании переданной переменной
$form_errors = [
  'lot-name' => ['error-empty' => 'Введите наименование лота', 'error-format' => ''],
  'category' => ['error-empty' => 'Выберите категорию', 'error-format' => ''],

  'message' => ['error-empty' => 'Напишите описание лота', 'error-format' => ''],
  'file' => ['error-empty' => '', 'error-format' => ''],

  'lot-rate' => ['error-empty' => 'Введите начальную цену', 'error-format' => ''],
  'lot-step' => ['error-empty' => 'Введите шаг ставки', 'error-format' => ''],

  'lot-date' => ['error-empty' => 'Шаг ставки', 'error-format' => '', 'error-date' => ''],
  'all' => ['error-empty' => 'Пожалуйста, исправьте ошибки в форме.']
];