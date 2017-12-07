<?

$title = 'Главная';
$error_title = 'This page is lost';

$add_lot_title = 'Добавление лота';
$container = 'main';

$lot_default_description = 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег 
  мощным щелчком и четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, 
  наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в 
  сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. 
  А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску 
  и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.';


$categories = ['boards' => 'Доски и лыжи', 'attachment' => 'Крепления',
  'boots' => 'Ботинки', 'clothing' => 'Одежда', 'tools' => 'Инструменты', 'other' => 'Разное'
];

$lots = [
  ['name' => '2014 Rossignol District Snowboard', 'category' =>	'Доски и лыжи',
    'price' =>	10999, 'step' => 400, 'start_date' => null, 'end_date' => null,
    'img_url' =>	'img/lot-1.jpg', 'img_alt' => 'Сноуборд', 'description' => $lot_default_description
  ],
  ['name' => 'DC Ply Mens 2016/2017 Snowboard',  'category' => 'Доски и лыжи',
    'price' => 159999, 'step' => 500, 'start_date' => null, 'end_date' => null,
    'img_url' => 'img/lot-2.jpg', 'img_alt' => 'Сноуборд', 'description' => $lot_default_description
  ],
  ['name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
    'category' => 'Крепления', 'price' => 8000, 'step' => 400,
    'start_date' => null, 'end_date' => null, 'img_url' => 'img/lot-3.jpg',
    'img_alt' => 'Крепления', 'description' => $lot_default_description
  ],
  ['name' => 'Ботинки для сноуборда DC Mutiny Charocal',
    'category' => 'Ботинки', 'price' => 10999, 'step' => 500,
    'start_date' => null, 'end_date' => null, 'img_url' => 'img/lot-4.jpg',
    'img_alt' => 'Ботинки', 'description' => $lot_default_description
  ],
  ['name' => 'Куртка для сноуборда DC Mutiny Charocal',
    'category' => 'Одежда', 'price' => 7500, 'step' => 1000,
    'start_date' => null, 'end_date' => null, 'img_url' => 'img/lot-5.jpg',
    'img_alt' => 'Куртка', 'description' => $lot_default_description
  ],
  ['name' => 'Маска Oakley Canopy',  'category' => 'Разное',
    'price' => 5400, 'step' => 700, 'start_date' => null, 'end_date' => null,
    'img_url' => 'img/lot-6.jpg', 'img_alt' => 'Маска', 'description' => $lot_default_description
  ]
];

$form_defaults = [
  'name' => ['name' => 'name', 'title' => 'Имя*',
    'placeholder' => 'Введите имя', 'input_data' => ''
  ],
  'email' => ['name' => 'email', 'title' => 'E-mail*',
    'placeholder' => 'Введите e-mail', 'input_data' => ''
  ],
  'password' => ['name' => 'password', 'title' => 'Пароль*',
    'placeholder' => 'Введите пароль', 'input_data' => ''
  ],
  'contacts' => ['name' => 'contacts', 'title' => 'Контактные данные*',
    'placeholder' => 'Напишите как с вами связаться', 'input_data' => ''
  ],
  'user_file' => ['name' => 'user_file', 'title' => 'Аватар'
  ],
  'bet' => ['name' => 'bet', 'input_data' => ''
  ],
  'lot_name' => ['name' => 'lot_name', 'title' => 'Наименование',
    'input_data' => '', 'placeholder' => 'Введите наименование лота'
  ],
  'category' => ['name' => 'category',
    'title' => 'Категория', 'input_data' => 'Выберите категорию'
  ],
  'message' => ['name' => 'message', 'title' => 'Описание',
    'input_data' => '', 'placeholder' => 'Добавьте описание лота'
  ],
  'file' => ['name' => 'file', 'title' => 'Изображение',
    'alt' => 'Изображение лота', 'input_data' => ''
  ],
  'lot_rate' => ['name' => 'lot_rate',
    'title' => 'Начальная цена', 'input_data' => ''
  ],
  'lot_step' => ['name' => 'lot_step',
    'title' => 'Шаг ставки', 'input_data' => ''
  ],
  'lot_date' => ['name' => 'lot_date',
    'title' => 'Дата окончания торгов', 'input_data' => ''
  ],
  'all' => ['name' => 'all',
    'error_message' => 'Пожалуйста, исправьте ошибки в форме', 'input_data' => ''
  ]
];



