<?php


class Application_Service_Translator_Product {
    private $errors = array();

    // {{{ translate(Application_Model_Product $product, array $post):      public boolean

    public function translate(Application_Model_Product $product, array $post) {
        $product->name = $post['name'];
        $product->description = $post['description']; 
        $product->categoryID = $post['category'];
        $product->price = $post['price'];
        $product->amount = $post['amount'];
        $product->unitID = $post['unit'];
        return true;
    }

    // }}}
    // {{{ getErrors():                                                     public array

    public function getErrors() {
        return $this->errors;
    }

    // }}}

}


?>
