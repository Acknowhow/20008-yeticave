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
    'lot_name' => [

      'error_empty' => 'Введите наименование лота'
    ],
    'lot_description' => [

      'error_empty' => 'Добавьте описание лота'
    ],
    'lot_photo' => [

      'error_empty' => 'Добавьте изображение лота'
    ],
    'lot_category' => [

      'error_empty' => 'Выберите категорию'
    ],
    'lot_rate' => [

      'error_empty' => ''
    ],
    'lot_step' => [

      'error_empty' => ''
    ],
    'lot_date' => [

      'error_empty' => 'Введите дату завершения торгов',
      'error_format' => 'Неправильный формат даты', 'error_date' => 'Дата меньше текущего значения'
    ]
  ],
  // Add bet
  'bet_add' => [
    'bet' => [

      'error_empty' => ''
    ]
  ]
];
