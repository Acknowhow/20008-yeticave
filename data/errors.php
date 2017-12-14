<?

$form_errors = [
  // Login
  'login' => [
    'email' => [

      'empty' => 'Введите email',
      'format' => 'Пожалуйста, укажите правильный формат email'
    ],
    'password' => [

      'error_empty' => 'Введите пароль',
      'match' => 'Вы указали неверный пароль или email',
      'invalid' => 'Пароль неверный'
    ]
  ],
  // Register
  'register' => [
    'email' => [

      'empty' => 'Введите email',
      'format' => 'Пожалуйста, укажите правильный формат email',
      'clone' => 'Указанный вами email уже зарегистрирован'
    ],
    'password' => [

      'empty' => 'Введите пароль',
      'length_short' =>
        'Пожалуйста, укажите не меньше 11 символов в вашем пароле',
      'length_long' => 'Длина пароля должна быть не больше 72 символов'
    ],
    'name' => [

      'empty' => 'Введите ваше имя'
    ],
    'contacts' => [

      'empty' => 'Напишите как с вами связаться'
    ],
    'url' => [

      'format' => 'Пожалуйста, выберите файл правильного формата',
      'size' => 'Максимальный размер файла: 200Кб'
    ]

  ],
  // Add lot
  'lot_add' => [
    'name' => [

      'error_empty' => 'Введите наименование лота'
    ],
    'description' => [

      'error_empty' => 'Добавьте описание лота'
    ],
    'url' => [

      'empty' => 'Добавьте изображение лота',
      'format' => 'Пожалуйста, выберите файл правильного формата',
      'size' => 'Максимальный размер файла: 200Кб'
    ],
    'category' => [

      'error_empty' => 'Выберите категорию'
    ],
    'rate' => [
      'empty' => 'Введите начальную цену',
      'numeric' => 'Введите числовое значение',
      'positive' => 'Введите число больше нуля'

    ],
    'step' => [
      'empty' => 'Введите шаг ставки',
      'integer' => 'Введите целое число',
      'positive' => 'Введите число больше нуля'

    ],
    'date' => [
      'empty' => 'Введите дату завершения торгов',

      'invalid' => 'Дата меньше текущего значения',
      'duration' => 'Срок размещения лота должен быть больше одного дня'
    ]
  ],
  // Add bet
  'bet_add' => [
    'bet' => [

      'empty' => 'Пожалуйста, введите минимальное значение ставки'
    ]
  ],
  'all' => 'Пожалуйста, исправьте ошибки в форме'
];
