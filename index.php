<?php
	
	namespace BaseAPI;
	
	include("classes/Mysql.php");
	include("classes/API.php");
	include(file_exists("configs/db.php") ? "configs/db.php" : "configs/db.default.php");
	include(file_exists("configs/config.php") ? "configs/config.php" : "configs/config.default.php");
	
	use BaseAPI\Classes\Mysql;
	use BaseAPI\Classes\API;
	
	$db = new Mysql(Configs\DB_CONNECTION);
	
	$api = new API($db);
	$api->outputData();
		
?>