<?php

class APIShoppingCartController extends \BaseController {


	public function sendCartToApp()
	{
		$userid = Input::get("userid");
		$email = Input::get("email");
		$password = Input::get("password");

		$shoppingCart = Shoppingcart::where("user_id", "=", $userid)->get()->first();
		if($shoppingCart){
			if (Auth::validate(array('email' => $email, 'password' => $password))){
				
				$products = $shoppingCart->shoppingCartProducts;
				$shoppingList = array();
				foreach($products as $cartProduct) {
					$description = array(
						"ean_code" => $cartProduct->product->ean_code,
						"name"=>$cartProduct->product->name, 
						"required_amount"=>$cartProduct->quantity,
						"price"=>$cartProduct->product->price_in_cents);
					array_push($shoppingList, $description);
				}

				$response = Response::json(array(
					'cart' => $shoppingList,
					'status' => '1'
				));
				return $response;
			}
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