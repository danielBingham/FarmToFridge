<?php

class Application_Model_Product extends Application_Model_Abstract {

    // Associations
    private $_category;
    private $_farm;

    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
	    $this->_fields = array('id', 'name', 'categoryID', 'farmID', 'price', 'amount');	
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
}

?>
