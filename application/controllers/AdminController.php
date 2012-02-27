<?php

class AdminController extends Zend_Controller_Action {

    // {{{  indexAction()

    public function indexAction() {
        if(!Zend_Auth::getInstance()->hasIdentity()) {
            return $this->_helper->redirector('login', 'user');
        }

        if(Zend_Auth::getInstance()->getIdentity()->isAdmin == false) {
            throw new RuntimeException('Only admin may view this page.');
        }
   
         
        $config = new Application_Service_Configuration();
      
        if($this->getRequest()->isPost()) {
            foreach($this->getRequest()->getPost() as $name=>$value) {
                $config->set($name, $value);
            }
        } 
         
        $this->view->configurations =  $config->getConfigurationList();
    }

    // }}}

}

?>
