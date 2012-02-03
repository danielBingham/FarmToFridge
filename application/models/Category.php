<?php

class Application_Model_Category extends Application_Model_Abstract {

    // Associations
    private $_products;

    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        parent::__construct('Category', array('id', 'name'), $lazy); 
    }

    // }}}

    // Association Methods
    // {{{ getProducts():                                                   public array(Application_Model_Product)
    
    public function getProducts() {
        if(empty($this->_products) && $this->loadLazy()) {
            $this->getBuilder()->build('products', $this);
        }
        return $this->_products;
    }

    // }}}
    // {{{ setProducts(array $products):                                    public void

    public function setProducts(array $products) {
        $this->_products = $products;
        return $this;
    }

    // }}}

}

?>
