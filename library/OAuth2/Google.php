<?php
/**
*
*/
class OAuth2_Google extends OAuth2_Abstract {
    private $_clientID;
    private $_clientSecret;

    private $_redirectURI = '/login/google';
    private $_tokenURL = 'https://accounts.google.com/o/oauth2/token';

    // {{{ __construct($clientID, $clientSecret)

    public function __construct($clientID, $clientSecret) {
        $this->_clientID = $clientID;
        $this->_clientSecret = $clientSecret;
    }

    // }}}
    // {{{ getClientID():                                                   protected string

    protected function getClientID() {
        return $this->_clientID;
    }

    // }}}
    // {{{ getClientSecret():                                               protected string
 
    protected function getClientSecret() {
        return $this->_clientSecret;
    }

    // }}}
    // {{{ getRedirectURI():                                                protected string

    protected function getRedirectURI() {
        return $this->_redirectURI;
    }

    // }}}
    // {{{ getTokenURL():                                                   protected string

    protected function getTokenURL() {
        return $this->_tokenURL;
    }

    // }}}

    // {{{ getUserInformation($code):                                       protected object
	
	protected function getUserInformation($code) {
		return parent::getUserInformation($code, 'https://www.googleapis.com/oauth2/v1/userinfo');
	}

    // }}}


}
?>
