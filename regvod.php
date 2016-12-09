<?php

$pdo = new PDO('mysql:host=127.0.0.1;dbname=gibdd60', 'gibdd60', 'Ebhugre0');

$pdo->exec('SET NAMES "utf8";');

$action = '';

if (isset($_GET['action']))
{
  $action = $_GET['action'];
}

switch ($action)
{
  case 'add':
    $url = '/regvod.php?action=create';
    include 'forms/regvod.php';
  break;

  case 'create':
    $sql = $pdo->prepare('INSERT INTO `owner`(`name`, `surname`, `vod_ud`,`dob`, `cat`) VALUES (:name, :surname, :vod_ud, :dob, :cat)');
    $sql->execute([
      ':name' => $_POST['name'],
      ':surname' => $_POST['surname'],
      ':vod_ud' => $_POST['vod_ud'],
      ':dob' => $_POST['dob'],
      ':cat' => $_POST['cat'],
    ]);
    echo 'Успешно!<br><a href="/regvod.php">Список студентов</a>';
  break;
  
  case 'edit':
    $sql = $pdo->prepare('SELECT * FROM `owner` WHERE `id` = :id');
    $sql->execute([':id' => $_GET['id']]);
    $driver = $sql->fetch();
    $url = '/regvod.php?action=update&id=' . $_GET['id'];
    include 'forms/regvod.php';
  break;
  
  case 'update':
    $sql = $pdo->prepare('UPDATE `owner` SET  `name` = :name, `surname` = :surname, `vod_ud` = :vod_ud, `dob` = :dob, `cat` = :cat WHERE `id` = :id LIMIT 1');
    $sql->execute([
      ':id' => $_GET['id'],
      ':name' => $_POST['name'],
      ':surname' => $_POST['surname'],
      ':vod_ud' => $_POST['vod_ud'],
      ':dob' => $_POST['dob'],
      ':cat' => $_POST['cat'],
      
    ]);
    echo 'Успешно!<br><a href="/regvod.php">Список студентов</a>';
  break;

  case 'delete':
    $sql = $pdo->prepare('DELETE FROM `owner` WHERE `id` = :id LIMIT 1');
    $sql->execute([':id' => $_GET['id']]);
    echo 'Удалено!<br><a href="/regvod.php">Список студентов</a>';
  break;

  default:

    echo '[ <a href="/">Вернуться на главную</a> ]<hr>';

    echo '<a href="/regvod.php?action=add">Добавить</a><br>';

    $drivers = $pdo->query('SELECT * FROM `owner`');


    echo '<table border="1" cellspacing="0">';

    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Имя</th>';
   	echo '<th>Фамилия</th>';
  	echo '<th>Вод.удостоверение</th>';
  	echo '<th>Дата</th>';
  	echo '<th>Категория</th>';
    echo '<th>&nbsp;</th>';
    echo '</tr>';

    foreach ($drivers as $driver)
    {
      echo '<tr>';
      echo '<td>' . $driver['id'] . '</td> '  
      . '<td>' . $driver['name'] . '</td>'
      . '<td>' . $driver['surname'] . '</td> ' 
      . '<td>' . $driver['vod_ud'] . '</td>'  
      . '<td>' . $driver['dob'] . '</td>'
      . '<td>' . $driver['cat'] . '</td>'
      
      . '<td><a href="/regvod.php?action=edit&id=' . $driver['id'] . '">ред.</a> <a href="/regvod.php?action=delete&id=' . $driver['id'] . '">уд.</a></td>';
      echo '</tr>';

    }
    echo '</table>';

  break;

}
