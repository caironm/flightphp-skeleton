<?php
	$now = Date('Y-m-d H:i:s');
	$DB = Flight::get('DB');
	$r = Flight::request();
	$data = $r->data->getData();

	if ($DB == false) {
		Flight::json(array('message'=>'SESSION_EXPIRED'), 401);
	} else if ($user_right[0]] < 2) {
		Flight::json(array('message'=>'FORBIDDEN'), 403);
	} else if (!isSet($id)) {
		Flight::json(array('message'=>'BAD_REQUEST', 'key'=>'id'), 400);
	} else {

		$result = $DB->prepare("DELETE
								FROM my_items 
								WHERE my_items.item_id = :id;");
		$result->bindvalue(':id', $id, PDO::PARAM_INT); 
		if ($result->execute()) { 
			Flight::json(array('data'=>array(	'message'=>'deleted',
												'time'=>$now
											)));
		} else { 
			Flight::json(array('error'=>implode(' ',array_slice($result->errorInfo(), 2)) ), 500);
		}
			
	}

?>
