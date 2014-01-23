<?php

class APILoginController extends \BaseController {


	public function APILogin()
	{
		$email = Input::get('email');
        $password = Input::get('password');

        if(Auth::attempt(array('email' => $email, 'password' => $password))) {

            $user = Auth::user();
            $id = $user->id;

            Auth::logout();
            return Response::json(array('id' => $id, 'status' => '1'));
        } else {
            return Response::json(array('status' => '0'));
        }
	}

}