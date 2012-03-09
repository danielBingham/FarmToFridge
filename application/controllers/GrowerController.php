<?php

class GrowerController extends Zend_Controller_Action {

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

                // Log in this user. 
                Zend_Auth::getInstance()->getStorage()->write($user);

                return $this->_helper->redirector('dashboard', 'grower');
            }
        }

    }

    // }}}
    // {{{ dashboardAction()

    public function dashboardAction() {
        if(!Zend_Auth::getInstance()->hasIdentity() || Zend_Auth::getInstance()->getIdentity()->isGrower === false) {
            return $this->_helper->redirector('browse', 'product');
        }

        $this->view->farms = Application_Model_Query_Farm::getInstance()->fetchAll(array('userID'=>Zend_Auth::getInstance()->getIdentity()->id));       
        $this->view->ordersPending = count(Application_Model_Query_Order::getInstance()->getOrdersForGrower(Zend_Auth::getInstance()->getIdentity(),
                                                    array(Application_Model_Order::STATE_CONFIRMED, Application_Model_Order::STATE_PAID)));
    }

    // }}}
    // {{{ ordersAction()

    public function ordersAction() {
        if(!Zend_Auth::getInstance()->hasIdentity() || Zend_Auth::getInstance()->getIdentity()->isGrower === false) {
            return $this->_helper->redirector('index', 'index');
        } 
        
        $state = $this->getRequest()->getParam('state', null);

        // If they haven't given us a state, then we want to show them
        // the counts of orders they have in each state.
        if($state === null) {
            $grower = Zend_Auth::getInstance()->getIdentity();
            $this->view->pending = count(Application_Model_Query_Order::getInstance()->getOrdersForGrower($grower, 
                                                array(Application_Model_Order::STATE_CONFIRMED, Application_Model_Order::STATE_PAID)));
            $this->view->assembled = count(Application_Model_Query_Order::getInstance()
                                        ->getOrdersForGrower($grower, Application_Model_Order::STATE_ASSEMBLED));
            $this->view->filled = count(Application_Model_Query_Order::getInstance()
                                        ->getOrdersForGrower($grower, Application_Model_Order::STATE_FILLED));
            $this->view->grower = $grower;
        } else {
            $this->view->state = $state;
            
            $order = $this->getRequest()->getParam('order', 'size');
            $page = $this->getRequest()->getParam('page', 1);
            $this->view->orders = new Zend_Paginator(new Application_Service_Paginator_Adapter_Order_InState($state, $order));
            $this->view->orders->setItemCountPerPage(5);
            $this->view->orders->setCurrentPageNumber($page);
            
            $this->view->grower = Zend_Auth::getInstance()->getIdentity();
        }
    }

    // }}}

    

}

?>
