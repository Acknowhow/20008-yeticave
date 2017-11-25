<?php
// Main data with current error message from $form_errors
$form = [
  'lot_name' => [
    'name' => 'lot_name', 'title' => 'Наименование',
    'error_message' => '', 'input_data' => ''
  ],
  'category' => [
    'name' => 'category',
    'title' => 'Категория',
    'option_default' => 'Выберите категорию',
    'error_message' => '', 'input_data' => ''
  ],
  'message' => [
    'name' => 'message', 'title' => 'Описание',
    'error_message' => '', 'input_data' => ''
  ],
  'file' => [
    'name' => 'file', 'title' => 'Изображение',
    'alt' => 'Изображение лота', 'input_data' => ''
  ],
  'lot_rate' => [
    'name' => 'lot_rate', 'title' => 'Начальная цена',
    'error_message' => '', 'input_data' => ''
  ],
  'lot_step' => [
    'name' => 'lot_step', 'title' => 'Шаг ставки',
    'error_message' => '', 'input_data' => ''
  ],
  'lot_date' => [
    'name' => 'lot_date',
    'title' => 'Дата окончания торгов', 'error_message' => '', 'input_data' => ''
  ],
  'all' => [
    'name' => 'all', 'error_message' => '', 'input_data' => ''
  ]
];

$form_errors = [
  'lot_name' => [
    'name' => 'lot_name', 'error_empty' => 'Введите наименование лота'
  ],
  'category' => [
    'name' => 'category', 'error_empty' => 'Выберите категорию'
  ],
  'message' => [
    'name' => 'message', 'error_empty' => 'Напишите описание лота'
  ],
  'file' => [
    'name' => 'file', 'error_empty' => ''
  ],
  'lot_rate' => [
    'name' => 'lot_rate', 'error_empty' => ''
  ],
  'lot_step' => [
    'name' => 'lot_step', 'error_empty' => ''
  ],
  'lot_date' => [
    'name' => 'lot_date', 'error_empty' => 'Введите дату завершения торгов',
    'error_format' => 'Неправильный формат даты', 'error_date' => 'Дата меньше текущего значения'
  ],
  'all' => [
    'name' => 'all', 'error_empty' => 'Пожалуйста, исправьте ошибки в форме.'
  ]
];