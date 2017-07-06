<?php
	
	$res = $db->query("select * from bases where flag='ok' ");
	while ($row=$db->fetch($res)) {
		$data[] = array(
			'id' => $row['id'],
			'title' => $row['name'],
			'description' => mb_substr($row['description'], 0, 200),
			'posX' => $row['pos_x'],
			'posY' => $row['pos_y'],
		);
	}
	
?>