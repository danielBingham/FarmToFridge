<?php

class Application_Model_Query_Unit extends Application_Model_Query_Abstract {
    protected $_model='Unit';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstance('Unit');
    }


}

?>
