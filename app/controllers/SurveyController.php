<?php

class SurveyController extends BaseController {

    public function postGet() {
        if (Auth::check()) {
            $user          = Auth::user();
            $uid           = $user->id;
            $user_position = UserPosition::where('uid', '=', $uid)->get()->first();

//            if ($user_position) {
//                $user_position->pid = $pid;
//                $user_position->save();
//            } else {
//                $user_position      = new UserPosition;
//                $user_position->uid = $uid;
//                $user_position->pid = $pid;
//                $user_position->save();
//            }
//
//            $data = [
//                'uid' => $user_position->uid,
//                'pid' => $user_position->pid
//            ];
//
//            return Response::json(array('c' => 200, 'm' => 'OK', 'd' => $data));
//        } else {
//            return Response::json(array('c' => 403, 'm' => 'Forbidden'));
        }
    }
}
