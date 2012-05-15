<?php

class Application_Model_User extends Application_Model_Abstract {
    // Associations
    private $_orders;
    private $_farms;

    const TYPE_INACTIVE = 'INACTIVE';
    const TYPE_CUSTOMER = 'CUSTOMER';
    const TYPE_GROWER = 'GROWER';
    const TYPE_ADMIN = 'ADMIN';

   
    // {{{ isGrower():                      public boolean

    public function isGrower() {
        return ($this->type === self::TYPE_GROWER || $this->type === self::TYPE_ADMIN);
    }

    // }}}
    // {{{ isAdmin():                       public boolean
    
    public function isAdmin() {
        return ($this->type === self::TYPE_ADMIN);
    }

    // }}}

    // Base Model Methods
    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        parent::__construct('User', array('id', 'email','password', 'name', 'address', 'phone', 'type'), $lazy); 
    }

    // }}}
    // {{{ __set($name, $value)

    public function __set($name, $value) {
        $validTypes = array(self::TYPE_INACTIVE, self::TYPE_CUSTOMER, self::TYPE_GROWER, self::TYPE_ADMIN);
        if($name == 'type' && !in_array($value, $valueTypes)) {
            throw new RuntimeException('That is not a valid type!');
        }
        parent::__set($name, $value);
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
    // {{{ addFarm(Application_Model_Farm $farm):                           public void

    public function addFarm(Application_Model_Farm $farm) {
        $this->getFarms();
        if(empty($this->_farms)) {
            $this->_farms = array($farm);
        } else {
            $this->_farms[] = $farm;
        }
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
