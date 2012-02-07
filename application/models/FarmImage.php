<?php

class Application_Model_FarmImage extends Application_Model_Abstract {

    // Associations
    protected $_image;
    protected $_farm;

    // {{{ __construct()

    public function __construct($lazy=true) {
        parent::__construct('FarmImage', array('id', 'imageID', 'farmID', 'main'), $lazy);
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
    // {{{ setImage(Application_Model_Image $image):                        public void

    public function setImage(Application_Model_Image $image) {
        $this->_image = $image;
        $this->imageID = $image->id;
        return $this;
    }

    // }}} 
    // {{{ getFarm():                                                       public Application_Model_Farm
    
    public function getFarm() {
        if(empty($this->_farm) && $this->loadLazy()) {
            $this->getBuilder()->build('farm', $this);
        }
        return $this->_farm;
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
