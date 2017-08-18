<?php
		
	$res = $db->query("select bases.*, count(comments.id) as comments_count from bases 
		inner join comments on comments.base_id = bases.id
		where flag='ok' 
		group by bases.id
		order by bases.vip desc, bases.vip_end_date desc, bases.id desc ");
	
	while ($row = $db->fetch($res)) {
	
		// list images
		$images = array();
		
		for ($i=1; $i<=5; $i++) {
			$cur_img = \BaseAPI\Configs\IMAGES_DIR . "/{$row['id']}_{$i}.jpg";
			if (file_exists($cur_img)) {
				$images[] = \BaseAPI\Configs\RESOURCES_HOST . "/upload/images/{$row['id']}_{$i}.jpg";
			}
		}
		
		$row['description'] = strip_tags($row['description']);
		$row['name'] = strip_tags($row['name']);
		$row['contacts'] = strip_tags($row['contacts']);
		$row['address'] = strip_tags($row['address']);				
		
		$data[] = array(		
			'id' => $row['id'],
			'title' => $row['name'],
			'description' => $row['description'],
			'address' => $row['address'],
			'contacts' => $row['contacts'],
			'rating' => (float)$row['rating'],
			'price' => $row['price'] ? $row['price'] . ' грн' : '',
			'posX' => (float)$row['pos_x'],
			'posY' => (float)$row['pos_y'],
			'images' => $images,
			'comments_count' => (int)$row['comments_count'],
			'date_added' => $row['date_added'],
			'date_edited' => $row['date_edited'],
			'is_vip' => $row['vip'] == 1,
			'vip_end_date' => (int)$row['vip_end_date'],
			'comments' => array(),
		);
		
		// get comments
		$res_comments = $db->query("select * from comments where base_id='{$row['id']}' order by date desc");
		while ($row_comments = $db->fetch($res_comments)) {
			$data['comments'][] = array(
				'name' => $row_comments['name'],
				'band_name' => $row_comments['band'],
				'text' => $row_comments['content'],
				'date' => substr($row_comments['date'],0,10),
				'rating' => (int)$row_comments['rating'],
			);
		} 
	}
		
?>