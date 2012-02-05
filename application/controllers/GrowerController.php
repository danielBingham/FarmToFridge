<?php

class GrowerController extends Zend_Controller_Action {

    // {{{ dashboardAction()

    public function dashboardAction() {
        if(!Zend_Auth::getInstance()->hasIdentity() || Zend_Auth::getInstance()->getIdentity()->isGrower === false) {
            return $this->_helper->redirector('browse', 'product');
        }

        $this->view->farms = Application_Model_Query_Farm::getInstance()->fetchAll(array('userID'=>Zend_Auth::getInstance()->getIdentity()->id));       

    }

    // }}}

}

?>
