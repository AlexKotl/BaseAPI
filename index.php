<?php
	
	namespace BaseAPI;
	
	include("classes/Mysql.php");
	include("classes/API.php");
	include("configs/db.php");
	
	use BaseAPI\Classes\Mysql;
	use BaseAPI\Classes\API;
	
	$db = new Mysql(Configs\DB_CONNECTION);
	$api = new API();
	
	echo "Hello ";
	echo $db->get_row("select name from bases limit 1");
		
?>