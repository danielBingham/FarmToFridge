<?php

class Application_Service_Translator_Grower {
    private $errors = array();
   

    // {{{ translate(Application_Model_User $grower, $post):              public boolean

    public function translate(Application_Model_User $grower, $post) {
        $success = true; 
        $existing = Application_Model_Query_User::getInstance()->fetchAll(array('email'=>$post['email']));
        if(count($existing) != 0) {
            $this->errors[] = 'Someone is already registered with that email.'; 
            $success = false; 
        }

        if($post['password'] != $post['confirm']) {
            $this->errors[] = 'Passwords do not match.';
            $success = false; 
        }
         
        $grower->email = $post['email']; 
        $grower->password = $post['password'];
        $grower->isGrower = true; 
        return $success;
     }

    // }}}
    // {{{ getErrors():                                                     public array

    public function getErrors() {
        return $this->errors;
    }

    // }}}

}

?>
