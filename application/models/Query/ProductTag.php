<?php

class Application_Model_Query_ProductTag extends Application_Model_Query_Abstract {

    protected $_model='ProductTag';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstanceForModel('ProductTag');
    }


}

?>
