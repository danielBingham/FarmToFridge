<?php

class Application_Model_Order extends Application_Model_Abstract {

    // Associations
    private $_orderProducts;
    private $_buyer;
    
    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        parent::__construct('Order', array('id', 'buyerID', 'orderedOn', 'confirmed'), $lazy); 
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
    
    // {{{ getBuyer():                                                      public Application_Model_Buyer

    public function getBuyer() {
        if(empty($this->_buyer) && $this->loadLazy()) {
            $this->getBuilder()->build('buyer', $this);
        }
        return $this->_buyer;
    }

    // }}}
    // {{{ setBuyer(Application_Model_Buyer $buyer):                        public void

    public function setBuyer(Application_Model_Buyer $buyer) {
        $this->_buyer = $buyer;
        $this->buyerID = $buyer->id;
        return $this;
    }

    // }}}

}

?>
