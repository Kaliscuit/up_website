<?php

class UserController extends BaseController {

    public function postCheckEmail() {
        $email = Input::get('email', '');
        $code  = $this->checkEmail($email);
        switch ($code) {
            case 409:
                Log::info('check------------409');
                $this->displayJson(409, 'Already Registered');
            case 404:
                Log::info('check------------404');
                $this->displayJson(404, 'Not Registered');
            case 406:
                Log::info('check------------404');
                $this->displayJson(406, 'Email Syntax Invalid');
        }
    }

    public function postRegister() {
        $email    = Input::get('email', '');
        $password = Input::get('password', '');

        if (strlen($password) < 6) {
            $this->displayJson(406, 'Email Syntax Invalid');
        }

        $code = $this->checkEmail($email);
        switch ($code) {
            case 404:
                $password = Hash::make($password);;
                $user           = new User;
                $user->email    = $email;
                $user->password = $password;
                $user->name     = '';
                $user->avatar   = 'default';
                $user->gender   = '';
                $user->birthday = '1991-04-06';
                $user->save();
                Auth::login($user, true);

                $this->displayJson(200, 'OK');
            case 409:
                $this->displayJson(409, 'Already Registered');
            case 406:
                $this->displayJson(406, 'Email Syntax Invalid');
        }
    }

    public function postLogin() {
        $data = array(
            'email'    => Input::get('email'),
            'password' => Input::get('password')
        );

        if (Auth::attempt($data, true)) {
            Log::info('login------------ok');
            $this->displayJson(200, 'OK', array('profile' => Auth::user()->toJson()));
        } else {
            Log::info('login------------403');
            $this->displayJson(403, 'Email or Password Invalid');
        }

    }

    public function postSetName() {
        if (Auth::check()) {
            $name = Input::get('name', '');
            $user = Auth::user();

            $user->name = $name;
            $user->save();

            $this->displayJson(200, 'OK', array('profile' => $user->toJson()));
        } else {
            $this->displayJson(403, 'Forbidden');
        }
    }

    public function postLogout() {
        Auth::logout();
        $email = Auth::user()->email;

        return Response::json(array('c' => 200, 'm' => 'OK', 'd' => array('email' => $email)));
    }

    public function postProfile() {
        $uid  = Input::get('uid', '');
        $user = $uid ? User::find($uid) : Auth::user();
        if ($user) {
            return Response::json(array('c' => 200, 'm' => 'OK', 'd' => array('profile' => $user->toJson())));
        } else {
            return Response::json(array('c' => 404, 'm' => 'Invalid Uid'));
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
            return 406;
        }
    }
}