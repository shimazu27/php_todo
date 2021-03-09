<?php
$dbname = 'todos';
$host = 'localhost';
$user = 'root';
$password = 'pascal27';
$dns = 'mysql:dbname='.$dbname.';host='.$host.';charset=utf8';

try {
	$dbh = new PDO($dns, $user, $password,
	array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
	);
	if ($dbh == null) {
		print_r('接続失敗');
	}
} catch(PDOException $e) {
	echo('Connection failed:'.$e->getMessage());
	die();
}
?>
