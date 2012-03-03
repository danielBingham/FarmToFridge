<?php

class Application_Model_Builder_CategoryImage extends Application_Model_Builder_Abstract {
   
    // {{{ __construct()
 
    public function __construct() {
        $this->_haveBuilt = array(
            'image'=>false,
            'category'=>false
        );
    }

    // }}}
    
    // {{{ buildImage(Application_Model_CategoryImage $categoryImage):      protected void

    protected function buildImage(Application_Model_CategoryImage $categoryImage) {
        $categoryImage->setImage(Application_Model_Query_Image::getInstance()->get($categoryImage->imageID));
    }

    // }}}
    // {{{ buildCategory(Application_Model_CategoryImage $categoryImage):   protected void

    protected function buildCategory(Application_Model_CategoryImage $categoryImage) {
        $categoryImage->setCategory(Application_Model_Query_Category::getInstance()->get($categoryImage->categoryID));
    }

    // }}} 
}

?>
