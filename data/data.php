<?
$title = 'Главная';
$error_title = 'This page is lost';

$add_lot_title = 'Добавление лота';
$container = 'main';

$form_defaults = [
  'user' => ['name' => 'user', 'title' => 'Имя*',
    'placeholder' => 'Введите имя', 'input' => ''
  ],
  'user_email' => ['name' => 'user_email', 'title' => 'E-mail*',
    'placeholder' => 'Введите e-mail', 'input' => ''
  ],
  'user_password' => ['name' => 'user_password', 'title' => 'Пароль*',
    'placeholder' => 'Введите пароль', 'input' => ''
  ],
  'user_contacts' => ['name' => 'user_contacts', 'title' => 'Контактные данные*',
    'placeholder' => 'Напишите как с вами связаться', 'input' => ''
  ],
  'user_avatar' => ['name' => 'user_avatar',
    'title' => 'Аватар', 'alt' => 'Ваш аватар'
  ],
  'lot_photo' => ['name' => 'lot_photo', 'title' => 'Изображение',
    'alt' => 'Изображение лота', 'input' => ''
  ],
  'bet' => ['name' => 'bet', 'input' => ''
  ],
  'lot' => ['name' => 'lot', 'title' => 'Наименование',
    'input' => '', 'placeholder' => 'Введите наименование лота'
  ],
  'category' => ['name' => 'category',
    'title' => 'Категория', 'input' => 'Выберите категорию'
  ],
  'lot_description' => ['name' => 'lot_description', 'title' => 'Описание',
    'input' => '', 'placeholder' => 'Добавьте описание лота'
  ],
  'lot_rate' => ['name' => 'lot_rate',
    'title' => 'Начальная цена', 'input' => ''
  ],
  'lot_step' => ['name' => 'lot_step',
    'title' => 'Шаг ставки', 'input' => ''
  ],
  'lot_date_end' => ['name' => 'lot_date_end',
    'title' => 'Дата окончания торгов', 'input' => ''
  ],
  'all' => ['name' => 'all',
    'error_message' => 'Пожалуйста, исправьте ошибки в форме', 'input' => ''
  ]
];



