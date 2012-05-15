<?php


/**
* Controller to handle the customers cart.
* 
*  A couple of notes.  This controller works with in the 'cart' session namespace.
* It stores an Application_Model_Order and an Application_Model_User in that namespace.
* The user will be saved in the database, but not properly registered.  Both are set by
* the addAction(). All other actions require them to be there, and will throw errors if
* they are not, except for the viewAction() which will simply show an empty cart. 
*/
class CartController extends Zend_Controller_Action {
    private $_session; 
    
    // {{{ getSession():                                                    private Zend_Session_Namespace('cart')
    /**
    * Get the session namespace that we'll be using to store 
    * order and cart information.
    */ 
    private function getSession() {
        if(empty($this->_session)) {
            $this->_session = new Zend_Session_Namespace('cart');
        }        
        return $this->_session; 
    }

    // }}}
    // {{{ addAction()

    /**
    * Add an item to the cart through a non-ajax GET call.
    *
    * @param id The product id that we're adding to the cart.
    */
    public function addAction() {
        $id = $this->getRequest()->getParam('id', null);
        $amount = 1; // The only time we're actually going to take this as a parameter is in an
        // ajax call, which we will handle in a different action.


        if($id === null) {
            throw new RuntimeException('You cannot add something to your cart with out an id!');
        }

        $product = Application_Model_Query_Product::getInstance()->get($id);
        if($product === null) {
            throw new RuntimeException('Attempt to add a non-existent product to cart.');
        }

        if(empty($this->getSession()->customer)) {
            // If we don't have a customer, make one.
            // TODO: We only want to do this if non-member buying is
            // allowed (or do we...?) 
            if(!Zend_Auth::getInstance()->hasIdentity()) {
                $customer = new Application_Model_User();
                $persistor = new Application_Model_Persistor_User();
                $persistor->save($customer);
            } else {
                $customer = Zend_Auth::getInstance()->getIdentity();
            }
            $this->getSession()->customer = $customer; 
        } 

        if(empty($this->getSession()->order)) {
            $order = new Application_Model_Order();
            $order->userID = $this->getSession()->customer->id;
            $order->orderedOn = Zend_Date::Now();
            $order->state = Application_Model_Order::STATE_UNCONFIRMED;
            $this->getSession()->order = $order; 
        } 
        
        $orderProduct = new Application_Model_OrderProduct();
        $orderProduct->productID = $product->id;
        $orderProduct->amount = $amount;
        $this->getSession()->order->addOrderProduct($orderProduct); 
        $this->_helper->redirector('browse', 'product');
    }

    // }}}
    // {{{ removeAction()
    
    /**
    *  Remove an item from the user's cart through a GET request.  
    *
    * @param id The id of the product to be removed.
    */ 
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

    // }}}
    // {{{ emptyAction()
       
    /**
    * Empty the customer's cart.      
    */ 
    public function emptyAction() {
        if(empty($this->getSession()->order)) {
            return $this->_helper->redirector('view');
        }
        
        // At this point, the order shouldn't have
        // been saved anywhere, so we should be safe to just modify the object
        // stored in session.
        $this->getSession()->order->setOrderProducts(array());
        return $this->_helper->redirector('view');

    }

    // }}}
    // {{{ viewAction()

    /**
    * View the customer's cart.
    */
    public function viewAction() {
        // If we're missing either a customer or an order in session, then
        // something is wrong.  Explicitly set the order to null so we can
        // show an empty cart.  Wipe out both order and customer as well.
        if(empty($this->getSession()->customer) || empty($this->getSession()->order)) {
            unset($this->getSession()->customer);
            unset($this->getSession()->order);
            $this->view->order= null;
            return;
        }

        $this->view->order = $this->getSession()->order;
    }

    // }}}
    // {{{ checkoutAction()

    /**
    * Handle the submission of the cart form to either update the amounts
    * being ordered (and therefore update the price totals displayed) or
    * process the amounts being order and proceed with checkout.  Sends
    * the user, either to register if they aren't yet registered or to
    * the select payment method page if they are.
    *   
    */
    public function checkoutAction() {
        if(empty($this->getSession()->order)) {
            return $this->_helper->redirector('view');
        }
        $post = $this->getRequest()->getPost();

        // Regardless of what we're doing, we need to make sure the amounts are
        // up to date.
        foreach($this->getSession()->order->getOrderProducts() as $orderProduct) {
            $orderProduct->amount = $post['amount'][$orderProduct->getProduct()->id];
        }

        // If they aren't checking out, then they were just updating the amounts.
        // Send them back to cart view.
        // 
        // TODO: It would be more aesthetically pleasing to have an intermediate action
        // that handled determining which button they pushed and forwarded them to the
        // appropriate action.
        if($post['submit'] != 'Checkout') {
            return $this->_helper->redirector('view');

        // If they are checking out, then we want to save the order and register
        // the customer.   
        } else {
            $persistor = new Application_Model_Persistor_Order();
            $persistor->save($this->getSession()->order);
            if($this->getSession()->customer->email === false) {
                return $this->_helper->redirector('register', 'customer', null, array('redirect'=>'checkout'));
            } else {
                return $this->_helper->redirector('payment');
            } 
        }
    }

    // }}}
    // {{{ paymentAction()
   
    // TODO For now this is just a straight passthrough to confirm,
    // so that we can start testing the rest of the system.  We'll
    // need to write actual handlers for the various payment methods
    // and services at some point. 
    public function paymentAction() {
        if($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            if(isset($post['paypal'])) {
                return $this->_helper->redirector('index', 'paypal');
            } else { 
                return $this->_helper->redirector('confirm');
            }
        }

    }

    // }}}
    // {{{ confirmAction()

    public function confirmAction() {
        if($this->getSession()->order->state == Application_Model_Order::STATE_UNCONFIRMED) {
            $this->getSession()->order->state = Application_Model_Order::STATE_CONFIRMED;      
 
            $persistor = new Application_Model_Persistor_Order();
            $persistor->save($this->getSession()->order);
        }

        // Clear the cart.
        unset($this->getSession()->customer);
        unset($this->getSession()->order);

        $this->_helper->redirector('browse', 'product');
    }

    // }}}


}

?>
