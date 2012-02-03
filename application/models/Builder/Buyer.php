<?php

class Application_Model_Builder_Buyer extends Application_Model_Builder_Abstract {

    // {{{ __construct()

    public function __construct() {
        $this->_haveBuilt = array(
            'orders'=>false
        );
    }

    // }}}

    // {{{ buildOrders(Application_Model_Buyer $buyer):                     public void
    
    public function buildOrders(Application_Model_Buyer $buyer) {
        if($buyer->id === false) {
            throw new RuntimeException('Buyer->id must be set in order to load Orders.');
        } 
        $buyer->setOrders(Application_Model_Query_Order::getInstance()->fetchAll(array('buyerID'=>$buyer->id)));
    }

    // }}}

}

?>
