<?php

//use \zldFramework;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
defined('ZLD_FRAMEWORK') or define('ZLD_FRAMEWORK', dirname(__FILE__));
require dirname(__FILE__) . "/system/zldAppBase.php";
$config = require dirname(__FILE__) . '/system/config/config.php';
$app = \zldFramework\zldAppBase\zldAppBase::getInstance();
$app::run($config);
?>
