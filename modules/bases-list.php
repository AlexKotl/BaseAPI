<?php
	
	$res = $db->query("select *, count(comments.id) as comments_count from bases 
		inner join comments on comments.base_id = bases.id
		where flag='ok' 
		group by bases.id
		order by bases.vip desc, bases.vip_end_date desc, bases.id desc ");
		
	while ($row=$db->fetch($res)) {
		$data[] = array(
			'id' => $row['id'],
			'title' => $row['name'],
			'description' => mb_substr($row['description'], 0, 200),
			'isVip' => $row['vip'] == 1,
			'commentsCount' => $row['comments_count'],
			'address' => $row['address'],
			'rating' => $row['rating'],
			'price' => $row['price'] ? $row['price'] . ' грн' : '',
		);
	}
	
?>