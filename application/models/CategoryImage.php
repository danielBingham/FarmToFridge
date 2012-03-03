<?php

class Application_Model_CategoryImage extends Application_Model_Abstract {
    private $_image;
    private $_category;
    
    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        parent::__construct('CategoryImage', array('id', 'imageID', 'categoryID', 'main'), $lazy);
    }

    // }}}


    // Association Methods
    // {{{ getImage():                                                      public Application_Model_Image

    public function getImage() {
        if(empty($this->_image) && $this->loadLazy()) {
            $this->getBuilder()->build('image', $this);
        }
        return $this->_image;
    }

    // }}}
    // {{{ setImage(Application_Model_Image $image):                        public $this

    public function setImage(Application_Model_Image $image) {
        $this->_image = $image;
        return $this;
    }

    // }}}
    // {{{ getCategory():                                                   public Application_Model_Category

    public function getCategory() {
        if(empty($this->_category) && $this->loadLazy()) {
            $this->getBuilder()->build('category', $this);
        }
        return $this->_category;
    }

    // }}}
    // {{{ setCategory(Application_Model_Category $category):               public $this

    public function setCategory(Application_Model_Category $category) {
        $this->_category = $category;
        return $this;
    }

    // }}}

}

?>
