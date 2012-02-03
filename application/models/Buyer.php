<?php

class Application_Model_Buyer extends Application_Model_Abstract {

    // Associations
    private $_orders;
    
    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        parent::__construct('Buyer', array('id', 'email', 'password'), $lazy); 
    }

    // }}}

    // Association Methods
    // {{{ getOrders():                                                     public array(Application_Model_Order)

    /**
    *  Gets this buyer's orders in no particular order.
    */
    public function getOrders() {
        if(empty($this->_orders) && $this->loadLazy()) {
            $this->getBuilder()->build('orders', $this);
        }
        return $this->_orders; 
    }

    // }}}
    // {{{ setOrders(array $orders):                                        public void

    public function setOrders(array $orders) {
        $this->_orders = $orders;
        return $this;
    }
    
    // }}}
}

?> 
