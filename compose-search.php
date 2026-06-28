<?php
//error_reporting(0);
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'twigbase');


	$dbhost=DB_SERVER;
	$dbuser=DB_USERNAME;
	$dbpass=DB_PASSWORD;
	$dbname=DB_DATABASE;
	
	try{
		
	$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$pdo->exec("set names utf8mb4");
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		die("Error: Can Not Connect" . $e->getMessage());
	}


    $key=$_GET['key'];
    $array = array();
    $stmt=$pdo->prepare("SELECT * FROM users WHERE name LIKE '%{$key}%'");
    $stmt->execute();
    $row = $stmt->fetchAll();
    foreach($row as $rows)
	{
      $array[] = $rows['name'];
    }
    echo json_encode($array);
   
?>

