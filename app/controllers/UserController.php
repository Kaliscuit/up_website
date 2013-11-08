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
                return Response::json(array('c' => 415, 'm' => 'Email Syntax Invalid'));
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
                $password       = md5($password . 'up_user');
                $user           = new User;
                $user->email    = $email;
                $user->password = $password;
                $user->name     = '';
                $user->avatar   = 'default';
                $user->gender   = '';
                $user->birthday = '1991-04-06';
                $user->save();

                return Response::json(array('c' => 200, 'm' => 'OK'));
            case 409:
                return Response::json(array('c' => 409, 'm' => 'Already Registered'));
            case 415:
                return Response::json(array('c' => 415, 'm' => 'Email Syntax Invalid'));
        }
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