<?php
	
	namespace BaseAPI;

	include("classes/Mysql.php");
	include("classes/API.php");
	include(file_exists("configs/db.php") ? "configs/db.php" : "configs/db.default.php");
	include(file_exists("configs/config.php") ? "configs/config.php" : "configs/config.default.php");
	
	use BaseAPI\Classes\Mysql;
	use BaseAPI\Classes\API;
	
	$db = new Mysql(array(
		'host' => Configs\DB_HOST,
		'user' => Configs\DB_USER,
		'password' => Configs\DB_PASSWORD,
		'database' => Configs\DB_NAME
	));
	
	$api = new API($db);
	$api->outputData();
		
?>