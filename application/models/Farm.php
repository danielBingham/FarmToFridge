<?php
/**
*
*/

class Application_Model_Farm extends Application_Model_Abstract {
    // Associations
    private $_user;
    private $_products;
    private $_images;

    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        parent::__construct('Farm', array('id', 'name', 'description', 'phone', 'email', 'address', 'website', 'userID'), $lazy); 
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
        $this->userID = $user->id; 
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
    // {{{ getFarmImages():                                                     public array(Application_Model_Image)

    public function getFarmImages() {
        if(empty($this->_images) && $this->loadLazy()) {
            $this->getBuilder()->build('farmImages', $this);
        }
        return $this->_images;
    }

    // }}}
    // {{{ setFarmImages(array $images):                                        public void

    public function setFarmImages(array $images) {
        $this->_images = $images;
        return $this; 
    }

    // }}}     
    // {{{ getPrimaryImage():                                               public Application_Model_Image
   
    public function getPrimaryImage() {
        if($this->getFarmImages()) {
            foreach($this->getFarmImages() as $farmImage) {
                if($farmImage->main) {
                    return $farmImage->getImage();
                }
            }
        
            return (isset($this->_images[0]) ? $this->_images[0] : false);
        }
        return false;
    }
    
    // }}} 

}

?>
