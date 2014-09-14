<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author kopuer_tong
 */
class HomeController extends Controller {

	//put your code here
	public function index($params) {
		$model = $this->model('test');
		$model->find();
		$data['home'] = "zhaotongkp.cn";
		$data["tong"] = "baohe";
		$this->renderView('home', array("data" => $data, 'params' => $params,'model'=>$model));
	}

}

?>
