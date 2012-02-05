<?php 


class Application_Service_Translator_Farm {
    private $errors;

    public function translate(Application_Model_Farm $farm, array $post) {
        if(false == Zend_Auth::getInstance()->hasIdentity() || false == Zend_Auth::getInstance()->getIdentity()->isGrower) {
            throw new RuntimeException('We should not be here.  Either there is no identity or the user is not a grower.');
        }
        
        $farm->name = $post['name'];
        $farm->description = $post['description'];
        $farm->userID = Zend_Auth::getInstance()->getIdentity()->id;
        return true; 
    }

    public function getErrors() {
        return array();
    }

}

?>
