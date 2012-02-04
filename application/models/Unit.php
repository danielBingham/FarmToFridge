<?php


class Application_Model_Unit extends Application_Model_Abstract {
    
    // {{{ __construct()
    
    public function __construct($lazy=true) {
        parent::__construct('Unit', array('id', 'name', 'abbreviation'), $lazy);
    }

    // }}}

}

?>
