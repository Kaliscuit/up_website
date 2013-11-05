<?php
require '/srv/v2up.me/www/vendor/xunsearch/lib/XS.php';

class PositionController extends BaseController {

    public function suggestPosition()
    {
        $keyword = Input::get('keyword', '');
        $xs = new XS('zhaopin');
        $search = $xs->search;
        $suggestion = $search->getExpandedQuery($keyword);
        return Response::json(array('c' => 200, 'm' => 'ok', 'd' => array('count' => count($suggestion), 'positions' => $suggestion)));
    }

}