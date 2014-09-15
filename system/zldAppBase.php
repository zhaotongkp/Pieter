<?php

namespace zldFramework\zldAppBase;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined("SYSTEM_PAT") or define("SYSTEM_PAT", ZLD_FRAMEWORK . '/system');

defined("ROOT_PATH") or define("ROOT_PATH", substr(SYSTEM_PAT, 0, -7));

defined("SYS_LIB_PATH") or define("SYS_LIB_PATH", SYSTEM_PAT . '/lib');

defined("APP_LIB_PATH") or define("APP_LIB_PATH", ROOT_PATH . '/lib');

defined("SYSTEM_CORE") or define("SYSTEM_CORE", SYSTEM_PAT . "/core");

defined("CONTROLLER_PATH") or define("CONTROLLER_PATH", ROOT_PATH . "/controller");

defined("MODEL_PATH") or define("MODEL_PATH", ROOT_PATH . "/model");

defined("VIEW_PATH") or define("VIEW_PATH", ROOT_PATH . "/views/");

defined("LOG_PATH") or define("LOG_PATH", ROOT_PATH . "/rum/");

defined("SYSTEM_BASE") or define("SYSTEM_BASE", ROOT_PATH . "/bases");

defined("SYSTEM_URLMANAGE") or define("SYSTEM_URLMANAGE", SYSTEM_PAT . "/urlmanage");

final class zldAppBase {

    public static $_lib = null;
    public static $_config = null;

    /**
     * single model;
     * @var type 
     */
    private static $instance = null;

    public static function getInstance() {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        header("Content-type:text/html;chartset=utf-8");
    }

    private function __clone() {
        
    }

    public static function init() {
        self::setAutoLibs();
        require SYSTEM_BASE.'/SystemException.php';
        require SYSTEM_CORE . '/Model.php';
        require SYSTEM_CORE . '/Controller.php';
    }

    public static function run($config) {
        self::$_config = $config['system'];
        self::init();
        self::autoLoad();
        $Route = new self::$_lib['urlRoute'](self::$_config['route']);
        $Route->getUrlArray();
        print_r($Route);
        self::roteToController($Route->route_url);
    }

    public static function autoLoad() {
        foreach (self::$_lib as $key => $value) {
            require self::$_lib[$key];
            $lib = ($key);
            if($key == 'urlRoute')
            {
                self::$_lib[$key] = 'zldFramework\system\urlManage\\'.$lib;
            }elseif($key=='template'){
                $lib = ucfirst($key);
                self::$_lib[$key] = 'zldFramework\system\core\\'.$lib;
            }else{
                self::$_lib[$key] = 'zldFramework\bases\db\\'.$lib;
            }
        }
        if (is_object(self::$_lib['cache'])) {
            self::$_lib['cache']->init(
                    ROOT_PATH . '/' . self::$_config['cache']['cache_dir'], self::$_config['cache']['cache_prefix'], self::$_config['cache']['cache_time'], self::$_config['cache']['cache_mode']
            );
        }
    }

    public static function setAutoLibs() {
        self::$_lib = array(
            'urlRoute' => SYSTEM_URLMANAGE . '/urlRoute.php',
            'dbMysql' => SYSTEM_BASE . '/dbMysql.php',
            'template' => SYSTEM_CORE . '/template.php',
            'cache' => SYSTEM_BASE . '/lib_cache.php',
            'thumbnail' => SYSTEM_CORE . '/thumbnail.php'
        );
    }

    public static function roteToController($url_array = array()) {
        $app = '';
        $controller = '';
        $action = '';
        $model = '';
        $params = '';
        if (isset($url_array['app'])) {
            $app = $url_array['app'];
        }
        if (isset($url_array['c'])) {
            $controller = $model = ucfirst($url_array['c']);
            if ($app) {
                $controller_file = CONTROLLER_PATH . '/' . $app . '/' . $controller . 'Controller.php';
                $model_file = MODEL_PATH . '/' . $app . '/' . $model . 'Model.php';
            } else {
                $controller_file = CONTROLLER_PATH . '/' . $controller . 'Controller.php';
                $model_file = MODEL_PATH . '/' . $model . 'Model.php';
            }
        } else {
            $controller = $model = self::$_config['route']['default_controller'];
            if ($app) {
                $controller_file = CONTROLLER_PATH . '/' . $app . '/' . self::$_config['route']['default_controller'] . 'Controller.php';
                $model_file = MODEL_PATH . '/' . $app . '/' . self::$_config['route']['default_controller'] . 'Model.php';
            } else {
                $controller_file = CONTROLLER_PATH . '/' . self::$_config['route']['default_controller'] . 'Controller.php';
                $model_file = MODEL_PATH . '/' . self::$_config['route']['default_controller'] . 'Model.php';
            }
        }
        if (isset($url_array['a'])) {
            $action = $url_array['a'];
        } else {
            $action = self::$_config['route']['default_action'];
        }
        if (isset($url_array['params'])) {
            $params = $url_array['params'];
        } if (file_exists($controller_file)) {
            if (file_exists($model_file)) {
                require $model_file;
            }
            require $controller_file;
            $controller = $controller . 'Controller';
            $controller = 'zldFramework\controller\\'.$controller;
            if ($action) {
                if (method_exists($controller, $action)) {
                    isset($params) ? $controller::$action($params) : $controller::$action();
                } else {
                    die('控制器方法不存在');
                }
            } else {
                die('控制器方法不存在');
            }
        } else {
            die('控制器不存在');
        }
    }

    public static function newLib($class_name) {
        $app_lib = $sys_lib = "";
        $app_lib = APP_LIB_PATH . "/" . self::$_config['lib']['db_table_status_prefix'] . '_' . $class_name . ".php";
        $sys_lib = SYSTEM_BASE . "/lib_" . $class_name . ".php";
        if (file_exists($app_lib)) {
            require $app_lib;
            $class_name = ucfirst(self::$_config['lib']['db_table_status_prefix'] . ucfirst($class_name));
            return new $class_name;
        } else if (file_exists($sys_lib)) {
            require $sys_lib;
            return self::$_lib[$class_name] = new $class_name;
        } else {
            trigger_error("加载" . $class_name . "类不存在！");
        }
    }
    /**
     * 
     * @return string
     */
    public static function zlbPower()
    {
        return 'This Program Framework nameed by PieterTong;(c)coprty 0.1';
    }

}

?>
