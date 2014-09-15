<?php

namespace zldFramework\system\core;
use zldFramework\zldAppBase;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lib_template
 *
 * @author kopuer_tong
 */
class Template {

    public $template_name = null;
    public $data = array();
    public $out_put = null;

    //put your code here
    public function init($template_name, $data = array()) {
        $this->template_name = $template_name;
        $this->data = $data;
        $this->fetch();
    }

    public function fetch() {
        $view_file = VIEW_PATH . $this->template_name . '.php';
        if (file_exists($view_file)) {
            extract($this->data);
            ob_start();
            include $view_file;
            $content = ob_get_contents();
            ob_end_clean();
            $this->out_put = $content;
        } else {
            trigger_error('加载 ' . $view_file . ' 模板不存在');
        }
    }

    public function outPut() {
        echo $this->out_put;
    }

}

?>
