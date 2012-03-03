<?php 

class Application_Service_Translator_Category {
    private $errors = array();

    // {{{ translate(Application_Model_Category $category, array $post):    public void

    public function translate(Application_Model_Category &$category, array $post) {
        $category->name = $post['name'];
        return true; 
    }

    // }}}
    // {{{ getErrors()

    public function getErrors() {
        return $this->errors;
    }

    // }}}
}

?>
