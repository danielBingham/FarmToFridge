<?php

class Application_Model_Builder_Product extends Application_Model_Builder_Abstract {

    // {{{ __construct()
    
    public function __construct() {
        $this->_haveBuilt = array(
            'category'=>false,
            'farm'=>false,
            'productTags'=>false, 
            'productImages'=>false,
            'unit'=>false,
        );
    }

    // }}}

    // {{{ buildCategory(Application_Model_Product $product):               public void

    public function buildCategory(Application_Model_Product $product) {
        if($product->categoryID === false) {
            throw new RuntimeException('Product->categoryID must be set in order to load Category.');
        }
        $product->setCategory(Application_Model_Query_Category::getInstance()->get($product->categoryID));
    }

    // }}}
    // {{{ buildUnit(Application_Model_Product $product):                   public void

    public function buildUnit(Application_Model_Product $product) {
        if($product->unitID === false) {
            throw new RuntimeException('Product->unitID must be set in order to load Unit.');
        }
        $product->setUnit(Application_Model_Query_Unit::getInstance()->get($product->unitID));
    }

    // }}} 
    // {{{ buildFarm(Application_Model_Product $product):                   public void

    public function buildFarm(Application_Model_Product $product) {
        if($product->farmID === false ) {
            throw new RuntimeException('Product->farmID must be set in order to load Farm.');
        }
        $product->setFarm(Application_Model_Query_Farm::getInstance()->get($product->farmID));
    }
    
    // }}}
    // {{{ buildProductTags(Application_Model_Product $product):            public void

    public function buildProductTags(Application_Model_Product $product) {
        if($product->id === false) {
            throw new RuntimeException('Product->id must be set in order to load ProductTags.');
        }
        $product->setProductTags(Application_Model_Query_ProductTag::getInstance()->fetchAll(array('productID'=>$product->id)));
    }

    // }}}
    // {{{ buildProductImages(Application_Model_Product $product):          public void

    public function buildProductImages(Application_Model_Product $product) {
        if($product->id === false) {
            throw new RuntimeException('Product->id must be set in order to load Images.');
        }
        $product->setProductImages(Application_Model_Query_ProductImage::getInstance()->fetchAll(array('productID'=>$product->id)));
    }

    // }}}


}

?>
