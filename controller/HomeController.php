<?php
namespace zldFramework\controller;
use \zldFramework\system\core as zldcore;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author kopuer_tong
 */
class HomeController extends zldcore\Controller {
	//put your code here
	public function index($params) {
		$model = self::model('test');
		$model->testDatabases();
		$data['home'] = "zhaotongkp.cn";
		$data["tong"] = "baohe";
		zldcore\Controller::renderView('home', array("data" => $data, 'params' => $params,'model'=>$model));
                echo "Home/index";
	}

}

?>
