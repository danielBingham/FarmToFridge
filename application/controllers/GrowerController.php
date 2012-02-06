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
    // {{{ registerAction() 

    public function registerAction() {
        if(Zend_Auth::getInstance()->hasIdentity()) {
            throw new RuntimeException('Attempting to register while logged in!  This should not happen.');
        }
    
        if($this->getRequest()->isPost()) {
            $translator = new Application_Service_Translator_Grower();

            $user = new Application_Model_User();
            if(!$translator->translate($user, $this->getRequest()->getPost())) {
                $this->view->errors = $translator->getErrors();
            } else {
                $persistor = new Application_Model_Persistor_User();
                $persistor->save($user);

                return $this->_helper->redirector('dashboard', 'grower');
            }
        }

    }

    // }}}
}

?>
