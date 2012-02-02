<?php

class Application_Model_Builder_ProductImage extends Application_Model_Builder_Abstract {

    // {{{ __construct()
    
    public function __construct() {
        $this->_haveBuilt = array(
            'image'=>false,
            'product'=>false
        );

    }

    // }}}

    // {{{ buildImage(Application_Model_ProductImage $productImage):        public void

    public function buildImage(Application_Model_ProductImage $productImage) {
        $productImage->setImage(Application_Model_Query_Image::getInstance()->get($productImage->imageID));
    }

    // }}}
    // {{{ buildProduct(Application_Model_ProductImage $productImage):      public void

    public function buildProduct(Application_Model_ProductImage $productImage) {
        $productImage->setProduct(Application_Model_Query_Product::getInstance()->get($productImage->productID));
    }

    // }}}


}
?>
