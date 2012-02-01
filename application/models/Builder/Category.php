<?php 

class Application_Model_Builder_Category extends Application_Model_Builder_Abstract {

    // {{{ __construct() 
    
    public function __construct() {
        $this->_haveBuilt = array(
            'products'=>false 
        );
    }
    
    // }}}

    // {{{ buildProducts(Application_Model_Category $category):             public void

    public function buildProducts(Application_Model_Category $category) {
        $category->setProducts(Application_Model_Query_Product::getInstance()->fetchAll(array('categoryID'=>$category->id)));
    }

    // }}}


}


?>
