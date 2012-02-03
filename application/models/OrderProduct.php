<?php

class Application_Model_OrderProduct extends Application_Model_Abstract {

    // Associations
    private $_product;
    private $_order;

    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        parent::__construct('OrderProduct', array('id', 'productID', 'orderID', 'amount'), $lazy); 
    }

    // }}}


    // Association Methods
    // {{{ getProduct():                                                    public Application_Model_Product
    
    public function getProduct() {
        if(empty($this->_product) && $this->loadLazy()) {
            $this->getBuilder()->build('product', $this);
        }
        return $this->_product;
    }

    // }}}
    // {{{ setProduct(Application_Model_Product $product):                  public void

    public function setProduct(Application_Model_Product $product) {
        $this->_product = $product;
        $this->productID = $product->id;
        return $this;
    }

    // }}}
    // {{{ getOrder():                                                      public Application_Model_Order
    
    public function getOrder() {
        if(empty($this->_order) && $this->loadLazy()) {
            $this->getBuilder()->build('order', $this);
        }
        return $this->_order;
    }

    // }}}
    // {{{ setOrder(Application_Model_Order $order):                        public void

    public function setOrder(Application_Model_Order $order) {
        $this->_order = $order;
        $this->orderID = $order->id;
        return $this;
    }

    // }}}

}

?>
