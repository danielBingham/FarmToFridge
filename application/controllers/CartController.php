<?php

class CartController extends Zend_Controller_Action {
    private $_session; 
     
    private function getSession() {
        if(empty($this->_session)) {
            $this->_session = new Zend_Session_Namespace('buyer');
        }        
        return $this->_session; 
    }


    public function addAction() {
        $id = $this->getRequest()->getParam('id', null);
        $amount = $this->getRequest()->getParam('amount', 1);


        if($id === null) {
            throw new RuntimeException('You cannot add something to your cart with out an id!');
        }

        $product = Application_Model_Query_Product::getInstance()->get($id);
        if($product === null) {
            throw new RuntimeException('Attempt to add a non-existent product to cart.');
        }

        if(empty($this->getSession()->buyer)) {
            $buyer = new Application_Model_Buyer();
            $persistor = new Application_Model_Persistor_Buyer();
            $persistor->save($buyer);
            $this->getSession()->buyer = $buyer; 
        } 

        if(empty($this->getSession()->order)) {
            $order = new Application_Model_Order();
            $order->buyerID = $this->getSession()->buyer->id;
            $order->orderedOn = Zend_Date::Now();
            $this->getSession()->order = $order; 
        } 
        
        $orderProduct = new Application_Model_OrderProduct();
        $orderProduct->productID = $product->id;
        $orderProduct->amount = $amount;
        $this->getSession()->order->addOrderProduct($orderProduct); 
    }

    public function viewAction() {
        if(empty($this->getSession()->buyer) || empty($this->getSession()->order)) {
            $this->view->order= null;
            return;
        }

        $this->view->order = $this->getSession()->order;
    }

    public function checkoutAction() {
        if(empty($this->getSession()->order)) {
            return $this->_helper->redirector('view');
        }
        $post = $this->getRequest()->getPost();


        if($post['submit'] != 'Checkout') {
            foreach($this->getSession()->order->getOrderProducts() as $orderProduct) {
                $orderProduct->amount = $post['amount'][$orderProduct->getProduct()->id];
            }
            return $this->_helper->redirector('view');
        }

    }

    public function removeAction() {
        $id = $this->getRequest()->getParam('id', null);
        if($id === null) {
            throw new RuntimeException('You must have an id to remove an item from your cart.'); 
        }

        if(empty($this->getSession()->order)) {
            throw new RuntimeException('You can not remove an item from an empty order!');
        }

        $this->getSession()->order->removeOrderProduct($id);
        return $this->_helper->redirector('view');
    }


}

?>
