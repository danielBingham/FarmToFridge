<?php

class Application_Model_ProductImage extends Application_Model_Abstract {

    // Associations
    protected $_image;
    protected $_product;

    // {{{ __construct($lazy=true)
    
    public function __construct($lazy=true) {
        parent::__construct('ProductImage', array('id', 'imageID', 'productID', 'main'), $lazy);
    }

    // }}}


    // Association Methods
    // {{{ getImage():                                                      public Application_Model_Image
    
    public function getImage() {
        if(empty($this->_image) && $this->loadLazy()) {
            $this->getBuilder()->build('image', $this);
        }
        return $this->_image;
    }

    // }}}
    // {{{ setImage(Application_Model_Image $image):                        public void

    public function setImage(Application_Model_Image $image) {
        $this->_image = $image;
        $this->imageID = $image->id;
        return $this;
    }

    // }}}
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
}


?>
