<?php 

class Application_Model_Builder_Category extends Application_Model_Builder_Abstract {

    // {{{ __construct() 
    
    public function __construct() {
        $this->_haveBuilt = array(
            'products'=>false,
            'categoryImages'=>false
        );
    }
    
    // }}}

    // {{{ buildProducts(Application_Model_Category $category):             public void

    public function buildProducts(Application_Model_Category $category) {
        if($category->id === false) {
            throw new RuntimeException('Category->id must be set in order to load Products.');
        } 
        $category->setProducts(Application_Model_Query_Product::getInstance()->fetchAll(array('categoryID'=>$category->id)));
    }

    // }}}
    // {{{ buildImages(Application_Model_Category $category):               public void

    public function buildCategoryImages(Application_Model_Category $category) {
        $category->setCategoryImages(Application_Model_Query_CategoryImage::getInstance()->fetchAll(array('categoryID'=>$category->id)));
    }

    // }}}


}


?>
