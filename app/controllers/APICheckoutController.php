<?php

class APICheckoutController extends \BaseController {


	public function sendCartToUser()
	{
		$userid = Input::get("userid");
		$email = Input::get("email");
		$password = Input::get("password");

		$shoppingCart = ShoppingCart::where("user_id", "=", $userid)->get()->first();

		if (Auth::validate(array('email' => $email, 'password' => $password))){
			
			$products = $shoppingCart->shoppingCartProducts();
			$shoppingList = array();
			foreach($products as $cartProduct) {
				$description = array(
					"name"=>$cartProduct->product()->name, 
					"required_amount"=>$cartProduct->quantity);
				
				array_push($shoppingList, $cartProduct->product()->code, $description);
			}

			$response = Response::json(array(
				'cart' => $shoppingList,
				'status' => '1'
			));
			return $response;
		}
		return Response::json(array('status' => '0'));
	}


	public function receiveCartFromApp($code){
		$cashregister = CashRegister::where("code", "=", $code)->get();
		if (Auth::validate(array('email' => Input::get('email'), 'password' => Input::get('password')))){
			$productAndAmount = Input::get("products");

			// send to kassa



			return Response::json(array('status' => '1'));
		}
		
		return Response::json(array('status' => '0'));

	}
}