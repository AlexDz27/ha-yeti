USE ha_yeti_cave;

select * from lots_categories;

SELECT * FROM `lots` ORDER BY dt_add DESC;

SELECT l.title, c.title FROM `lots` l JOIN lots_categories c WHERE l.id = 2 GROUP BY l.id;

UPDATE lots SET title = 'Cool stuff item' WHERE id = 2;

SELECT * FROM `bets` WHERE lot_id = 3 ORDER BY ts DESC;