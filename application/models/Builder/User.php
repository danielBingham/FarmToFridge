<?php

class Application_Model_Builder_User extends Application_Model_Builder_Abstract {
    
    // {{{ __construct()
    
    public function __construct() {
        $this->_haveBuilt = array(
            'farms'=>false,
            'orders'=>false
        );
    }

    // }}}

    // {{{ buildFarms(Application_Model_User $user):                    public void

    public function buildFarms(Application_Model_User $user) {
        if($user->id === false) {
            throw new RuntimeException('User->id must be set in order to load Farm.');
        }
        $user->setFarms(Application_Model_Query_Farm::getInstance()->fetchAll(array('userID'=>$user->id)));
    }

    // }}}
    // {{{ buildOrders(Application_Model_User $user):                     public void
    
    public function buildOrders(Application_Model_User $user) {
        if($user->id === false) {
            throw new RuntimeException('User->id must be set in order to load Orders.');
        } 
        $user->setOrders(Application_Model_Query_Order::getInstance()->fetchAll(array('userID'=>$user->id)));
    }

    // }}}

}

?>
