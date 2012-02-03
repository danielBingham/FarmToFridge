<?php

class Application_Model_Builder_Order extends Application_Model_Builder_Abstract {

    // {{{ __construct()
    
    public function __construct() {
        $this->_haveBuilt = array(
            'orderProducts'=>false,
            'buyer'=>false
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
    // {{{ buildBuyer(Application_Model_Order $order):                      public void

    public function buildBuyer(Application_Model_Order $order) {
        if($order->buyerID === false) {
            throw new RuntimeException('Order->buyerID must be set in order to load Buyer.');
        }
        $order->setBuyer(Application_Model_Query_Buyer::getInstance()->get($order->buyerID));
    }

    // }}}


}

?>
