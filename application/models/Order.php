<?php

class Application_Model_Order extends Application_Model_Abstract {

    // Associations
    private $_orderProducts;
    private $_user;

    // {{{ getTotal():                                                      public float

    /**
    * Get the total cost of this order.
    */ 
    public function getTotal() {
        $total = 0;
        foreach($this->getOrderProducts() as $orderProduct) {
            $total += $orderProduct->amount*$orderProduct->getProduct()->price; 
        }
        return $total;
    }

    // }}}
    
    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        parent::__construct('Order', array('id', 'userID', 'orderedOn', 'confirmed', 'filled'), $lazy); 
    }

    // }}}
    // {{{ __set($name, $value)

    public function __set($name, $value) {
        if($name == 'orderedOn') {
            if(!($value instanceof Zend_Date)) {
                throw new RuntimeException('OrderedOn must be an instance of Zend_Date!');
            }
        }
        parent::__set($name, $value);
    }

    // }}}

    // Association Methods
    // {{{ getOrderProducts():                                              public array(Application_Model_OrderProduct)

    public function getOrderProducts() {
        if(empty($this->_orderProducts) && $this->loadLazy() && $this->id !== false) {
            $this->getBuilder()->build('orderProducts', $this);
        } else if(empty($this->_orderProducts) && $this->id === false) {
           $this->_orderProducts = array(); 
        }
        return $this->_orderProducts;
    }

    // }}}
    // {{{ setOrderProducts(array $orderProducts):                          public void

    public function setOrderProducts(array $orderProducts) {
        $this->_orderProducts = $orderProducts;
        return $this;
    }

    // }}}
    // {{{ addOrderProduct(Application_Model_OrderProduct $orderProduct)    public void

    public function addOrderProduct(Application_Model_OrderProduct $orderProduct) {
        foreach($this->getOrderProducts() as $op) {
            if($orderProduct->productID == $op->productID) {
                $op->amount += $orderProduct->amount;
                return;
            }
        } 
        $this->_orderProducts[] = $orderProduct;
    }

    // }}}
    // {{{ removeOrderProduct(int $productID):                                     public void
    
    public function removeOrderProduct($productID) {
        foreach($this->getOrderProducts() as $key=>$orderProduct) {
            if($orderProduct->getProduct()->id == $productID) {
                unset($this->_orderProducts[$key]);
            }
        }
    }
    
    // }}}
    
    // {{{ getUser():                                                      public Application_Model_User

    public function getUser() {
        if(empty($this->_user) && $this->loadLazy()) {
            $this->getBuilder()->build('user', $this);
        }
        return $this->_user;
    }

    // }}}
    // {{{ setUser(Application_Model_User $user):                        public void

    public function setUser(Application_Model_User $user) {
        $this->_user = $user;
        $this->userID = $user->id;
        return $this;
    }

    // }}}

}

?>
