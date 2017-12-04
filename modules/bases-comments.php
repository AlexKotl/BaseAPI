<?php

	#------------------------------------------------------
	#
	#   Get all comments for specific base
	#
	#------------------------------------------------------

	$id = (int)$parameters['id'];
	
	// get comments
	$res_comments = $db->query("select * from comments where base_id='{$id}' order by date desc");
	while ($row_comments = $db->fetch($res_comments)) {
		$data[] = array(
    		'id' => $row_comments['id'],
			'name' => $row_comments['name'],
			'band_name' => $row_comments['band'],
			'text' => $row_comments['content'],
			'date' => substr($row_comments['date'],0,10),
			'rating' => (int)$row_comments['rating'],
		);
	} 
	
?>