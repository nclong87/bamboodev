<?php	 	
/*
Template Name: Process
*/
	$action = $_REQUEST['action'];
	if($action == null)
		die();
	$return_url = getParam('redirect_url',DOMAIN);
	try {
		switch ($action) {
			case 'sign-up':
				require_once 'includes/validate.php';
				$bArress = getArray($_POST['address_book']['B']);
				if(Validate::validateAddress($bArress) == false) throw new Exception('Customer info is invalid', ERR_VALIDATE_ADDRESS);
				$createAccount = getParam('create_account');
				$sArress = getArray($_POST['address_book']['S']);
				if(Validate::validateAddress($sArress) == false) throw new Exception('Shipping info is invalid', ERR_VALIDATE_ADDRESS);
				debug($params);
				$product_id = getParam('product_id');
				$cart = isset($_SESSION['cart'])?$_SESSION['cart']:array();
				unset($cart[$product_id]);
				$_SESSION['cart'] = $cart;
				$success['data'] = DOMAIN.'/checkout';
				break;
			default:
				break;
		}
		echo json_encode($success);
	} catch (Exception $e) {
		$_SESSION['error'] = $e->getMessage();
		wp_redirect($return_url.'?error_code='.$e->getCode());
	}
	

?>