<?php

class Application_Model_User extends Application_Model_Abstract {
    // Associations
    private $_orders;
    private $_farms;

    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        parent::__construct('User', array('id', 'email','password', 'isGrower'), $lazy); 
    }

    // }}}

    // Association Methods
    // {{{ getFarms():                                                      public array(Application_Model_Farm)
    
    public function getFarms() {
        if(empty($this->_farms) && $this->loadLazy()) {
            $this->getBuilder()->build('farms', $this);
        }
        return $this->_farms;
    }

    // }}}
    // {{{ setFarms(array $farms):                                          public void

    public function setFarms(array $farms) {
        $this->_farms = $farms;
        return $this;
    }

    // }}}
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
