<?
$title = 'Главная';
$error_title = 'This page is lost';

$add_lot_title = 'Добавление лота';
$container = 'main';

$form_defaults = [
  'name' => ['name' => 'name', 'title' => 'Имя*',
    'placeholder' => 'Введите имя', 'input' => ''
  ],
  'email' => ['name' => 'email', 'title' => 'E-mail*',
    'placeholder' => 'Введите e-mail', 'input' => ''
  ],
  'password' => ['name' => 'password', 'title' => 'Пароль*',
    'placeholder' => 'Введите пароль', 'input' => ''
  ],
  'contacts' => ['name' => 'contacts', 'title' => 'Контактные данные*',
    'placeholder' => 'Напишите как с вами связаться', 'input' => ''
  ],
  'avatar' => ['name' => 'avatar',
    'title' => 'Аватар', 'alt' => 'Ваш аватар'
  ],
  'photo' => ['name' => 'photo', 'title' => 'Изображение',
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
  'description' => ['name' => 'description', 'title' => 'Описание',
    'input' => '', 'placeholder' => 'Добавьте описание лота'
  ],
  'rate' => ['name' => 'rate',
    'title' => 'Начальная цена', 'input' => ''
  ],
  'step' => ['name' => 'step',
    'title' => 'Шаг ставки', 'input' => ''
  ],
  'date_end' => ['name' => 'date_end',
    'title' => 'Дата окончания торгов', 'input' => ''
  ],
  'all' => ['name' => 'all',
    'error_message' => 'Пожалуйста, исправьте ошибки в форме', 'input' => ''
  ]
];



