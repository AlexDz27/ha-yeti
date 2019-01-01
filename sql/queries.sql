USE ha_yeti_cave;

INSERT INTO users (name, email, password_hash) VALUES (
  'Игнат',
  'ignat.v@gmail.com',
  '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'
),
(
  'Леночка',
  'kitty_93@li.ru',
  '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa'
),
(
  'Руслан',
  'warrior07@mail.ru',
  '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW'
)
;

INSERT INTO lots_categories (title) VALUES ('Доски и лыжи'), ('Крепления'), ('Ботинки'), ('Одежда'), ('Инструменты'),
('Разное');

INSERT INTO lots (title, price, img_path, message, user_id, category_id) VALUES
(
  '2014 Rossignol District Snowboard',
  10999,
  'img/lot-1.jpg',
  '',
  1,
  1
),
(
  'DC Ply Mens 2016/2017 Snowboard',
  159999,
  'img/lot-2.jpg',
  '',
  2,
  1
),
(
  'Крепления Union Contact Pro 2015 года размер L/XL',
  8000,
  'img/lot-3.jpg',
  '',
  2,
  2
),
(
  'Ботинки для сноуборда DC Mutiny Charocal',
  10999,
  'img/lot-4.jpg',
  '',
  3,
  3
),
(
  'Куртка для сноуборда DC Mutiny Charocal',
  7500,
  'img/lot-5.jpg',
  '',
  2,
  4
),
(
  'Маска Oakley Canopy',
  5400,
  'img/lot-6.jpg',
  '',
  3,
  6
);

INSERT INTO bets (price, ts, user_id) VALUES
(
  11500,
  '2019-01-01 23:02:34',
  1
),
(
  11500,
  '2019-01-01 22:31:46',
  2
),
(
  11500,
  '2019-01-01 22:43:53',
  3
)
;