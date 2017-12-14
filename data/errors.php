<?

$form_errors = [
  // Login
  'login' => [
    'user_email' => [

      'error_empty' => 'Введите email'
    ],
    'user_password' => [

      'error_empty' => 'Введите пароль'
    ]
  ],
  // Register
  'register' => [
    'user_email' => [

      'error_empty' => 'Введите email'
    ],
    'user_password' => [

      'error_empty' => 'Введите пароль'
    ],
    'user_name' => [

      'error_empty' => 'Введите ваше имя'
    ],
    'user_contacts' => [

      'error_empty' => 'Напишите как с вами связаться'
    ]

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
$form_errors = [


  'user_contacts' => [
    'name' => 'user_contacts',
  ],

  'lot_photo' => [
    'name' => 'lot_photo', 'error_empty' => 'Добавьте изображение лота'
  ],
  'lot' => [
    'name' => 'lot_name', 'error_empty' => 'Введите наименование лота'
  ],
  'category' => [
    'name' => 'category', 'error_empty' => 'Выберите категорию'
  ],
  'lot_description' => [
    'name' => 'lot_description', 'error_empty' => 'Добавьте описание лота'
  ],
  'lot_rate' => [
    'name' => 'lot_rate', 'error_empty' => ''
  ],
  'lot_step' => [
    'name' => 'lot_step', 'error_empty' => ''
  ],
  'lot_date_end' => [
    'name' => 'lot_date_end', 'error_empty' => 'Введите дату завершения торгов',
    'error_format' => 'Неправильный формат даты', 'error_date' => 'Дата меньше текущего значения'
  ]
];