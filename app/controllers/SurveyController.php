<?php

class SurveyController extends BaseController {

    public function postGet() {
        if (Auth::check()) {
            $user          = Auth::user();
            $uid           = $user->id;
            $user_position = UserPosition::where('uid', '=', $uid)->get()->first();

            if ($user_position) {
                $pid       = $user_position->pid;
                $pid       = 2;
                $questions = Survey::where('pid', '=', $pid)->get()->first();
                $survey    = [];
                if ($questions) {
                    foreach (range(1, 10) as $i) {
                        $suffix   = sprintf("%02d", $i);
                        $q_suffix = 'q_' . $suffix;
                        $qid      = $questions->$q_suffix;
                        $question = [
                            'question' => SurveyQuestion::find($qid)->get(['id', 'question'])->toArray(),
                            'options'  => SurveyOption::where('qid', '=', $qid)->get(['id', 'option', 'score', 'qid'])->toArray()
                        ];
                        $survey[] = $question;
                    }

                    return Response::json(array('c' => 200, 'm' => 'OK', 'd' => ['survey' => $survey]));
                } else {
                    return Response::json(array('c' => 404, 'm' => 'No Survey For This Position Yet.'));
                }

            } else {
                return Response::json(array('c' => 405, 'm' => 'Select Position Required'));
            }

        } else {
            return Response::json(array('c' => 403, 'm' => 'Forbidden'));
        }
    }
}
