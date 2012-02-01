<?php
/**
*  A library class to handle the basic OAuth 2.0 server side flow.
*/
abstract class OAuth2_Abstract {
    
    protected abstract function getClientID();
    protected abstract function getClientSecret();
    protected abstract function getRedirectURI();
    protected abstract function getTokenURL(); 

    // {{{ post($url, array $params):                       private string

    /**
    * Use cURL to post a request.
    *
    * FIXME: This needs better error handling.
    */
    private function post($url, array $params) {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
    } 

    // }}}

    // {{{ getAccessToken($code):                                           protected hash
	
	protected function getAccessToken($code) {
        $site = Zend_Registry::get('site');
        $home = Zend_Registry::get('config')->home->{$site};
        
        $url = $this->getTokenURL();
        $params = array(
                    'client_id'=>$this->getClientID(),
                    'redirect_uri'=> $home . $this->getRedirectURI(),
                    'client_secret'=> $this->getClientSecret(),
                    'code'=>$code,
                    'grant_type'=>'authorization_code'
        );
        $response = $this->post($url, $params);
     
		$result = json_decode($response);
        if(!empty($result) && (isset($result->access_token) || isset($result->error))) {
            if(isset($result->error)) {
                throw new RuntimeException('An error was recieved from remote server: ' . (isset($result->error->message) ? $result->error->message : $result->error)); 
            } 
            return $result->access_token;
        } else {
            $result = null;
            parse_str($response, $result);
            if(empty($result)) {
                throw new RuntimeException('Attempt to connect to Authorization site returned an unparsable response!  Raw response: ' . $response);
            }
            return $result['access_token'];
        }
	}

    // }}}
    // {{{ getUserInformation($code):                                       protected object
	
	protected function getUserInformation($code, $url) {
		$token = $this->getAccessToken($code);
		
		$apiURL = $url . '?access_token=' . $token;
		return json_decode(file_get_contents($apiURL));
	}

    // }}}


}

?>
