<?php

class Application_Model_Builder_Order extends Application_Model_Builder_Abstract {

    // {{{ __construct()
    
    public function __construct() {
        $this->_haveBuilt = array(
            'orderProducts'=>false,
            'user'=>false
        );
    }

    // }}}

    // {{{ buildOrderProducts(Application_Model_Order $order):              public void
    
    public function buildOrderProducts(Application_Model_Order $order) {
        if($order->id === false) {
            throw new RuntimeException('Order->id must be set in order to load OrderProducts.');
        }
        $order->setOrderProducts(Application_Model_Query_OrderProduct::getInstance()->fetchAll(array('orderID'=>$order->id)));
    }

    // }}}
    // {{{ buildUser(Application_Model_Order $order):                      public void

    public function buildUser(Application_Model_Order $order) {
        if($order->userID === false) {
            throw new RuntimeException('Order->userID must be set in order to load User.');
        }
        $order->setUser(Application_Model_Query_User::getInstance()->get($order->userID));
    }

    // }}}


}

?>
