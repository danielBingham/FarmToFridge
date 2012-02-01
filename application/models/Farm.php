<?php
/**
*
*/

class Application_Model_Farm extends Application_Model_Abstract {

    // Associations
    private $_grower;
    private $_products;

    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
	    $this->_fields = array('id', 'name', 'description', 'growerID');	
        $this->id = false;  
        if($lazy) {
			$this->setBuilder(new Application_Model_Builder_Farm())
				->allowLazyLoad();
		}
    }

    // }}}

    // Association Methods
    // {{{ getGrower():                                                     public Application_Model_Grower
    
    public function getGrower() {
        if(empty($this->_grower) && $this->loadLazy()) {
			$this->getBuilder()->build('grower', $this);
		}
		return $this->_grower;
    }

    // }}}
    // {{{ setGrower(Application_Model_Grower $grower):                     public $this

    public function setGrower(Application_Model_Grower $grower) {
        $this->_grower = $grower;
        $this->_growerID = $grower->id; 
        return $this;
    }
    
    // }}}
    // {{{ getProducts():                                                   public array(Application_Model_Product)
    
    public function getProducts() {
        if(empty($this->_products) && $this->loadLazy()) {
            $this->getBuilder()->build('products', $this);
        }
        return $this->_products;
    }

    // }}}
    // {{{ setProducts(array $products):                                    public $this

    public function setProducts(array $products) {
        $this->_products = $products;
        return $this;
    }
    
    // }}}
     

}

?>
