<?php

class Application_Model_FarmImage extends Application_Model_Abstract {

    // Associations
    protected $_image;
    protected $_farm;

    // {{{ __construct()

    public function __construct() {
        $this->_fields = array('id', 'imageID', 'farmID', 'primary');
        $this->id = false;
        if($lazy) {
			$this->setBuilder(new Application_Model_Builder_FarmImage())
				->allowLazyLoad();
		}

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
}

?>
