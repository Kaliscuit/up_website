<?php

class UserController extends BaseController {

    public function postCheckEmail() {
        $email = Input::get('email', '');
        $code  = $this->checkEmail($email);
        switch ($code) {
            case 409:
                return Response::json(array('c' => 409, 'm' => 'Already Registered'));
            case 404:
                return Response::json(array('c' => 404, 'm' => 'Not Registered'));
            case 415:
                return Response::json(array('c' => 406, 'm' => 'Email Syntax Invalid'));
        }
    }

    public function postRegister() {
        $email    = Input::get('email', '');
        $password = Input::get('password', '');

        if (strlen($password) < 6) {
            return Response::json(array('c' => 406, 'm' => 'Email Syntax Invalid'));
        }

        $code = $this->checkEmail($email);
        switch ($code) {
            case 404:
                $password       = Hash::make($password);;
                $user           = new User;
                $user->email    = $email;
                $user->password = $password;
                $user->name     = '';
                $user->avatar   = 'default';
                $user->gender   = '';
                $user->birthday = '1991-04-06';
                $user->save();
                Session::put('email', $email);

                return Response::json(array('c' => 200, 'm' => 'OK'));
            case 409:
                return Response::json(array('c' => 409, 'm' => 'Already Registered'));
            case 415:
                return Response::json(array('c' => 406, 'm' => 'Email Syntax Invalid'));
        }
    }

    public function postLogin() {

        $data = array(
            'email'    => Input::get('email'),
            'password' => Input::get('password')
        );

        if (Auth::attempt($data, true)) {
            return Response::json(array('c' => 200, 'm' => 'OK', 'd' => array('profile' => [])));
        } else {
            return Response::json(array('c' => 403, 'm' => 'Email or Password Invalid'));
        }

    }

    public function postSetName() {
        $name  = Input::get('name', '');
        $email = Session::get('email');

        $user = User::where('email', '=', $email)->get();
        $user[0]->name = $name;
        $user[0]->save();
        return Response::json(array('c' => 200, 'm' => 'OK', 'd' => array('profile' => $user[0]->roles->toJson())));
    }

    private function checkEmail($email) {
        $validator = Validator::make(
            array('email' => $email),
            array('email' => 'Required|email')
        );
        if ($validator->passes()) {
            $user = User::where('email', '=', $email)->count();
            if ($user) {
                return 409;
            } else {
                return 404;
            }
        } else {
            return 415;
        }
    }
}