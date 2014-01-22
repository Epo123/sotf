<?php

class LoginController extends BaseController {

    public function showLogin() {
        return View::make('login');
    }

    public function doLogin() {
        $email = Input::get('email');
        $password = Input::get('password');

        if(Auth::attempt(array('email' => $email, 'password' =>$password))) {
            Session::flash('success', 'Success.');
            return Redirect::to('/');
        } else {
            Session::flash('error', 'Data not found.');
            return Redirect::to('login');
        }
    }

    public function doLogout() {
        Session::flash('success', 'Logged out.');
        Auth::logout();
        return Redirect::to('/');
    }

    public function doRegister() {
        $email = 'user@gmail.com';
        $password = 'test';

        $user = new User();
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->firstname = 'User';
        $user->surname = 'Achternaam';
        $user->gender = 'm';

        $user->save();

    }
}