CREATE DATABASE yeti CHARACTER SET utf8 COLLATE utf8_bin;
use yeti;
CREATE TABLE category (
  category_id INT auto_increment NOT NULL PRIMARY KEY,
  category_name VARCHAR(127) unique key

);
CREATE TABLE users (
  user_id INT auto_increment NOT NULL PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255) unique key,
  password CHAR(60),
  img_url VARCHAR(255),
  date_registered TIMESTAMP,
  contact_info VARCHAR(127),
  winner_id INT default 0,
  is_deleted TINYINT default 0
);
CREATE TABLE bets (
  bet_id INT auto_increment NOT NULL PRIMARY KEY,
  value INT,
  date_created TIMESTAMP,
  user_id INT not null,
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE lots (
  lot_id INT auto_increment NOT NULL PRIMARY KEY,
  name VARCHAR(127),
  date_created TIMESTAMP,
  date_due TIMESTAMP,
  description VARCHAR(1500) default 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег
  мощным щелчком и четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях,
  наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в
  сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости.
  А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску
  и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.',
  img_url VARCHAR(127),
  price INT,
  lot_step INT,
  author_id INT not null,
  category_id INT not null,
  FOREIGN KEY (author_id) REFERENCES users(user_id),
  FOREIGN KEY (category_id) REFERENCES category(category_id)
);
ALTER TABLE bets ADD lot_id INT not null AFTER bet_id;
ALTER TABLE bets ADD FOREIGN KEY (lot_id) REFERENCES lots(lot_id);
