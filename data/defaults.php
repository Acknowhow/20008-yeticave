<?
$title = 'Главная';
$error_title = 'This page is lost';

$add_lot_title = 'Добавление лота';
$container = 'main';

$form_defaults = [
  // Login
  'login' => [
    'user_email' => ['title' => 'E-mail*',
      'placeholder' => 'Введите e-mail', 'input' => ''
    ],
    'user_password' => ['title' => 'Пароль*',
      'placeholder' => 'Введите пароль', 'input' =>''
    ],
  ],
  // Register
  'register' => [
    'user_email' => ['title' => 'E-mail*',
      'placeholder' => 'Введите e-mail', 'input' => ''
    ],
    'user_password' => ['title' => 'Пароль*',
      'placeholder' => 'Введите пароль', 'input' =>''
    ],
    'user_name' => ['title' => 'Имя*',
      'placeholder' => 'Введите имя', 'input' => ''
    ],
    'user_contacts' => [
      'title' => 'Контактные данные*',
      'placeholder' => 'Напишите как с вами связаться', 'input' => ''
    ],
    'user_avatar' => [
      'title' => 'Аватар', 'alt' => 'Ваш аватар'
    ],
  ],
  // Add lot
  'lot_add' => [
    'lot_name' => ['title' => 'Наименование',
      'input' => '', 'placeholder' => 'Введите наименование лота'
    ],
    'lot_description' => ['title' => 'Описание',
      'input' => '', 'placeholder' => 'Добавьте описание лота'
    ],
    'lot_photo' => ['title' => 'Изображение',
      'alt' => 'Изображение лота', 'input' => ''
    ],
    'lot_category' => [
      'title' => 'Категория', 'input' => 'Выберите категорию'
    ],
    'lot_rate' => ['title' => 'Начальная цена', 'input' => ''
    ],
    'lot_step' => ['title' => 'Шаг ставки', 'input' => ''
    ]
  ],
  // Add bet
  'bet_add' => [
    'bet' => ['input' => '']
  ]
];



