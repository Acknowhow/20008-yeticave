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

// Remake into simple array, and build id's into strings
$categories = [
  'Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'
];

$lots = [
  ['name' => '2014 Rossignol District Snowboard', 'category' =>	'Доски и лыжи',
    'rate' =>	10999, 'step' => 400, 'start' => null, 'end' => null,
    'url' =>	'img/lot-1.jpg', 'alt' => 'Сноуборд', 'description' => $lot_default_description
  ],
  ['name' => 'DC Ply Mens 2016/2017 Snowboard',  'category' => 'Доски и лыжи',
    'rate' => 159999, 'step' => 500, 'start' => null, 'end' => null,
    'url' => 'img/lot-2.jpg', 'alt' => 'Сноуборд', 'description' => $lot_default_description
  ],
  ['name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
    'category' => 'Крепления', 'rate' => 8000, 'step' => 400,
    'start' => null, 'end' => null, 'url' => 'img/lot-3.jpg',
    'alt' => 'Крепления', 'description' => $lot_default_description
  ],
  ['name' => 'Ботинки для сноуборда DC Mutiny Charocal',
    'category' => 'Ботинки', 'rate' => 10999, 'step' => 500,
    'start' => null, 'end' => null, 'url' => 'img/lot-4.jpg',
    'alt' => 'Ботинки', 'description' => $lot_default_description
  ],
  ['name' => 'Куртка для сноуборда DC Mutiny Charocal',
    'category' => 'Одежда', 'rate' => 7500, 'step' => 1000,
    'start' => null, 'end' => null, 'url' => 'img/lot-5.jpg',
    'alt' => 'Куртка', 'description' => $lot_default_description
  ],
  ['name' => 'Маска Oakley Canopy',  'category' => 'Разное',
    'rate' => 5400, 'step' => 700, 'start' => null, 'end' => null,
    'url' => 'img/lot-6.jpg', 'alt' => 'Маска', 'description' => $lot_default_description
  ]
];

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
  'avatar' => ['name' => 'avatar', 'title' => 'Аватар'
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
  'photo' => ['name' => 'photo', 'title' => 'Изображение',
    'alt' => 'Изображение лота', 'input' => ''
  ],
  'rate' => ['name' => 'rate',
    'title' => 'Начальная цена', 'input' => ''
  ],
  'step' => ['name' => 'step',
    'title' => 'Шаг ставки', 'input' => ''
  ],
  'date' => ['name' => 'date',
    'title' => 'Дата окончания торгов', 'input' => ''
  ],
  'all' => ['name' => 'all',
    'error_message' => 'Пожалуйста, исправьте ошибки в форме', 'input' => ''
  ]
];



