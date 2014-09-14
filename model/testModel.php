<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testModel
 *
 * @author kopuer_tong
 */
class testModel extends Model {
	//put your code here
	function testDatabases() {
		$this->db->show_database();
	}
}

?>
