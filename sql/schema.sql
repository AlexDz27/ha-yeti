CREATE DATABASE ha_yeti_cave DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_general_ci;
USE ha_yeti_cave;

create table users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(128) UNIQUE,
  name VARCHAR(128) UNIQUE,
  avatar_path VARCHAR(512),
  password_hash VARCHAR(255),
  dt_register DATETIME
) ENGINE = INNODB;

create table lots_categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255)
) ENGINE = INNODB;

create table lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  price DECIMAL,
  img_path VARCHAR(255),
  message TEXT,
  dt_add DATETIME,
  user_id INT,
  category_id INT,
  FOREIGN KEY fk_u(user_id) REFERENCES users(id),
  FOREIGN KEY fk_c(category_id) REFERENCES lots_categories(id)
) ENGINE = INNODB;

create table bets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  price DECIMAL,
  ts TIMESTAMP,
  user_id INT,
  lot_id INT,
  FOREIGN KEY fk_u(user_id) REFERENCES users(id),
  FOREIGN KEY fk_l(lot_id) REFERENCES lots(id)
) ENGINE = INNODB;