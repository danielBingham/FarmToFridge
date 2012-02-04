<?php

class Application_Model_Image extends Application_Model_Abstract {

    // {{{ __construct()

    public function __construct($lazy=true) {
        parent::__construct('Image', array('id', 'width', 'height', 'userID'), $lazy); 
    }

    // }}}


}
?>
