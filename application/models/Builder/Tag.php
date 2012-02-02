<?php

class Application_Model_Builder_Tag extends Application_Model_Builder_Abstract {
    
    // {{{ __construct()

    public function __construct() {
        $this->_haveBuilt = array(
           'productTags'=>false 
        );
    }

    // }}}

    // {{{ buildProductTags(Application_Model_Tag $tag):                    public void

    public function buildProductTags(Application_Model_Tag $tag) {
        $tag->setProductTags(Application_Model_Query_ProductTag::getInstance()->fetchAll(array('tagID'=>$tag->id)));
    }

    // }}}


}

?>
