<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    public function displayJson($code = 200, $msg = 'OK', $data = array()) {
        Log::info(json_encode(array('c' => $code, 'm' => $msg, 'd' => $data)));
        return Response::json(array('c' => $code, 'm' => $msg, 'd' => $data));
    }

}