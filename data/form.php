<?php
// Main data with current error message from $form_errors
$form = [
  'lot_name' => ['name' => 'lot-name', 'title' => 'Наименование',
    'error-message' => 'Введите наименование лота', 'input-data' => ''],

  'category' => ['name' => 'category', 'title' => 'Категория',
    'option-default' => 'Выберите категорию',
    'error-message' => 'Выберите категорию', 'input-data' => ''],

  'message' => ['name' => 'message', 'title' => 'Описание',
    'error-message' => 'Напишите описание лота', 'input-data' => ''],

  'file' => ['name' => 'file', 'title' => 'Изображение',
    'alt' => 'Изображение лота', 'input-data' => ''],

  'lot_rate' => ['name' => 'lot-rate', 'title' => 'Начальная цена',
    'error-message' => 'Введите начальную цену', 'input-data' => ''],

  'lot_step' => ['name' => 'lot-step', 'title' => 'Шаг ставки',
    'error-message' => 'Введите шаг ставки', 'input-data' => ''],

  'lot_date' => ['name' => 'lot-date', 'title' => 'Дата окончания торгов',
    'error-message' => 'Введите дату завершения торгов', 'input-data' => ''],

  'all' => ['name' => 'all',
    'error-message' => 'Пожалуйста, исправьте ошибки в форме.', 'input-data' => '']
];

$form_errors = [
  'all' => ['name' => 'all',
    'error-empty' => 'Пожалуйста, исправьте ошибки в форме.'],

  'lot_name' => ['name' => 'lot-name',
    'error-empty' => 'Введите наименование лота', 'error-format' => ''],

  'category' => ['name' => 'category',
    'error-empty' => 'Выберите категорию', 'error-format' => ''],

  'message' => ['name' => 'message',
    'error-empty' => 'Напишите описание лота', 'error-format' => ''],

  'file' => ['name' => 'file', 'error-empty' => '', 'error-format' => ''],

  'lot_rate' => ['name' => 'lot-rate', 'error-empty' => 'Введите начальную цену', 'error-format' => ''],

  'lot_step' => ['name' => 'lot-step', 'error-empty' => 'Введите шаг ставки',
    'error-format' => 'Неправильный формат ставки',
    'error-negative' => 'Значение меньше нуля', 'error-value' => 'Цена выше максимального значения'],

  'lot_date' => ['name' => 'lot-date', 'error-empty' => 'Введите дату завершения торгов',
    'error-format' => 'Неправильный формат даты', 'error-date' => 'Дата меньше текущего значения']
];