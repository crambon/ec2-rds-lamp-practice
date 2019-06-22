<?php
$host = 'RDSのホスト名を入力してください';
$dbname = 'DBの名前を入力してください';
$user_name = 'RDSのユーザ名を入力してください';
$password = 'パスワードを入力してください';
try {
  $pdo=new PDO(
    sprintf('mysql:host=%s;dbname=%s;charset=utf8', $host, $dbname),
    $user_name,
    $password,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
  );
} catch (PDOException $e) {
  header('Content-Type: text/plain; charset=UTF-8', true, 500);
  exit($e->getMessage());
}
$users = $pdo->query('SELECT * FROM users');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>適当名簿</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <?php while ($row = $users->fetchObject()) : ?>
    <div class="user">
      <h3><?=$row->name?></h1>
      <p><?=sprintf("性別: %s, 年齢: %d", $row->sex, $row->age)?></p> 
      <p><?=$row->memo?></p>
    </div>
    <?php endwhile ; ?>
    </div>
  </body>
</html>
