<?php
require '/srv/v2up.me/www/vendor/xunsearch/lib/XS.php';

class PositionController extends BaseController {

//    public function postSuggest() {
//        $keyword    = Input::get('keyword', '');
//        $xs         = new XS('zhaopin');
//        $search     = $xs->search;
//        $suggestion = $search->getExpandedQuery($keyword);
//
//        return Response::json(array('c' => 200, 'm' => 'ok', 'd' => array('count' => count($suggestion), 'positions' => $suggestion)));
//    }

    public function postSuggest() {
        $keyword    = Input::get('keyword', '');
        $xs         = new XS('zhaopin');
        $search     = $xs->search;
        $suggestion = $search->search('position:' . $keyword);

        return Response::json(array('c' => 200, 'm' => 'ok', 'd' => array('count' => count($suggestion), 'positions' => $suggestion)));
    }

    public function postSearch() {
        $keyword = Input::get('keyword', '');
        $xs      = new XS('zhaopin');
        $search  = $xs->search;
        $search->setLimit(5);
        $docs   = $search->search('position:' . $keyword);
        $result = [];
        foreach ($docs as $doc) {
            $result[] = [
                'id'            => $doc->int,
                'position'      => $doc->position,
                'position_desc' => $doc->position_desc
            ];
        }

        return Response::json(array('c' => 200, 'm' => 'ok', 'd' => array('count' => count($result), 'result' => $result)));
    }

}