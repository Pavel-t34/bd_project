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
    $url = '/regeng.php?action=create';
    include 'forms/regeng.php';
  break;

  case 'create':
    $sql = $pdo->prepare('INSERT INTO `engine`(`model`, `power`, `vin`) VALUES (:model, :power, :vin)');
    $sql->execute([
      ':model' => $_POST['model'],
      ':power' => $_POST['power'],
      ':vin' => $_POST['vin'],
    ]);
    echo 'Успешно!<br><a href="/regeng.php">Список студентов</a>';
  break;
  
  case 'edit':
    $sql = $pdo->prepare('SELECT * FROM `engine` WHERE `id` = :id');
    $sql->execute([':id' => $_GET['id']]);
    $engine = $sql->fetch();
    $url = '/regeng.php?action=update&id=' . $_GET['id'];
    include 'forms/regeng.php';
  break;
  
  case 'update':
    $sql = $pdo->prepare('UPDATE `engine` SET  `model` = :model, `power` = :power, `vin` = :vin WHERE `id` = :id LIMIT 1');
    $sql->execute([
      ':id' => $_GET['id'],
      ':model' => $_POST['model'],
      ':power' => $_POST['power'],
      ':vin' => $_POST['vin'],
      
    ]);
    echo 'Успешно!<br><a href="/regeng.php">Список студентов</a>';
  break;

  case 'delete':
    $sql = $pdo->prepare('DELETE FROM `engine` WHERE `id` = :id LIMIT 1');
    $sql->execute([':id' => $_GET['id']]);
    echo 'Удалено!<br><a href="/regeng.php">Список студентов</a>';
  break;

  default:

    echo '[ <a href="/">Вернуться на главную</a> ]<hr>';

    echo '<a href="/regeng.php?action=add">Добавить</a><br>';

    $engines = $pdo->query('SELECT * FROM `engine`');


    echo '<table border="1" cellspacing="0">';

    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>модель</th>';
   	echo '<th>мощность</th>';
  	echo '<th>vin</th>';
    echo '</tr>';

    foreach ($engines as $engine)
    {
      echo '<tr>';
      echo '<td>' . $engine['id'] . '</td> '  
      . '<td>' . $engine['model'] . '</td>'
      . '<td>' . $engine['power'] . '</td> ' 
      . '<td>' . $engine['vin'] . '</td>'  
      
      . '<td><a href="/regeng.php?action=edit&id=' . $engine['id'] . '">ред.</a> <a href="/regeng.php?action=delete&id=' . $engine['id'] . '">уд.</a></td>';
      echo '</tr>';

    }
    echo '</table>';

  break;

}
