<?php
	
	$id = (int)$parameters['id'];
	
	$row = $db->get_row("select * from bases where id = '{$id}'");
	
	// filter description
	$row['description'] = str_replace("\n", "<br>", $row['description']);
	
	// list images
	$images = array();
	
	for ($i=1; $i<=5; $i++) {
		$cur_img = \BaseAPI\Configs\IMAGES_DIR . "/{$row['id']}_{$i}.jpg";
		if (file_exists($cur_img)) {
			$images[] = \BaseAPI\Configs\RESOURCES_HOST . "/upload/images/{$row['id']}_{$i}.jpg";
		}
	}
	
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
		'images' => $images
	);
		
?>