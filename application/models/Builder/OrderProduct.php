<?php

class Application_Model_Builder_OrderProduct extends Application_Model_Builder_Abstract {

    // {{{ __construct()
    
    public function __construct() {
        $this->_haveBuilt = array(
            'order'=>false,
            'product'=>false
        ); 
    }

    // }}}

    // {{{ buildOrder(Application_Model_OrderProduct $orderProduct):        public void

    public function buildOrder(Application_Model_OrderProduct $orderProduct) {
        if($orderProduct->orderID === false) {
            throw new RuntimeException('In order to lazy load Order, orderID must be set.');
        } 
        $orderProduct->setOrder(Application_Model_Query_Order::getInstance()->get($orderProduct->orderID));
    }

    // }}}
    // {{{ buildProduct(Application_Model_OrderProduct $orderProduct):      public void

    public function buildProduct(Application_Model_OrderProduct $orderProduct) {
        if($orderProduct->productID === false) {
            throw new RuntimeException('In order to lazy load Product, productID must be set.');
        } 

        $orderProduct->setProduct(Application_Model_Query_Product::getInstance()->get($orderProduct->productID));
    }

    // }}}

}


?>
