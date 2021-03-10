<?php
require('db_connect.php');
if(isset($_POST['submit'])){
  $name=$_POST['name'];
  $name=htmlspecialchars($name,ENT_QUOTES);

$sql='INSERT INTO todos (name,task) VALUES (?,0)';
$stmt=$dbh->prepare($sql);

$stmt->bindvalue(1,$name,PDO::PARAM_STR);
$stmt->execute();
unset($name);
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
    <p><label>task<input type="text" name="task"></label></a>
    <p><input type="submit" name="submit"></p>
  </form>
  <br>
  <table border="1">
    <tr>
      <th>名前</th>
      <th>task</th>
    </tr>

    <?php
    $dbh=db_connect();
    $sql='SELECT id, name,task FROM todos';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
    $dbh=null;

     while($todo = $stmt->fetch()) {
      echo "<tr>";
      echo "<td>".$task['name']."</td>";
      echo "<td>".$task['task']."</td>";

      echo "<td>";
      echo "<form action='index.php' method='post'>";
      echo "<input type='submit' value='削除'>";
      echo '<input type="hidden" name="id" value="'.$task["id"].'">';
      echo "</form>";
      echo "</td>";
      echo "</tr>";
    }
    ?>
  </table>
</body>
</html>
