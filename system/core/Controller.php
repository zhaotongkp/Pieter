<?php

namespace zldFramework\system\core;

/**
 * Description of controller
 *
 * @author kopuer_tong
 */
class Controller {

    //put your code here
    public function __construct() {
        
    }

    final protected function model($model) {
        if (empty($model)) {
            trigger_error("不能实例化空模型");
        }
        $model_name = $model . "Model";
        require_once(MODEL_PATH . "/" . $model_name . ".php");
        return new $model_name;
    }

    final protected function load($lib, $autu = TRUE) {
        if (empty($lib)) {
            trigger_error("加载类库名不能为空！！");
        } else if ($autu === TRUE) {
            return \zldFramework\zldAppBase\zldAppBase::$_lib[$lib];
        } else {
            return \zldFramework\zldAppBase\zldAppBase::newLib($lib);
        }
    }

    final protected function config($config) {
        return \zldFramework\zldAppBase\zldAppBase::$_config[$config];
    }

    public function renderView($path, $data = array()) {
        $template = self::load('template');
        $objTemplate = new $template;
        $objTemplate->init($path, $data);
        $objTemplate->outPut();
    }

}

?>
