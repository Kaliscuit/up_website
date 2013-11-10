<?php
require '/srv/v2up.me/www/vendor/xunsearch/lib/XS.php';

class PositionController extends BaseController {

    public function postSuggest() {
        $keyword     = Input::get('keyword', '');
        $xs          = new XS('zhaopin');
        $search      = $xs->search;
        $suggestions = $search->getExpandedQuery($keyword, 5);

        return Response::json(array('c' => 200, 'm' => 'ok', 'd' => array('count' => count($suggestions), 'suggestions' => $suggestions)));
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

    public function postHot() {
        $xs     = new XS('zhaopin');
        $search = $xs->search;
        $keywords  = $search->getHotQuery(10);
        return Response::json(array('c' => 200, 'm' => 'ok', 'd' => array('count' => count($keywords), 'keywords' => $keywords)));
    }
}