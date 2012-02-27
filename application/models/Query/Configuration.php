<?php

class Application_Model_Query_Configuration extends Application_Model_Query_Abstract {
    protected $_model='Configuration';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstanceForModel('Configuration');
    }



}

?>
