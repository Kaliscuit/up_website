<?php

class SurveyController extends BaseController {

    public function postGet() {
        if (Auth::check()) {
            $user          = Auth::user();
            $uid           = $user->id;
            $user_position = UserPosition::where('uid', '=', $uid)->get()->first();

            if ($user_position) {
                $pid = $user_position->pid;
//                return Response::json(array('c' => 200, 'm' => 'OK', 'd' => $data));
            } else {
                return Response::json(array('c' => 405, 'm' => 'Select Position Required'));
            }

        } else {
            return Response::json(array('c' => 403, 'm' => 'Forbidden'));
        }
    }
}
