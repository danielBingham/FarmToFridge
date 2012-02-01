<?php


class Application_Model_Query_Product extends Application_Model_Query_Abstract {
    protected $_model='Product';
    protected static $_instance;


    public static function getInstance() {
        return parent::getInstance('Product');
    }
}

?>
