<form action="<?= $url ?>" method="post">


  <label>Дата</label><br>
  <input type="text" name="date" value="<?= $protokol['date'] ?>"><br>
  <br>
  
  <label>Нарушение</label><br>
  <input type="text" name="violation" value="<?= $protokol['violation'] ?>"><br>
  <br>

  <label>Водитель</label><br>
  <input type="text" name="owner" value="<?= $protokol['owner'] ?>"><br>
  <br>
  
  <label>Автомобиль</label><br>
  <input type="text" name="car" value="<?= $protokol['car'] ?>"><br>
  <br>
  
  <label>Инспектор</label><br>
  <input type="text" name="insp" value="<?= $protokol['insp'] ?>"><br>
  <br>
  
  <button type="submit">Сохранить</button>
</form>
