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
       $productTag->setTag(Application_Model_Query_Tag::getInstance()->get($productTag->tagID));
    }

    // }}}
    // {{{ buildProduct(Application_Model_ProductTag $productTag):          public void

    public function buildProduct(Application_Model_ProductTag $productTag) {
        $productTag->setProduct(Application_Model_Query_Product::getInstance()->get($productTag->productID));
    }

    // }}}

}

?>
