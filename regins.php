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
    $url = '/regins.php?action=create';
    include 'forms/regins.php';
  break;

  case 'create':
    $sql = $pdo->prepare('INSERT INTO `inspector`(`name`, `surname`, `rang`) VALUES (:name, :surname, :rang)');
    $sql->execute([
      ':name' => $_POST['name'],
      ':surname' => $_POST['surname'],
      ':rang' => $_POST['rang'],
    ]);
    echo 'Успешно!<br><a href="/regins.php">Список студентов</a>';
  break;
  
  case 'edit':
    $sql = $pdo->prepare('SELECT * FROM `inspector` WHERE `id` = :id');
    $sql->execute([':id' => $_GET['id']]);
    $inspector = $sql->fetch();
    $url = '/regins.php?action=update&id=' . $_GET['id'];
    include 'forms/regins.php';
  break;
  
  case 'update':
    $sql = $pdo->prepare('UPDATE `inspector` SET  `name` = :name, `surname` = :surname, `rang` = :rang WHERE `id` = :id LIMIT 1');
    $sql->execute([
      ':id' => $_GET['id'],
      ':name' => $_POST['name'],
      ':surname' => $_POST['surname'],
      ':rang' => $_POST['rang'],
      
    ]);
    echo 'Успешно!<br><a href="/regins.php">Список студентов</a>';
  break;

  case 'delete':
    $sql = $pdo->prepare('DELETE FROM `inspector` WHERE `id` = :id LIMIT 1');
    $sql->execute([':id' => $_GET['id']]);
    echo 'Удалено!<br><a href="/regins.php">Список студентов</a>';
  break;

  default:

    echo '[ <a href="/">Вернуться на главную</a> ]<hr>';

    echo '<a href="/regins.php?action=add">Добавить</a><br>';

    $inspectors = $pdo->query('SELECT * FROM `inspector`');


    echo '<table border="1" cellspacing="0">';

    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Имя</th>';
   	echo '<th>Фамилия</th>';
  	echo '<th>Звание</th>';
    echo '</tr>';

    foreach ($inspectors as $inspector)
    {
      echo '<tr>';
      echo '<td>' . $inspector['id'] . '</td> '  
      . '<td>' . $inspector['name'] . '</td>'
      . '<td>' . $inspector['surname'] . '</td> ' 
      . '<td>' . $inspector['rang'] . '</td>'  
      
      . '<td><a href="/regins.php?action=edit&id=' . $inspector['id'] . '">ред.</a> <a href="/regins.php?action=delete&id=' . $inspector['id'] . '">уд.</a></td>';
      echo '</tr>';

    }
    echo '</table>';

  break;

}
