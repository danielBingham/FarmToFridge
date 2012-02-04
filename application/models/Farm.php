<?php
/**
*
*/

class Application_Model_Farm extends Application_Model_Abstract {
    // Associations
    private $_user;
    private $_products;

    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        parent::__construct('Farm', array('id', 'name', 'description', 'userID'), $lazy); 
    }

    // }}}

    // Association Methods
    // {{{ getUser():                                                       public Application_Model_User
    
    public function getUser() {
        if(empty($this->_user) && $this->loadLazy()) {
			$this->getBuilder()->build('user', $this);
		}
		return $this->_user;
    }

    // }}}
    // {{{ setUser(Application_Model_User $user):                           public $this

    public function setUser(Application_Model_User $user) {
        $this->_user = $user;
        $this->_userID = $user->id; 
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
