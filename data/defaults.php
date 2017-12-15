<?
$title = 'Главная';
$error_title = 'This page is lost';

$add_lot_title = 'Добавление лота';
$container = 'main';

$form_defaults = [
  // Login
  'login' => [
    'email' => ['name' => 'email', 'title' => 'E-mail*',
      'placeholder' => 'Введите e-mail', 'input' => ''
    ],
    'password' => ['name' => 'password', 'title' => 'Пароль*',
      'placeholder' => 'Введите пароль', 'input' =>''
    ],
  ],
  // Register
  'register' => [
    'name' => ['name' => 'name', 'title' => 'Имя*',
      'placeholder' => 'Введите имя', 'input' => ''
    ],
    'email' => ['name' => 'email', 'title' => 'E-mail*',
      'placeholder' => 'Введите e-mail', 'input' => ''
    ],
    'password' => ['name' => 'password', 'title' => 'Пароль*',
      'placeholder' => 'Введите пароль', 'input' =>''
    ],
    'contacts' => [
      'name' => 'contacts', 'title' => 'Контактные данные*',
      'placeholder' => 'Напишите как с вами связаться', 'input' => ''
    ],
    'url' => [
      'name' => 'url', 'title' => 'Аватар', 'alt' => 'Ваш аватар',
      'input' => ''
    ],
  ],
  // Add lot
  'lot_add' => [
    'lot' => ['name' => 'name', 'title' => 'Наименование',
      'input' => '', 'placeholder' => 'Введите наименование лота'
    ],
    'description' => ['name' => 'description', 'title' => 'Описание',
      'input' => '', 'placeholder' => 'Добавьте описание лота'
    ],
    'url' => ['name' => 'url', 'title' => 'Изображение',
      'alt' => 'Изображение лота', 'input' => ''
    ],
    'category' => [
      'name' => 'category', 'title' => 'Категория', 'input' => 'Выберите категорию'
    ],
    'rate' => ['name' => 'rate', 'title' => 'Начальная цена', 'input' => ''
    ],
    'step' => ['name' => 'step', 'title' => 'Шаг ставки', 'input' => ''
    ],
    'date_end' => ['name' => 'date_end', 'title' => 'Дата завершения торгов',
      'input' => '']
  ],
  // Add bet
  'bet_add' => [
    'bet' => ['name' => 'bet', 'input' => '']
  ]
];



