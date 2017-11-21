<?php
$form_initial = [
  'lot-name' => ['name' => 'lot-name', 'title' => 'Наименование', 'error-message' => 'Введите наименование лота'],
  'category' => ['name' => 'category', 'title' => 'Категория', 'category-initial' => 'Выберите категорию', 'error-empty' => 'Выберите категорию'],

  'message' => ['name' => 'message', 'title' => 'Описание', 'error-empty' => 'Напишите описание лота'],
  'file' => ['name' => 'file', 'title' => 'Изображение', 'alt' => 'Изображение лота'],

  'lot-rate' => ['name' => 'lot-rate', 'title' => 'Начальная цена', 'error-empty' => 'Введите начальную цену'],
  'lot-step' => ['name' => 'lot-step', 'title' => 'Шаг ставки', 'error-empty' => 'Введите шаг ставки'],

  'lot-date' => ['name' => 'lot-date', 'title' => 'Дата окончания торгов', 'error-empty' => 'Введите дату завершения торгов'],
  'all' => ['name' => 'all', 'title' => 'Пожалуйста, исправьте ошибки в форме.']
];

$extracted = extract([
  'lot_name' => $form_initial['lot-name'], 'category' => $form_initial['category'],
  'message' => $form_initial['message'], 'file' => $form_initial['file'],

  'lot_rate' => $form_initial['lot-rate'], 'lot_step' => $form_initial['lot-step'],
  'lot_date' => $form_initial['lot-date'], 'all' => $form_initial['all']
]);