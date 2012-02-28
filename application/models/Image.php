<?php

class Application_Model_Image extends Application_Model_Abstract {

    // {{{ getImageURL($size='medium'):                                     public string

    public function getImageURL($size='medium') {
        $validSizes = array('small', 'medium', 'large', 'full');
        if(!in_array($size, $validSizes)) {
            throw new RuntimeException('That is an invalid image size!');
        }

        $config = Zend_Registry::get('config');
        $url = $config->hosts->images . DIRECTORY_SEPARATOR . $size . DIRECTORY_SEPARATOR . $this->id . '.jpg'; 
        return $url; 
    }

    // }}}

    // {{{ __construct()

    public function __construct($lazy=true) {
        parent::__construct('Image', array('id', 'width', 'height', 'userID'), $lazy); 
    }

    // }}}


}
?>
