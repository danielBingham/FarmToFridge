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
            $persistor = new Application_Model_Persistor_Order();
            $persistor->save($order);
            $this->getSession()->order = $order; 
        } 

        $orderProduct = new Application_Model_OrderProduct();
        $orderProduct->orderID = $this->getSession()->order->id;
        $orderProduct->productID = $product->id;
        $orderProduct->amount = $amount;
        $persistor = new Application_Model_Persistor_OrderProduct();
        $persistor->save($orderProduct);
        $this->getSession()->order->addOrderProduct($orderProduct); 
        
    }

    public function viewAction() {
        if(empty($this->getSession()->buyer) || empty($this->getSession()->order)) {
            $this->view->products = array();
            return;
        }

        $this->view->order = $this->getSession()->order;
    }

    public function checkoutAction() {

    }

}

?>
