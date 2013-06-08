<?php	 	
/*
Template Name: Paypal
*/
	try {
		$params = getParams();
		debug($params);
	} catch (Exception $e) {
		echo json_encode(array(
			'code' => 0,
			'data' => $e->getMessage()
		));
	}
	

?>