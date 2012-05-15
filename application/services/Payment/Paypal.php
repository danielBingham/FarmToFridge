<?php
/**
* Service to manage Paypal Express Checkout.
*
* TODO: Error handling, better security.
*/
class Application_Service_Payment_Paypal extends Application_Service_Payment_Abstract {
    private $APIEndpoint = 'https://api-3t.sandbox.paypal.com/nvp';
    private $APIUsername = ''; // Set from the configuration.
    private $APIPassword = ''; // Removed to commit
    private $APISignature = ''; // Removed to commit
    private $APIVersion = '86.0';

    private $response;

    // {{{ initialize(array $parameters=array()):                           public void

    public function initialize(array $parameters=array()) {
        if(!isset($parameters['amount']) || !isset($parameters['successURL']) || !isset($parameters['cancelURL'])) {
            throw new RuntimeException('Paypal initialize() is missing parameters.');
        }
        $this->setExpressCheckout($parameters['amount'], $parameters['successURL'], $parameters['cancelURL']);
    }

    // }}}
    // {{{ confirm(array $parameters=array()):                              public void

    public function confirm(array $parameters=array()) {
        if(!isset($parameters['amount']) || !isset($parameters['token'])) {
            throw new RuntimeException('Paypal confirm() is missing parameters!');
        }
        $this->getExpressCheckoutDetails($parameters['amount'], $parameters['token']);
    }

    // }}}
    // {{{ handleSuccess(array $parameters=array()):                        public void

    public function handleSuccess(array $parameters=array()) {
        if(!isset($parameters['total']) || !isset($parameters['token']) || !isset($parameters['payerID'])) {
            throw new RuntimeException('Paypal handleSuccess() is missing a parameter.');
        }
        $this->doExpressCheckoutPayment($parameters['total'], $parameters['token'], $parameters['payerID']);
    }

    // }}}
    // {{{ handleFailure(array $parameters=array()):                        public void

    public function handleFailure(array $parameters=array()) {

    }

    // }}}
    // {{{ handleCancel():                                                  public void

    public function handleCancel() {

    }

    // }}}
    // {{{ getForwardURL():                                                 public string(url)

    public function getForwardURL() {
        return 'https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&token=' . $this->getToken();
    }

    // }}}


    // {{{ __construct()

    public function __construct() {
        $config = new Application_Service_Configuration();
        $this->APIUsername = $config->get('paypal_username');
        $this->APIPassword = $config->get('paypal_password'); 
        $this->APISignature = $config->get('paypal_signature');
    }

    // }}}

    // {{{ setExpressCheckout($amount, $successURL, $failureURL):           public void

    public function setExpressCheckout($amount, $successURL, $failureURL) {
        $queryString = 'USER=' . urlencode($this->APIUsername) 
                        . '&PWD=' . urlencode($this->APIPassword) 
                        . '&SIGNATURE=' . urlencode($this->APISignature)
                        . '&VERSION=' . urlencode($this->APIVersion)
                        . '&METHOD=SetExpressCheckout'
                        . '&PAYMENTREQUEST_0_AMT=' . urlencode($amount)
                        . '&PAYMENTREQUEST_0_CURRENCYCODE=USD' 
                        . '&PAYMENTREQUEST_0_PAYMENTACTION=Sale'
                        . '&RETURNURL=' . urlencode('http://farmtofridge.test' . $successURL)
                        . '&CANCELURL=' . urlencode('http://farmtofridge.test' . $failureURL);

        $curlHandle = curl_init();

        curl_setopt($curlHandle, CURLOPT_URL, $this->APIEndpoint);
        curl_setopt($curlHandle, CURLOPT_VERBOSE, 1);

        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_POST, 1);

        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $queryString);

        $this->response = $this->parseResponse(curl_exec($curlHandle));
        curl_close($curlHandle);
    }

    // }}}
    // {{{ getExpressCheckoutDetails($amount, $token):                      public void

    public function getExpressCheckoutDetails($amount, $token) {
        $queryString = 'USER=' . urlencode($this->APIUsername) 
                        . '&PWD=' . urlencode($this->APIPassword) 
                        . '&SIGNATURE=' . urlencode($this->APISignature)
                        . '&VERSION=' . urlencode($this->APIVersion)
                        . '&METHOD=GetExpressCheckoutDetails'
                        . '&PAYMENTREQUEST_0_AMT=' . urlencode($amount)
                        . '&PAYMENTREQUEST_0_CURRENCYCODE=USD' 
                        . '&PAYMENTREQUEST_0_PAYMENTACTION=Sale'
                        . '&TOKEN=' . urlencode($token); 

        $curlHandle = curl_init();

        curl_setopt($curlHandle, CURLOPT_URL, $this->APIEndpoint);
        curl_setopt($curlHandle, CURLOPT_VERBOSE, 1);

        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_POST, 1);

        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $queryString);

        $this->response = $this->parseResponse(curl_exec($curlHandle));

        curl_close($curlHandle);

    } 

    // }}}
    // {{{ doExpressCheckoutPayment($amount, $token, $payerID):             public void

    public function doExpressCheckoutPayment($amount, $token, $payerID) {
        $queryString = 'USER=' . urlencode($this->APIUsername) 
                        . '&PWD=' . urlencode($this->APIPassword) 
                        . '&SIGNATURE=' . urlencode($this->APISignature)
                        . '&VERSION=' . urlencode($this->APIVersion)
                        . '&METHOD=DoExpressCheckoutPayment'
                        . '&PAYMENTREQUEST_0_AMT=' . urlencode($amount)
                        . '&PAYMENTREQUEST_0_CURRENCYCODE=USD' 
                        . '&PAYMENTREQUEST_0_PAYMENTACTION=Sale'
                        . '&PAYERID=' . urlencode($payerID)
                        . '&TOKEN=' . urlencode($token); 

        $curlHandle = curl_init();

        curl_setopt($curlHandle, CURLOPT_URL, $this->APIEndpoint);
        curl_setopt($curlHandle, CURLOPT_VERBOSE, 1);

        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_POST, 1);

        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $queryString);

        $this->response = $this->parseResponse(curl_exec($curlHandle));

        curl_close($curlHandle);
    }

    // }}}

    // {{{ parseResponse($response):                                        private array

    private function parseResponse($response) {
        $results = array();
            
        $fields = explode('&', $response);
        foreach($fields as $field) {
            $fieldArray = array_map('urldecode', explode('=', $field));
            $results[$fieldArray[0]] = $fieldArray[1];
        }
        return $results;
    }

    // }}}
    // {{{ getResponse():                                                   public array

    public function getResponse() {
        return $this->response;
    }

    // }}}
    // {{{ getToken():                                                      public string

    public function getToken() {
        return $this->response['TOKEN'];
    }

    // }}}
    // {{{ getPayerID():                                                    public string

    public function getPayerID() {
        return $this->response['PAYERID'];
    }

    // }}}

}


?>
