<?php 

class Application_Model_Builder_Grower extends Appplication_Model_Builder_Abstract {
    
    // {{{ __construct()
    
    public function __construct() {
        $this->_haveBuilt = array(
            'farms'=>false
        );
    }

    // }}}

    // {{{ buildFarms(Application_Model_Grower $grower):                    public void

    public function buildFarms(Application_Model_Grower $grower) {
        $grower->setFarms(Application_Model_Query_Farm::getInstance()->fetchAll(array('growerID'=>$grower->id)));
    }

    // }}}

}

?>
