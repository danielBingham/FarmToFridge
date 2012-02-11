<?php


class Application_Model_Query_Order extends Application_Model_Query_Abstract {
    protected $_model='Order';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstanceForModel('Order');
    }


}

?>
