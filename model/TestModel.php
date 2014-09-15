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
class testModel extends zldFramework\system\core\Model {

    //put your code here

    function testDatabases() {
        $db = $this->db;
        $db::showDatabases();
    }

}

?>
