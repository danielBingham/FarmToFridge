<?php

class Application_Model_ProductTag extends Application_Model_Abstract {

    // Associations
    protected $_tag;
    protected $_product;


    // {{{ __construct($lazy=true)
    
    public function __construct($lazy=true) {
        $this->_fields = array('id', 'tagID', 'productID');
        $this->id = false;
        if($lazy) {
			$this->setBuilder(new Application_Model_Builder_ProductTag())
				->allowLazyLoad();
		}
    }

    // }}}


    // Association Methods
    // {{{ getTag():                                                        public Application_Model_Tag
    
    public function getTag() {
        if(empty($this->_tag) && $this->loadLazy()) {
            $this->getBuilder()->build('tag', $this);
        }
        return $this->_tag;
    }

    // }}}
    // {{{ setTag(Application_Model_Tag $tag):                              public void

    public function setTag(Application_Model_Tag $tag) {
        $this->_tag = $tag;
        $this->tagID = $tag->id;
        return $this;
    }

    // }}}
    // {{{ getProduct():                                                    public Application_Model_Product

    public function getProduct() {
        if(empty($this->_product) && $this->loadLazy()) {
            $this->getBuilder()->build('product', $this);
        }
        return $this->_product;
    }

    // }}}
    // {{{ setProduct(Application_Model_Product $product):                  public void

    public function setProduct(Application_Model_Product $product) {
        $this->_product = $product;
        $this->productID = $product->id;
        return $this;
    }

    // }}}
}


?>
