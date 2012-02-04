<?php

class UserController extends Zend_Controller_Action {
    private $_authAdapter;
    
    private function getAuthAdapter() {
       if(empty($this->_authAdapter)) { 
            $this->_authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
            $this->_authAdapter->setTableName('users')
                            ->setIdentityColumn('email')
                            ->setCredentialColumn('password')
                            ->setCredentialTreatment('MD5(?)');
        }
        return $this->_authAdapter;
    } 
    

    public function loginAction() {
        if(Zend_Auth::getInstance()->hasIdentity()) {
            return $this->_helper->redirector('browse', 'products');
        }

        if(!$this->getRequest()->isPost()) {
            return;
        }

        $post = $this->getRequest()->getPost();
        $this->getAuthAdapter()->setIdentity($post['email'])
                            ->setCredential($post['password']);

        $result = Zend_Auth::getInstance()->authenticate($this->getAuthAdapter());
        if($result->isValid()) {
            $user = Application_Model_Query_User::getInstance()->get($this->getAuthAdapter()->getResultRowObject()->id);
            Zend_Auth::getInstance()->getStorage()->write($user);

            $session = new Zend_Session_Namespace('buyer');
            $session->buyer = $user;
            return $this->_helper->redirector('browse', 'products');
        }  else {
            $this->view->error = 'Login failed.  Please check your username and password.';
        } 

        

    }


    public function registerAction() {

    }

    public function dashboardAction() {
        
    }

    public function accountAction() {

    }


}

?>
