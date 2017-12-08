insert into categories(name) values('Доски и лыжи'), ('Крепления'), ('Ботинки'),
  ('Одежда'), ('Инструменты'), ('Разное');
select * from categories order by category_id ASC;
insert into users (name, email, password) values('Игнат', 'ignat.v@gmail.com', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'),
  ('Леночка', 'kitty_93@li.ru', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa'), ('Руслан', 'warrior07@mail.ru', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW');
select * from users;
insert into lots(name, date_end, url, rate, step, author_id, category_id) values ('2014 Rossignol District Snowboard', '2017-12-15 05:33:00', 'img/lot-1.jpg', 10990, 400, 1, 1);
insert into lots(name, date_end, url, rate, step, author_id, category_id) values ('DC Ply Mens 2016/2017 Snowboard', '2017-12-15 05:33:00', 'img/lot-2.jpg', 159999, 500, 1, 1);
insert into lots(name, date_end, url, rate, step, author_id, category_id) values ('Крепления Union Contact Pro 2015 года размер L/XL', '2017-12-15 05:33:00', 'img/lot-3.jpg', 8000, 400, 2, 2);
insert into lots(name, date_end, description, url, rate, step, author_id, category_id) values ('Ботинки для сноуборда DC Mutiny Charocal', '2017-12-15 05:33:00', 'Это офигеть какие ботинки ваще', 'img/lot-4.jpg', 10999, 500, 2, 3);
insert into lots(name, date_end, url, rate, step, author_id, category_id) values ('Куртка для сноуборда DC Mutiny Charocal', '2017-12-15 05:33:00', 'img/lot-5.jpg', 7500, 1000, 3, 4);
insert into lots(name, date_end, url, rate, step, author_id, category_id) values ('Маска Oakley Canopy', '2017-12-05 05:33:00', 'img/lot-6.jpg', 5400, 700, 3, 6);

insert into bets(lot_id, value, user_id) values (1, 11390, 1);
insert into bets(lot_id, value, user_id) values (1, 11790, 2);
insert into bets(lot_id, value, user_id) values (1, 12190, 1);
insert into bets(lot_id, value, user_id) values (2, 16499, 1);

/** Select all categories */
select * from categories ORDER BY category_id ASC;

/** Count total bets for each open lot */
select l.lot_id,l.name,l.rate,l.url,l.category_id,IFNULL(count(b.value),0)
  as total_bets from lots l LEFT JOIN bets b ON l.lot_id=b.lot_id WHERE l.date_add < l.date_end GROUP BY l.lot_id ASC;

/** JOIN category_name

/** Select lot by description */
select * from lots WHERE lots.description='Это офигеть какие ботинки ваще';

/** Update lot name by its id */
update lots set name='2017 Rossignol District Snowboard' where lots.lot_id=1;

/** Select latest bets by lot_id */
insert into bets(lot_id, value, user_id) values (1, 12590, 1);
select * from bets WHERE lot_id=1 ORDER BY date_add desc;



