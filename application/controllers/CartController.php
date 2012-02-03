<?php

class CartController extends Zend_Controller_Action {
    $private $_session; 
     
    private function getSession() {
        if(empty($this->_session)) {
            $this->_session = new Zend_Session_Namespace('buyer');
        }        
        return $this->_session; 
    }


    public function addAction() {
        $id = $this->getRequest()->getParam('id', null);

        if($id === null) {
            throw new RuntimeException('You cannot add something to your cart with out an id!');
        }

        if(empty($this->getSession()->buyer)) {
            // create a buyer
        } 
    }

    public function viewAction() {


    }

    public function checkoutAction() {

    }

}

?>
