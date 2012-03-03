<?php

class Application_Model_Category extends Application_Model_Abstract {

    // Associations
    private $_products;
    private $_categoryImages;

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
    
    // {{{ getCategoryImages():                                             public array(Application_Model_CategoryImage)

    public function getCategoryImages() {
        if(empty($this->_categoryImages) && $this->loadLazy()) {
            $this->getBuilder()->build('categoryImages', $this);
        }
        return $this->_categoryImages;
    }

    // }}}
    // {{{ setCategoryImages(array $categoryImages):                        public $this

    public function setCategoryImages(array $categoryImages) {
        $this->_categoryImages = $categoryImages;
        return $this; 
    }
    
    // }}}
    // {{{ getPrimaryImage():                                               public Application_Model_Image

    public function getPrimaryImage() {
        $categoryImages = $this->getCategoryImages();
        if(empty($categoryImages)) {
            return null;
        } 

        foreach($categoryImages as $categoryImage) {
            if($categoryImage->main) {
                return $categoryImage->getImage();
            }
        }

        return $categoryImage[0]->getImage();
    }

    // }}}
        
}

?>
