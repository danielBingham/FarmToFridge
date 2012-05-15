<?php 

class Application_Model_Builder_Farm extends Application_Model_Builder_Abstract {
   
    // {{{ __construct()
 
    public function __construct() {
        $this->_haveBuilt = array(
            'user'=>false,
            'products'=>false, 
            'farmImages'=>false
         );
    }

    // }}}
    
    // {{{ buildUser(Application_Model_Farm $farm):                         public void
    
    public function buildUser(Application_Model_Farm $farm) {
        if($farm->userID === false) {
            throw new RuntimeException('Farm->userID must be set in order to load User.');
        }
        $farm->setUser(Application_Model_Query_User::getInstance()->get($farm->userID));
    }

    // }}}
    // {{{ buildProducts(Application_Model_Farm $farm):                     public void

    public function buildProducts(Application_Model_farm $farm) {
        if($farm->id === false) {
            throw new RuntimeException('Farm->id must be set in order to load Products.');
        }
        $farm->setProducts(Application_Model_Query_Product::getInstance()->fetchAll(array('farmID'=>$farm->id)));
    }

    // }}}
    // {{{ buildFarmImages(Application_Model_Farm $farm):               public void

    public function buildFarmImages(Application_Model_Farm $farm) {
        if($farm->id === false) {
            throw new RuntimeException('Farm->id must be set in order to load FarmImages.');
        }
        $farm->setFarmImages(Application_Model_Query_FarmImage::getInstance()->fetchAll(array('farmID'=>$farm->id)));
    }

    // {{{
         

}


?>
