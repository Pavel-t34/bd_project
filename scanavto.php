<?
$pdo = new PDO('mysql:host=127.0.0.1;dbname=gibdd60', 'gibdd60', 'Ebhugre0');
$students = $pdo->query('SELECT * FROM `gibdd60`.`car` WHERE `number` = 'A522AA'');


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

    foreach ($students as $student)
    {
      echo '<tr>';
      echo '<td>' . $student['id'] . '</td> ' 
      . '<td>' . $student['brand'] . '</td> ' 
      . '<td>' . $student['model'] . '</td>'
      . '<td>' . $student['engine'] . '</td>'
      . '<td>' . $student['number'] . '</td>'  
      . '<td>' . $student['owner'] . '</td>'
      . '<td>' . $student['year'] . '</td>'
      . '<td>' . $student['vin'] . '</td>'
      . '<td><a href="/students.php?action=edit&id=' . $student['id'] . '">ред.</a> <a href="/students.php?action=delete&id=' . $student['id'] . '">уд.</a></td>';
      echo '</tr>';

?>
