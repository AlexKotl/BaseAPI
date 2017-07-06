<?php
	
	namespace BaseAPI;
	
	include("classes/Mysql.php");
	include("configs/db.php");
	
	use BaseAPI\Classes;
	
	$db = new Classes\Mysql(Configs\DB_CONNECTION);
	
	echo "Hello ";
	echo $db->get_row("select name from bases limit 1");
		
?>