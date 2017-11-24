<?php
// Main data with current error message from $form_errors
$form = [
  'lot_name' => [
    'name' => 'lot-name', 'title' => 'Наименование',
    'error-message' => '', 'input-data' => ''
  ],
  'category' => [
    'name' => 'category',
    'title' => 'Категория',
    'option-default' => 'Выберите категорию',
    'error-message' => '', 'input-data' => ''
  ],
  'message' => [
    'name' => 'message', 'title' => 'Описание',
    'error-message' => '', 'input-data' => ''
  ],
  'file' => [
    'name' => 'file', 'title' => 'Изображение',
    'alt' => 'Изображение лота', 'input-data' => ''
  ],
  'lot_rate' => [
    'name' => 'lot-rate', 'title' => 'Начальная цена',
    'error-message' => '', 'input-data' => ''
  ],
  'lot_step' => [
    'name' => 'lot-step', 'title' => 'Шаг ставки',
    'error-message' => '', 'input-data' => ''
  ],
  'lot_date' => [
    'name' => 'lot-date',
    'title' => 'Дата окончания торгов', 'error-message' => '', 'input-data' => ''
  ],
  'all' => [
    'name' => 'all', 'error-message' => '', 'input-data' => ''
  ]
];

$form_errors = [
  'lot_name' => [
    'name' => 'lot-name',
    'error-empty' => 'Введите наименование лота', 'error-format' => ''
  ],
  'category' => [
    'name' => 'category',
    'error-empty' => 'Выберите категорию', 'error-format' => ''
  ],
  'message' => [
    'name' => 'message',
    'error-empty' => 'Напишите описание лота', 'error-format' => ''
  ],
  'file' => [
    'name' => 'file', 'error-empty' => '', 'error-format' => ''
  ],
  'lot_rate' => [
    'name' => 'lot-rate',
    'error-empty' => 'Введите начальную цену', 'error-format' => ''
  ],
  'lot_step' => [
    'name' => 'lot-step',
    'error-empty' => 'Введите шаг ставки', 'error-format' => 'Неправильный формат ставки',
    'error-negative' => 'Значение меньше нуля', 'error-value' => 'Цена выше максимального значения'
  ],

  'lot_date' => [
    'name' => 'lot-date', 'error-empty' => 'Введите дату завершения торгов',
    'error-format' => 'Неправильный формат даты', 'error-date' => 'Дата меньше текущего значения'
  ],
  'all' => ['name' => 'all', 'error-empty' => 'Пожалуйста, исправьте ошибки в форме.'],
];