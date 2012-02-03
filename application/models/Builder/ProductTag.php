<?php

class Application_Model_Builder_ProductTag extends Application_Model_Builder_Abstract {


    // {{{ __construct()
    
    public function __construct() {
        $this->_haveBuilt = array(
            'tag'=>false,
            'product'=>false
        );
    }

    // }}}

    // {{{ buildTag(Application_Model_ProductTag $productTag):              public void

    public function buildTag(Application_Model_ProductTag $productTag) {
        if($productTag->tagID === false) {
            throw new RuntimeException('ProductTag->tagID must be set in order to load Tag.');
        }
        $productTag->setTag(Application_Model_Query_Tag::getInstance()->get($productTag->tagID));
    }

    // }}}
    // {{{ buildProduct(Application_Model_ProductTag $productTag):          public void

    public function buildProduct(Application_Model_ProductTag $productTag) {
        if($productTag->productID === false) {
            throw new RuntimeException('ProductTag->productID must be set in order to load Product.');
        }
        $productTag->setProduct(Application_Model_Query_Product::getInstance()->get($productTag->productID));
    }

    // }}}

}

?>
