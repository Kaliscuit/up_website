<?php
require '../../vendor/xunsearch/lib/XS.php';

class PositionController extends BaseController {

    public function suggestPosition()
    {
        $keyword = Input::get('keyword', '');
        $xs = new XS('zhaopin');
        $search = $xs->search;
        $suggestion = $search->getExpandedQuery($keyword);
        return Response::json($suggestion);
    }

}