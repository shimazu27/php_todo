<?php
require('db_connect.php');
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $name = htmlspecialchars($name,ENT_QUOTES);
  $task = $_POST['task'];
  $task = htmlspecialchars($task,ENT_QUOTES);
  $option = $_POST['option'];
  $option = htmlspecialchars($option,ENT_QUOTES);
  $dbh = db_connect();

  $sql = 'INSERT INTO todos (name,task,option,done) VALUES (?,?,?,0)';
  $stmt = $dbh->prepare($sql);
  $stmt->bindvalue(1,$name,PDO::PARAM_STR);
  $stmt->bindValue(2,$task,PDO::PARAM_STR);
  $stmt->bindValue(3,$option,PDO::PARAM_STR);
  $stmt->execute();
  $dbh = null;
  unset($name);
 }

 if(isset($_POST['method']) &&
 ($_POST['method'] === 'put')){
   $id = $_POST["id"];
   $id = htmlspecialchars($id,ENT_QUOTES);
   $id = (int)$id;

   $dbh = db_connect();
   $sql = 'UPDATE todos SET done = 1 WHERE id = ?';
   $stmt = $dbh->prepare($sql);
   $stmt->bindvalue(1,$id,PDO::PARAM_INT);
   $stmt->execute();
   $dbh = null;
 }
?>

<html>
<head>
  <meta charset =" utf-8">
  <title> Todoリスト </title>
</head>
<body>
  <h1>Todoリスト</h1>
  <form action="index.php" method="post">
    <p><label>名前<input type="text" name="name"></label></a>
    <p><label>タスク<input type="text" name="task"></label></a>
    <p><label>オプション<input type="text" name="option"></label></a>
    <p><input type="submit" name="submit"></p>
  </form>
  <br>
  <table border="1">
    <tr>
      <th>名前</th>
      <th>タスク</th>
      <th>オプション</th>
    </tr>

    <?php
    $dbh=db_connect();
    $sql='SELECT id,name,task,option FROM todos WHERE done = 0 ORDER BY id DESC';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    $dbh=null;

     while($task = $stmt->fetch(PDO::FETCH_ASSOC)) {
      echo "<tr>";
      echo "<td>".$task['name']."</td>";
      echo "<td>".$task['task']."</td>";
      echo "<td>".$task['option']."</td>";
      echo "<td>";
      echo "<form action='index.php' method='post'>";
      echo "<input type='submit' value='削除'>";
      echo "<input type='hidden' name='method' value='put'>";
      echo '<input type="hidden" name="id" value="'.$task["id"].'">';
      echo "</form>";
      echo "</td>";
      echo "</tr>";
    }
    ?>
  </table>
</body>
</html>
