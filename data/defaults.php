<?
$title = 'Главная';
$error_title = 'This page is lost';

$add_lot_title = 'Добавление лота';
$container = 'main';

$form_defaults = [
  // Login
  'login' => [
    'email' => ['title' => 'E-mail*',
      'placeholder' => 'Введите e-mail', 'input' => ''
    ],
    'password' => ['title' => 'Пароль*',
      'placeholder' => 'Введите пароль', 'input' =>''
    ],
  ],
  // Register
  'register' => [
    'name' => ['title' => 'Имя*',
      'placeholder' => 'Введите имя', 'input' => ''
    ],
    'email' => ['title' => 'E-mail*',
      'placeholder' => 'Введите e-mail', 'input' => ''
    ],
    'password' => ['title' => 'Пароль*',
      'placeholder' => 'Введите пароль', 'input' =>''
    ],
    'contacts' => [
      'title' => 'Контактные данные*',
      'placeholder' => 'Напишите как с вами связаться', 'input' => ''
    ],
    'avatar' => [
      'title' => 'Аватар', 'alt' => 'Ваш аватар'
    ],
  ],
  // Add lot
  'lot_add' => [
    'name' => ['title' => 'Наименование',
      'input' => '', 'placeholder' => 'Введите наименование лота'
    ],
    'description' => ['title' => 'Описание',
      'input' => '', 'placeholder' => 'Добавьте описание лота'
    ],
    'photo' => ['title' => 'Изображение',
      'alt' => 'Изображение лота', 'input' => ''
    ],
    'category' => [
      'title' => 'Категория', 'input' => 'Выберите категорию'
    ],
    'rate' => ['title' => 'Начальная цена', 'input' => ''
    ],
    'step' => ['title' => 'Шаг ставки', 'input' => ''
    ],
    'date_end' => ['title' => 'Дата завершения торгов',
      'input' => '']
  ],
  // Add bet
  'bet_add' => [
    'bet' => ['input' => '']
  ]
];



