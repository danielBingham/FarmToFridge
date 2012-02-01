<?php

class Application_Model_Product extends Application_Model_Abstract {

    // Associations
    private $_category;

    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
	    $this->_fields = array('id', 'name', 'categoryID', 'price', 'amount');	
        $this->id = false;
		if($lazy) {
			$this->setBuilder(new Application_Model_Builder_Product())
				->allowLazyLoad();
		}
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

}

?>
