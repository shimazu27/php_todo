<?php
if(isset($_POST['submit'])){$name = $_POST['name'];
  $name=htmlspecialchars($name,ENT_QUOTES);
require('db_connect.php');}

$sql = 'INSERT INTO todos (name,task) VALUES (?,0)';
$stmt = $dbh->prepare($sql);

$stmt->bindvalue(1,$name,PDO::PARAM_STR);
$stmt->execute();
$dbd = null;
unset($name);

?>

<html>
<head>
  <meta charset =" utf-8">
  <title> Todoリスト </title>
</head>
<body>
  <h1>Todoリスト</h1>
  <form action="index.php" method="post">
    <ul>
      <li><span>タスク名</span><input type="text" name="name">
      <input type="submit" name="submit"></li>
    </ul>
  </form>
  <br>
  <table border="1">
    <tr>
      <th>名前</th>
      <th>todo</th>
    </tr>

    <?php
    $sql = 'SELECT id, name,todo FROM todos';
    
     while($task = $stmt->fetch()) {
      echo "<tr>";
      echo "<td>".$task["name"]."</td>";
      echo "<td>".$task["todo"]."</td>";

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
