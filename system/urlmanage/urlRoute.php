<?php

namespace zldFramework\system\urlManage;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lib_route
 *
 * @author kopuer_tong
 */
class urlRoute {

    //put your code here
    /**
     *
     * @var type 
     */
    public $url_type = 1;

    /**
     *
     * @var type 
     */
    public $url_query;

    /**
     *
     * @var type 
     */
    public $rote_url = array();

    CONST APP = "app";
    CONST CONTROLLER = "Home";
    CONST ACTION = 'index';

    /**
     * 'default_controller'	=>	'home',
     * 'default_action'          =>	'index',
     * 'url_type'		=>	1,
    */
    public function __construct($config = array()) {
        if ($config != array()) {
            if ($config['url_type']) {
                $this->url_type = $config['url_type'];
            }
        }
        $this->url_query = parse_url($_SERVER['REQUEST_URI']);
    }

    /**
     * 
     * @return type
     */
    public function getUrlArray() {
        return $this->rote_url = $this->makeUrl();
    }
    public function makeUrl() {
        switch ($this->url_type) {
            case 1:
                $this->querytToArray();
                break;
            case 2:
                $this->pathinfoToArray();
                break;
            default:
                break;
        }
    }

    public function querytToArray() {
        $arr = !empty($this->url_query['query']) ? explode("&", $this->url_query['query']) : array();
        $array = $tmp = array();
        if (count($arr) > 0) {
            foreach ($arr as $item) {
                $tmp = explode("=", $item);
                if (isset($tmp[0]) && isset($tmp[1])) {
                    $array[$tmp[0]] = $tmp[1];
                } else {
                    $array['c'] = self::CONTROLLER;
                    $array['a'] = self::ACTION;
                }
            }
        } else {
            $array['c'] = self::CONTROLLER;
            $array['a'] = self::ACTION;
        }
        if (isset($array['app'])) {
            $this->route_url['app'] = $array['app'];
            unset($array['app']);
        } if (isset($array['c'])) {
            $this->route_url['c'] = $array['c'];
            unset($array['c']);
        } if (isset($array['a'])) {
            $this->route_url['a'] = $array['a'];
            unset($array['a']);
        } if (count($array) > 0) {
            $this->route_url['params'] = $array;
        }
        unset($array);
        return $this->route_url;
    }
    public function pathinfoToArray() {
        
    }

}

?>
