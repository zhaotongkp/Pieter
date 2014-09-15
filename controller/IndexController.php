<?php
namespace zldFramework\controller;
use \zldFramework\system\core as zldcore;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class IndexController extends zldcore\Controller {

    function __construct()     {
        echo 'se';
    }
    public function index()
    {
        echo __NAMESPACE__;
    }
}