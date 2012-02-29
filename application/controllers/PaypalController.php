<?php
/**
* Controller to handle interaction with paypal.  Is this a temporary thing?  I don't really
* like the idea of having a million different controllers for each payment system floating
* around.  Need to figure out how to generalize the controllers and move the individual
* payment services into Service classes.  For now, however, this does the job.
* 
* TODO: generalize payment controller, move payment service specific code into
* the services.
*
*/
class PaypalController extends Zend_Controller_Action {
    

    private $_session;

    // {{{ getSession()
    
    public function getSession() {
        if(empty($this->_session)) {
            $this->_session = new Zend_Session_Namespace('cart');
        }
        return $this->_session;
    }

    // }}}

    // {{{ indexAction()

    public function indexAction() {
        $amount = $this->getSession()->order->getTotal();

        $paypalService = new Application_Service_Payment_Paypal();
        $paypalService->setExpressCheckout($amount, '/paypal/success', '/paypal/cancel');

        header('Location: https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=' . $paypalService->getToken());
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true); 
    }

    // }}}
    // {{{ successAction()

    public function successAction() {
        $paypalService = new Application_Service_Payment_Paypal();
        if($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();
            $paypalService->doExpressCheckoutPayment($this->getSession()->order->getTotal(), $post['token'], $post['payerID']);
            return $this->_forward('confirm', 'cart'); 
        }


        $token = $this->getRequest()->getParam('token', null);
        if($token === null) {
            throw new RuntimeException('A token is required to continue!');
        }
   
        $amount = $this->getSession()->order->getTotal();
 
        $paypalService->getExpressCheckoutDetails($amount, $token);

        $this->view->response = $paypalService->getResponse(); 
        $this->view->order = $this->getSession()->order;
    }

    // }}}
    // {{{ cancelAction()

    public function cancelAction() {

    }

    // }}}

}

?>
