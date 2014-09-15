<?php
namespace zldFramework\system\core;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author kopuer_tong
 */
class Model {

    //put your code here
    protected $db = null;

    final public function __construct() {
        $mysql = $this->db = $this->load('dbMysql');
        $mysql::init($this->config('db'));
    }

    final protected function table($table_name) {
        $config_db = $this->config('db');
        return $config_db['db_table_status_prefix'] . $table_name;
    }

    final protected function load($lib, $my = false) {
        if (empty($lib)) {
            trigger_error("加载类不能为空！！");
        } else if ($my === false) {
            return \zldFramework\zldAppBase\zldAppBase::$_lib[$lib];
        } else if ($my === TRUE) {
            return \zldFramework\zldAppBase\zldAppBase::newLib($lib);
        }
    }

    final protected function config($config = '') {
        return \zldFramework\zldAppBase\zldAppBase::$_config[$config];
    }

    public static function model() {
        return new self();
    }
    public function find() {
        echo "find";
    }

}

?>
