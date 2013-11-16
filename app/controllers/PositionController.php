<?php

require base_path() . '/vendor/xunsearch/lib/XS.php';

//require '../../vendor/xunsearch/lib/XS.php';
//require '/srv/v2up.me/www/vendor/xunsearch/lib/XS.php';

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
        $keyword = Input::get('keyword', '');
        $page    = intval(Input::get('page', 1));
        $page    = $page > 1 ? $page : 1;

        if ($keyword) {
            $xs     = new XS('zhaopin');
            $search = $xs->search;
            $search->setLimit(11, ($page - 1) * 10);
            $docs   = $search->search('position:' . $keyword);
            $result = [];
            foreach ($docs as $doc) {
                $result[] = [
                    'id'            => $doc->id,
                    'position'      => $search->highlight($doc->position),
                    'position_desc' => $doc->position_desc
                ];
            }
        } else {
            $result = Position::take(11)->skip(($page - 1) * 10)->get(['id', 'position', 'position_desc'])->toArray();
        }

        $count = count($result);
        if ($count > 10) {
            unset($result[10]);
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
        $position = Position::find($pid);
        if ($position) {
            return Response::json(array('c' => 200, 'm' => 'OK', 'd' => array('profile' => $position->toArray())));
        } else {
            return Response::json(array('c' => 404, 'm' => 'Invalid Pid'));
        }
    }

}