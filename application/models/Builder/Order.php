<?php

class Application_Model_Builder_Order extends Application_Model_Builder_Abstract {

    // {{{ __construct()
    
    public function __construct() {
        $this->haveBuilt = array(
            'orderProducts'=>false,
            'buyer'=>false
        );
    }

    // }}}

    // {{{ buildOrderProducts(Application_Model_Order $order):              public void
    
    public function buildOrderProducts(Application_Model_Order $order) {
        $order->setOrderProducts(Application_Model_Query_OrderProducts::getInstance()->fetchAll(array('orderID'=>$order->id)));
    }

    // }}}
    // {{{ buildBuyer(Application_Model_Order $order):                      public void

    public function buildBuyer(Application_Model_Order $order) {
        $order->setBuyer(Application_Model_Query_Buyer::getInstance()->get($order->buyerID));
    }

    // }}}


}

?>
