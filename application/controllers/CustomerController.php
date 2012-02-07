<?php

class CustomerController extends Zend_Controller_Action {


    // {{{ registerAction()

    public function registerAction() {
        if(Zend_Auth::getInstance()->hasIdentity()) {
            throw new RuntimeException('Attempting to register when already logged in!');
        }

        if($this->getRequest()->isPost()) {
            $translator = new Application_Service_Translator_Customer();
            $user = new Application_Model_User();
            if(!$translator->translate($user, $this->getRequest()->getPost())) {
                $this->view->errors = $translator->getErrors(); 
            } else {
                $persistor = new Application_Model_Persistor_User();
                $persistor->save($user);
        
                $this->_helper->redirector('dashboard'); 
            }
        } 

    }

    // }}}
    // {{{ dashboardAction()

    public function dashboardAction() {
        if(!Zend_Auth::getInstance()->hasIdentity()) {
            throw new RuntimeException('We should not be here with out an identity.');
        }

    }

    // }}}
}

?>
