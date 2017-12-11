CREATE DATABASE yeti CHARACTER SET utf8 COLLATE utf8_bin;
use yeti;
CREATE TABLE categories (
  category_id INT auto_increment NOT NULL PRIMARY KEY,
  name VARCHAR(127) unique key
);
CREATE TABLE users (
  user_id INT auto_increment NOT NULL PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255) unique key,
  password CHAR(72),
  url VARCHAR(255),
  date_add TIMESTAMP,
  contacts VARCHAR(127),
  winner_id INT not null,
  is_deleted TINYINT default 0
);
CREATE TABLE bets (
  bet_id INT auto_increment NOT NULL PRIMARY KEY,
  value INT,
  date_add TIMESTAMP,
  user_id INT not null,
  is_open TINYINT default 0,
  is_win TINYINT default 0,
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE lots (
  lot_id INT auto_increment NOT NULL PRIMARY KEY,
  name VARCHAR(127),
  date_add TIMESTAMP,
  date_end TIMESTAMP,
  description VARCHAR(1500) default 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег
  мощным щелчком и четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях,
  наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в
  сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости.
  А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску
  и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.',
  url VARCHAR(127),
  rate INT,
  step INT,
  author_id INT not null,
  category_id INT not null,
  FOREIGN KEY (author_id) REFERENCES users(user_id),
  FOREIGN KEY (category_id) REFERENCES categories(category_id)
);
ALTER TABLE bets ADD lot_id INT not null AFTER bet_id;
ALTER TABLE bets ADD FOREIGN KEY (lot_id) REFERENCES lots(lot_id);