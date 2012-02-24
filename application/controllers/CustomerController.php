<?php

class CustomerController extends Zend_Controller_Action {


    // {{{ registerAction()

    /**
    *  Register a new customer user. Take a redirect as a parameter.
    * If the redirect is "checkout", send the newly registered user
    * back to the checkout step.  
    *
    */
    public function registerAction() {
        if(Zend_Auth::getInstance()->hasIdentity()) {
            throw new RuntimeException('Attempting to register when already logged in!');
        }

        $redirect = $this->getRequest()->getParam('redirect', 'dashboard');

        if($this->getRequest()->isPost()) {
            $translator = new Application_Service_Translator_Customer();
            if($redirect == 'checkout') {
                $session = new Zend_Session_Namespace('cart');
                $user = $session->customer;
            } else {
                $user = new Application_Model_User();
            }

            if(!$translator->translate($user, $this->getRequest()->getPost())) {
                $this->view->errors = $translator->getErrors(); 
            } else {
                $persistor = new Application_Model_Persistor_User();
                $persistor->save($user);
     
                // Log in this user. 
                Zend_Auth::getInstance()->getStorage()->write($user);

 
                if($redirect == 'checkout') {
                    $session->customer = $user; 
                    $this->_helper->redirector('payment', 'cart'); 
                } else { 
                    $this->_helper->redirector('dashboard'); 
                }
            }
        } 

    }

    // }}}
    // {{{ dashboardAction()

    public function dashboardAction() {
        if(!Zend_Auth::getInstance()->hasIdentity()) {
            throw new RuntimeException('We should not be here with out an identity.');
        }
        
        $this->view->pendingOrder = Application_Model_Query_Order::getInstance()->findOne(array(
                                                        'userID'=>Zend_Auth::getInstance()->getIdentity()->id,
                                                        'confirmed'=>1,
                                                        'filled'=>0));
    }

    // }}}

}

?>
