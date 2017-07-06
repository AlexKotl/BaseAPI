<?php
	
	$id = (int)$parameters['id'];
	
	$row = $db->get_row("select * from bases where id = '{$id}'");
	
	$data = array(		
		'id' => $row['id'],
		'title' => $row['name'],
		'description' => $row['description'],
		'address' => $row['address'],
		'contacts' => $row['contacts'],
		'rating' => $row['rating'],
		'price' => $row['price'] ? $row['price'] . ' грн' : '',
		'posX' => $row['pos_x'],
		'posY' => $row['pos_y'],
	);
		
?>