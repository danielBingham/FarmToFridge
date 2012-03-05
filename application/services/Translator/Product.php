<?php


class Application_Service_Translator_Product {
    private $errors = array();


    // {{ parseTags(Application_Model_Product $product, array $tags):       public boolean
    
    public function parseTags(Application_Model_Product $product, array $tags) {
        $productTags = array(); 
        foreach($tags as $tagID) {
            $productTag = new Application_Model_ProductTag();
            $productTag->productID = $product->id;
            $productTag->tagID = $tagID;
            $productTags[] = $productTag;
        }
        $product->setProductTags($productTags);
        return true;
    
    }

    // }}}
    // {{{ translate(Application_Model_Product $product, array $post):      public boolean

    public function translate(Application_Model_Product $product, array $post) {
        $product->name = $post['name'];
        $product->description = $post['description']; 
        $product->categoryID = $post['category'];
        $product->price = $post['price'];
        $product->amount = $post['amount'];
        $product->unitID = $post['unit'];

        if(!empty($post['tags']) && !$this->parseTags($product, $post['tags'])) {
            return false; 
        }
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
