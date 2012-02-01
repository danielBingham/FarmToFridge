<?php

class Application_Model_Builder_Product extends Application_Model_Builder_Abstract {

    // {{{ __construct()
    
    public function __construct() {
        $this->_haveBuilt = array(
            'category'=>false
        );
    }

    // }}}

    // {{{ buildCategory(Application_Model_Product $product):               public void

    public function buildCategory(Application_Model_Product $product) {
        $product->setCategory(Application_Model_Query_Category::getInstance()->get($product->categoryID));
    }

    // }}}

}

?>
