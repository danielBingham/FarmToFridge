<?php

class Application_Model_Product extends Application_Model_Abstract {

    // Associations
    private $_category;
    private $_unit; 
    private $_farm;
    private $_productTags;
    private $_productImages;
    

    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        parent::__construct('Product', array('id', 'name', 'description', 'categoryID', 'unitID', 'farmID', 'price', 'amount'), $lazy); 
    }

    // }}}

    // Association Methods
    // {{{ getCategory():                                                   public Application_Model_Category
    
    public function getCategory() {
        if(empty($this->_category) && $this->loadLazy()) {
            $this->getBuilder()->build('category', $this);
        }
        return $this->_category;
    }

    // }}}
    // {{{ setCategory(Application_Model_Category $category):               public void

    public function setCategory(Application_Model_Category $category) {
        $this->_category = $category;
        $this->categoryID = $category->id;
        return $this;
    }

    // }}}
    // {{{ getUnit():                                                       public Application_Model_Unit
    
    public function getUnit() {
        if(empty($this->_unit) && $this->loadLazy()) {
            $this->getBuilder()->build('unit', $this);
        }
        return $this->_unit;
    }

    // }}}
    // {{{ setUnit(Application_Model_Unit $unit):                           public void

    public function setUnit(Application_Model_Unit $unit) {
        $this->_unit = $unit;
        $this->unitID = $unit->id;
        return $this; 
    }

    // }}} 

    // {{{ getFarm():                                                       public Application_Model_Farm
    
    public function getFarm() {
        if(empty($this->_farm) && $this->loadLazy()) {
            $this->getBuilder()->build('farm', $this);
        }
        returN $this->_farm;
    }

    // }}}
    // {{{ setFarm(Application_Model_Farm $farm):                           public void

    public function setFarm(Application_Model_Farm $farm) {
        $this->_farm = $farm;
        $this->farmID = $farm->id;
        return $this;
    }

    // }}}
    // {{{ getProductTags():                                                public array
    
    public function getProductTags() {
        if(empty($this->_productTags) && $this->loadLazy()) {
            $this->getBuilder()->build('productTags', $this);
        }
        return $this->_productTags;
    }

    // }}}
    // {{{ setProductTags(array $productTags):                              public void

    public function setProductTags(array $productTags) {
        $this->_productTags = $productTags;
        return $this;
    }

    // }}}
    // {{{ hasTag(Application_Model_Tag $tag):                              public boolean
    
    public function hasTag(Application_Model_Tag $tag) {
        foreach($this->getProductTags() as $productTag) {
            if($tag->id == $productTag->tagID) {
                return true;
            } 
        }
        return false;
    }
    
    // }}}

    // {{{ getProductImages():                                              public array

    public function getProductImages() {
        if(empty($this->_productImages) && $this->loadLazy()) {
            $this->getBuilder()->build('productImages', $this);
        }
        return $this->_productImages;
    }

    // }}}
    // {{{ setProductImages(array $productImages):                          public void

    public function setProductImages(array $productImages) {
        $this->_productImages = $productImages;
        return $this;
    }

    // }}}
    // {{{ getPrimaryProductImage():                                        public void Application_Model_Image

    public function getPrimaryProductImage() {
        $productImages = $this->getProductImages();
        foreach($productImages as $productImage) {
            if($productImage->main) {
                return $productImage->getImage();
            }
        }
        return (isset($productImages[0]) ? $productImages[0]->getImage() : false);
    }
    
    // }}}
}

?>
