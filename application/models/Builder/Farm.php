<?php 

class Application_Model_Builder_Farm extends Application_Model_Builder_Abstract {
   
    // {{{ __construct()
 
    public function __construct() {
        $this->_haveBuilt = array(
            'grower'=>false,
            'products'=>false 
        );
    }

    // }}}
    
    // {{{ buildGrower(Application_Model_Farm $farm):                       public void
    
    public function buildGrower(Application_Model_Farm $farm) {
        $farm->setGrower(Application_Model_Query_Grower::getInstance()->get($farm->growerID));
    }

    // }}}
    // {{{ buildProducts(Application_Model_Farm $farm):                     public void

    public function buildProducts(Application_Model_farm $farm) {
        $farm->setProducts(Application_Model_Query_Product::getInstance()->fetchAll(array('farmID'=>$farm->id)));
    }

    // }}}


}


?>
