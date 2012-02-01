<?php

class Application_Model_Tag extends Application_Model_Abstract {
   
    // Associations
    protected $_productTags;
 
    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        $this->_fields = array('id', 'name');
        $this->id = false;
        if($lazy) {
			$this->setBuilder(new Application_Model_Builder_Tag())
				->allowLazyLoad();
		}

    }

    // }}}


    // Association Methods
    // {{{ getProductTags():                                                public array(Application_Model_ProductTag)
    
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

}

?>
