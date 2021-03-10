<?php
function db_connect(){
 try {
	 $dbname = 'todos';
	 $host = 'localhost';
	 $user = 'root';
	 $password = 'pascal27';
	 $dns = 'mysql:dbname='.$dbname.';host='.$host.';charset=utf8';
   $dbh = new PDO($dns, $user, $password);
	 $dbh->query('SET NAMES utf8');
	 $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
	 return $dbh;
 } catch(PDOException $e) {
	echo('Connection failed:'.$e->getMessage());
	die();
  }
 }
?>
