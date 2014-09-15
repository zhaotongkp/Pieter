<?php
namespace zldFramework\bases\db;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lib_mysql
 *
 * @author kopuer_tong
 */
class dbMysql {
	//single
	private  $instance = null;
	
	private static function getInstance() {
		if(!(self::$instance instanceof  self)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	//put your code here
	public function init() {
//		$this->instance;
	}
	public function showDatabases() {
//		print_r($this->instance);
//		echo "mysql";
	}
	public function model(){
		return self::getInstance();
	}
	public function find(){
		echo "find";
	}
}

?>
