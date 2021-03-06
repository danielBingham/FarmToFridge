<?php


class Application_Model_Persistor_Product extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_Product
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_Product(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_Product $product):                            protected void

    protected function clear(Application_Model_Product $product) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_Product $product):                          public void
    
    public function save(Application_Model_Product $product) {
        if($product->id !== false) {
            $this->update($product);
        } else {
            $this->insert($product);
        }
        
        $persistor = new Application_Model_Persistor_ProductTag();
        $old = Application_Model_Query_ProductTag::getInstance()->fetchAll(array('productID'=>$product->id));
        
        $toDelete= array_diff($old, $product->getProductTags()); 
        foreach($toDelete as $productTag) {
            $persistor->delete($productTag);
        }

        $toSave = array_diff($product->getProductTags(), $old);
        foreach($toSave as $productTag) {
            $persistor->save($productTag);
        }
    }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_Product $product):                        public void

    public function delete(Application_Model_Product $product) {
        parent::deleteRaw($product->id);
    }

    // }}}
    // {{{ insert(Application_Model_Product $product):                        protected void
    
    protected function insert(Application_Model_Product $product) {
        $data = $this->getMapper()->toDbArray($product);
        $product->id = parent::insertRaw($data);
    }

    // }}}
    // {{{ update(Application_Model_Product $product):                        protected void

    protected function update(Application_Model_Product $product) {
        $data = $this->getMapper()->toDbArray($product);
        parent::updateRaw($data, $product->id);
    }

    // }}}


}

?>
