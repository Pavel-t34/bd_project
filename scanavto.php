<?

    /*Подключаемся к БД*/
    $db = mysql_connect('127.0.0.1','gibdd60','Ebhugre0');
    mysql_select_db('gibdd60', $db);
    /*Делаем запрос к БД*/
    $result = mysql_query("SELECT * FROM `gibdd60`.`car` WHERE `number` = '$id'",$db);
    /*Преобразовываем результат в массив*/
    $myrow = mysql_fetch_array($result);
    /*Выводим результат на экран*/
    echo $myrow['name'];

?>
