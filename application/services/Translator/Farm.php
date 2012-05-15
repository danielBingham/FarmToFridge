<?php 


class Application_Service_Translator_Farm {
    private $errors;

    // {{{ translate(Application_Model_Farm $farm, array $post):                                    public boolean

    public function translate(Application_Model_Farm $farm, array $post) {
        if(!Zend_Auth::getInstance()->hasIdentity() || !Zend_Auth::getInstance()->getIdentity()->isGrower()) {
            throw new RuntimeException('We should not be here.  Either there is no identity or the user is not a grower.');
        }
        
        $farm->name = $post['name'];
        $farm->description = $post['description'];
        $farm->phone = $post['phone'];
        $farm->address = $post['address'];
        $farm->website = $post['website'];
        $farm->email = $post['email'];
        $farm->userID = Zend_Auth::getInstance()->getIdentity()->id;
        return true; 
    }

    // }}}

    // {{{ getErrors():                     public array()

    public function getErrors() {
        return array();
    }

    // }}}
}

?>
