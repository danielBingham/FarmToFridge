<?php

class Application_Service_Translator_Customer {
    private $errors = array();
   

    // {{{ translate(Application_Model_User $customer, $post):              public boolean

    public function translate(Application_Model_User $customer, $post) {
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
         
        $customer->email = $post['email']; 
        $customer->password = $post['password'];
        $customer->name = $post['name'];
        $customer->phone = $post['phone'];
        $customer->type = Application_Model_User::TYPE_INACTIVE; 
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
