<?php

class APIShoppingCartController extends \BaseController {


    public function sendCartToApp()
    {
        $userid = Input::get("userid");
        $email = Input::get("email");
        $password = Input::get("password");

        $shoppingCart = Shoppingcart::where("user_id", "=", $userid)->first();
        if($shoppingCart){
            if (Auth::validate(array('email' => $email, 'password' => $password))){

                $products = $shoppingCart->shoppingcartProducts;
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

        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))){

            $productAndAmount = json_decode(Input::get("products"));
            $productInformation = array();

            foreach($productAndAmount as $ean_code => $amount) {
                if($ean_code!=null && $amount!="0"){
                    $description = array(
                        "ean_code" => $ean_code,
                        "amount"=> $amount,
                        "name"=> Product::where("ean_code", "=", $ean_code)->get()->first()->name,
                        "price"=> Product::where("ean_code", "=", $ean_code)->get()->first()->price_in_cents);
                    array_push($productInformation, $description);
                }
            }

            if($productInformation != null) {

                $userInformation = array(
                    "userid" => Auth::user()->id,
                    "surname" => Auth::user()->surname,
                    "gender" => Auth::user()->gender,
                );

                $cashRegister = json_encode(array(
                    "userInformation" => $userInformation,
                    "products" => $productInformation
                ));

//            return $cashRegister;

                $service_port = 8818;
//                getservbyport(8818, 'tcp');

                $address = gethostbyaddr('145.37.87.36');

                $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

                if ($socket === false) {
                    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
                } else {
//                    echo "OK.\n";
                }

//                echo "Attempting to connect to '$address' on port '$service_port'...";
                $result = socket_connect($socket, $address, $service_port);
                if ($result === false) {
                    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
                } else {
//                    echo "OK.\n";
                }

                $in = $cashRegister;
                $out = '';

//                echo "Sending HTTP HEAD request...";
                socket_write($socket, $in, strlen($in));
//                echo "OK.\n";

//            echo "Reading response:\n\n";
//            while ($out = socket_read($socket, 2048)) {
//                echo $out;
//            }

//                echo "Closing socket...";
                socket_close($socket);
//                echo "OK.\n\n";

                Auth::logout();

                // send to kassa
                return Response::json(array('status' => '1'));
            }
            return Response::json(array('status' => '0'));
        }
    }
}