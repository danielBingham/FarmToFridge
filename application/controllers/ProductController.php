<?php


class ProductController extends Zend_Controller_Action {

    // {{{ browseAction()

    public function browseAction() {
        $this->view->products = Application_Model_Query_Product::getInstance()->fetchAll();
    }

    // }}}
    // {{{ viewAction()

    public function viewAction() {
        $id = $this->getRequest()->getParam('id');

        $this->view->product = Application_Model_Query_Product::getInstance()->get($id);

    }

    // }}}
    // {{{ editAction()

    public function editAction() {
        if(!Zend_Auth::getInstance()->hasIdentity() || false == Zend_Auth::getInstance()->getIdentity()->isGrower) {
            throw new RuntimeException('Only logged in growers may edit products.');
        }

        $id = $this->getRequest()->getParam('id', null);
        if($id !== null) {
            $product = Application_Model_Query_Product::getInstance()->get($id); 
        } else {
            $product = new Application_Model_Product();
            $farmID = $this->getRequest()->getParam('farmID', null);
            if($farmID === null) {
                throw new RuntimeException('No farm given, no farm to add this product to.');
            }
            
            $farm = Application_Model_Query_Farm::getInstance()->get($farmID);
            if($farm->userID != Zend_Auth::getInstance()->getIdentity()->id) {
                throw new RuntimeException('You may only add products to farms you own!');
            }

            $product->farmID = $farmID;    
        }

        

        if($this->getRequest()->isPost()) {
            $translator = new Application_Service_Translator_Product();
            if(!$translator->translate($product, $this->getRequest()->getPost())) {
                $this->view->errors = $translator->getErrors();
            } else {
                $persistor = new Application_Model_Persistor_Product();
                $persistor->save($product);

                return $this->_helper->redirector('dashboard', 'grower');
            }
        }

        $this->view->product = $product;
        
    }

    // }}}

}


?>
