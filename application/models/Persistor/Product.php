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
        if(!empty($product->id)) {
            $this->update($product);
        } else {
            $this->insert($product);
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_Product $product):                        public void

    public function delete(Application_Model_Product $product) {
        parent::delete($product->id);
    }

    // }}}
    // {{{ insert(Application_Model_Product $product):                        protected void
    
    protected function insert(Application_Model_Product $product) {
        $data = $this->getMapper()->toDbArray($product);
        $product->id = parent::insert($data);
    }

    // }}}
    // {{{ update(Application_Model_Product $product):                        protected void

    protected function update(Application_Model_Product $product) {
        $data = $this->getMapper()->toDbArray($product);
        parent::update($data, $product->id);
    }

    // }}}


}

?>
