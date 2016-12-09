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
    $url = '/regavto.php?action=create';
    include 'forms/regavto.php';
  break;

  case 'create':
    $sql = $pdo->prepare('INSERT INTO `car`(`brand`, `model`, `engine`,`number`, `owner`,  `year`, `vin`) VALUES (:brand, :model, :engine, :number, :owner , :year, :vin )');
    $sql->execute([
      ':brand' => $_POST['brand'],
      ':model' => $_POST['model'],
      ':engine' => $_POST['engine'],
      ':number' => $_POST['number'],
      ':owner' => $_POST['owner'],
      ':year' => $_POST['year'],
      ':vin' => $_POST['vin'],
    ]);
    echo 'Успешно!<br><a href="/regavto.php">Список студентов</a>';
  break;
  
  case 'edit':
    $sql = $pdo->prepare('SELECT * FROM `car` WHERE `id` = :id');
    $sql->execute([':id' => $_GET['id']]);
    $car = $sql->fetch();
    $url = '/regavto.php?action=update&id=' . $_GET['id'];
    include 'forms/regavto.php';
  break;
  
  case 'update':
    $sql = $pdo->prepare('UPDATE `car` SET  `brand` = :brand, `model` = :model, `engine` = :engine, `number` = :number, `owner` = :owner,`year` = :year, `vin` = :vin WHERE `id` = :id LIMIT 1');
    $sql->execute([
      ':id' => $_GET['id'],
      ':brand' => $_POST['brand'],
      ':model' => $_POST['model'],
      ':engine' => $_POST['engine'],
      ':number' => $_POST['number'],
      ':owner' => $_POST['owner'],
      ':year' => $_POST['year'],
      ':vin' => $_POST['vin'],
      
    ]);
    echo 'Успешно!<br><a href="/regavto.php">Список студентов</a>';
  break;

  case 'delete':
    $sql = $pdo->prepare('DELETE FROM `car` WHERE `id` = :id LIMIT 1');
    $sql->execute([':id' => $_GET['id']]);
    echo 'Удалено!<br><a href="/regavto.php">Список студентов</a>';
  break;

  default:

    echo '[ <a href="/">Вернуться на главную</a> ]<hr>';

    echo '<a href="/regavto.php?action=add">Добавить</a><br>';

    $cars = $pdo->query('SELECT * FROM `car`');


    echo '<table border="1" cellspacing="0">';

    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Марка</th>';
   	echo '<th>Модель</th>';
  	echo '<th>Двигатель</th>';
  	echo '<th>Номер</th>';
  	echo '<th>Владелец</th>';
    echo '<th>Год</th>';
    echo '<th>VIN</th>';
    echo '<th>&nbsp;</th>';
    echo '</tr>';

    foreach ($cars as $car)
    {
      echo '<tr>';
      echo 
      '<td>' . $car['id'] . '</td> '  
      . '<td>' . $car['brand'] . '</td>'
      . '<td>' . $car['model'] . '</td> ' 
      . '<td>' . $car['engine'] . '</td>'  
      . '<td>' . $car['number'] . '</td> '
      . '<td>' . $car['owner'] . '</td>'
      . '<td>' . $car['year'] . '</td>'
      . '<td>' . $car['vin'] . '</td> ' 
      
      . '<td><a href="/regavto.php?action=edit&id=' . $car['id'] . '">ред.</a> <a href="/regavto.php?action=delete&id=' . $car['id'] . '">уд.</a></td>';
      echo '</tr>';

    }
    echo '</table>';

  break;

}
