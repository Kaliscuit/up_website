<?php

require base_path() . '/vendor/xunsearch/lib/XS.php';
require app_path() . '/helpers/simpleHtmlDomHelper.php';

class PositionController extends BaseController {

    public function postSuggest() {
        $keyword     = Input::get('keyword', '');
        $suggestions = [];
        if ($keyword) {
            $xs          = new XS('zhaopin');
            $search      = $xs->search;
            $suggestions = $search->getExpandedQuery($keyword, 5);
        }

        return Response::json(array('c' => 200, 'm' => 'ok', 'd' => array('count' => count($suggestions), 'suggestions' => $suggestions)));
    }

    public function postSearch() {
        $keyword  = Input::get('keyword', '');
        $page     = intval(Input::get('page', 1));
        $page     = $page > 1 ? $page : 1;
        $per_page = 20;

        if ($keyword) {
            $xs     = new XS('zhaopin');
            $search = $xs->search;
            $search->setLimit($per_page + 1, ($page - 1) * $per_page);
            $docs   = $search->search('position:' . $keyword);
            $result = [];
            foreach ($docs as $doc) {
                $highlight = [];
                $dom       = str_get_html($search->highlight($doc->position));
                foreach ($dom->find('em') as $item) {
                    $highlight[] = strip_tags($item->innertext);
                }

                $result[] = [
                    'id'            => $doc->id,
                    'position'      => $doc->position,
                    'position_desc' => $doc->position_desc,
                    'highlight'     => $highlight,
                    'requirements'  => $doc->requirements,
                    'rank'          => $doc->rank,
                    'hot'           => $doc->hot
                ];
            }
        } else {
            $result = Position::take($per_page + 1)->skip(($page - 1) * $per_page)->get(['id', 'position', 'position_desc', 'requirements', 'rank', 'hot'])->toArray();
        }

        $count = count($result);
        if ($count > $per_page) {
            unset($result[$per_page]);
            $next = true;
        } else {
            $next = false;
        }

        return Response::json(array(
            'c' => 200,
            'm' => 'ok',
            'd' => array(
                'count'  => count($result),
                'page'   => $page,
                'next'   => $next,
                'result' => $result
            )
        ));
    }

    public function postHot() {
        $positions = [
            [
                'id'       => 6,
                'rank'     => 1,
                'trend'    => +3,
                'position' => 'Android开发工程师'
            ],
            [
                'id'       => 11,
                'rank'     => 2,
                'trend'    => -1,
                'position' => 'PHP网站程序员'
            ],
            [
                'id'       => 13,
                'rank'     => 3,
                'trend'    => +2,
                'position' => 'UE/UI工程师'
            ],
            [
                'id'       => 22,
                'rank'     => 4,
                'trend'    => +1,
                'position' => '.NET程序员'
            ],
            [
                'id'       => 27,
                'rank'     => 5,
                'trend'    => +1,
                'position' => '产品调试'
            ],
            [
                'id'       => 30,
                'rank'     => 6,
                'trend'    => -1,
                'position' => 'C++软件开发工程师'
            ],
            [
                'id'       => 5,
                'rank'     => 7,
                'trend'    => +2,
                'position' => 'JAVA研发程序员'
            ],
            [
                'id'       => 10,
                'rank'     => 8,
                'trend'    => +3,
                'position' => 'AMX产品技术工程'
            ],
            [
                'id'       => 2,
                'rank'     => 9,
                'trend'    => -1,
                'position' => '高级软件工程师'
            ],
            [
                'id'       => 15,
                'rank'     => 10,
                'trend'    => +4,
                'position' => '自动化编程员'
            ],
        ];

        return Response::json(array('c' => 200, 'm' => 'ok', 'd' => array('count' => count($positions), 'positions' => $positions)));
    }

    public function postProfile() {
        $pid      = Input::get('pid', '');
        $position = Position::find($pid, ['id', 'position', 'position_desc', 'requirements', 'rank', 'hot']);
        if ($position) {
            return Response::json(array('c' => 200, 'm' => 'OK', 'd' => array('profile' => $position->toArray())));
        } else {
            return Response::json(array('c' => 404, 'm' => 'Invalid Pid'));
        }
    }

    public function postSelect() {
        if (Auth::check()) {
            $user          = Auth::user();
            $uid           = $user->id;
            $pid           = Input::get('pid', '');
            $user_position = UserPosition::where('uid', '=', $uid)->get()->first();

            if ($user_position) {
                $user_position->pid = $pid;
                $user_position->save();
            } else {
                $user_position      = new UserPosition;
                $user_position->uid = $uid;
                $user_position->pid = $pid;
                $user_position->save();
            }

            $pid       = 2; //TODO Debug off
            $questions = Survey::where('pid', '=', $pid)->get()->first();
            $survey    = [];
            if ($questions) {
                foreach (range(1, 10) as $i) {
                    $suffix       = sprintf("%02d", $i);
                    $q_suffix     = 'q_' . $suffix;
                    $qid          = $questions->$q_suffix;
                    $question_obj = SurveyQuestion::find($qid);
                    $question     = [
                        'question' => ['id' => $question_obj->id, 'question' => $question_obj->question],
                        'options'  => SurveyOption::where('qid', '=', $qid)->get(['id', 'option', 'score', 'qid'])->toArray()
                    ];
                    $survey[]     = $question;
                }

                return Response::json(array('c' => 200, 'm' => 'OK', 'd' => ['survey' => $survey]));
            } else {
                return Response::json(array('c' => 404, 'm' => 'No Survey For This Position Yet.'));
            }
        } else {
            return Response::json(array('c' => 403, 'm' => 'Forbidden'));
        }
    }

}
