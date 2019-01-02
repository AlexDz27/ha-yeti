<?php

$dbConfig = getDbConfig();
define('DB_HOST', $dbConfig['host']);
define('DB_NAME', $dbConfig['name']);
define('DB_USER', $dbConfig['user']);
define('DB_PASSWORD', $dbConfig['password']);
define('DB_CHARSET', $dbConfig['char_set']);

$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
static $con;
if ($con === null) {
  try {
    $con = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
  } catch (PDOException $exception) {
    sendServerErrorMessageOnProd();

    echo '<h1 style="color: #ff4b52">PDO Exception error: ' . $exception->getMessage() . '</h1>';
  }
}

function getNewLots() {
  $q = "select l.id, l.title, l.img_path, l.price, c.title 'category', DATE_FORMAT(b.ts,'%H:%i:%s') 'bet_time' from
 lots l join lots_categories c on l.category_id = c.id left join bets b on b.lot_id = l.id order by l.id DESC";
  // todo: new, not by ids

  return fetchAll($q);
}

function getLotById($id) {
  $q = "select l.id, l.title, l.img_path, l.price, l.message, c.title 'category', DATE_FORMAT(b.ts,'%H:%i:%s') 'bet_time'
 from lots l join lots_categories c on l.category_id = c.id
  left join bets b on b.lot_id = l.id WHERE l.id = :id order by l.id DESC";

  return fetchSingle($q, ['id' => $id]);
}

function getLotsByIds(array $ids) {
  $ids = implode(',', $ids);

  $q = "select l.id, l.title, l.img_path, l.price, c.title 'category', DATE_FORMAT(b.ts,'%H:%i:%s') 'bet_time' from
 lots l join lots_categories c on l.category_id = c.id left join bets b on b.lot_id = l.id WHERE l.id IN($ids) order by FIELD (l.id, $ids)";

  return fetchAll($q);
}

function getUserByEmail($email) {
  $q = "select * from users where email = :email";

  return fetchSingle($q, ['email' => $email]);
}


function fetchSingle($q, $bindedValues = []) {
  $res = getPreparedStmt($q, $bindedValues)->fetch();

  return $res ?: null;
}

function fetchAll($q, $bindedValues = []) {
  $res = getPreparedStmt($q, $bindedValues)->fetchAll();
  if ($res === false) {
    throwException('Error running query');
  }

  return $res ?? null;
}

function getPreparedStmt($q, $bindedValues = []) {
  global $con;

  $stmt = $con->prepare($q);

  try {
    $stmt->execute($bindedValues);
  } catch (Exception $exception) {
    sendServerErrorMessageOnProd();
    $exception->getMessage();
  }

  return $stmt;
}