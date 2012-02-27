<?php

class Application_Model_Configuration extends Application_Model_Abstract {

    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
        parent::__construct('Configuration', array('id', 'name', 'value'), $lazy); 
    }

    // }}}

}

?>
