<?php


class Application_Model_Query_OrderProduct extends Application_Model_Query_Abstract {
    protected $_model='OrderProduct';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstanceForModel('OrderProduct');
    }

}

?>
