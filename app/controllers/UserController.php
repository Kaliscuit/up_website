<?php

class UserController extends BaseController {

    public function checkEmail() {
        $email    = Input::get('email', '');
        $validator = Validator::make(
            array('email' => $email),
            array('name' => 'email')
        );
        if ($validator->passes()) {
            $user = User::where('email', '=', $email)->count();
            if ($user) {
                return Response::json(array('c' => 402, 'm' => 'Already Registered'));
            } else {
                return Response::json(array('c' => 404, 'm' => 'Not Registered'));
            }
        } else {
            return Response::json(array('c' => 415, 'm' => 'Email Syntax Invalid'));
        }

    }

}