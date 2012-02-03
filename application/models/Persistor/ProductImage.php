<?php


class Application_Model_Persistor_ProductImage extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_ProductImage
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_ProductImage(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_ProductImage $productImage):                            protected void

    protected function clear(Application_Model_ProductImage $productImage) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_ProductImage $productImage):                          public void
    
    public function save(Application_Model_ProductImage $productImage) {
        if($productImage->id !== false) {
            $this->update($productImage);
        } else {
            $this->insert($productImage);
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_ProductImage $productImage):                        public void

    public function delete(Application_Model_ProductImage $productImage) {
        parent::delete($productImage->id);
    }

    // }}}
    // {{{ insert(Application_Model_ProductImage $productImage):                        protected void
    
    protected function insert(Application_Model_ProductImage $productImage) {
        $data = $this->getMapper()->toDbArray($productImage);
        $productImage->id = parent::insert($data);
    }

    // }}}
    // {{{ update(Application_Model_ProductImage $productImage):                        protected void

    protected function update(Application_Model_ProductImage $productImage) {
        $data = $this->getMapper()->toDbArray($productImage);
        parent::update($data, $productImage->id);
    }

    // }}}


}

?>
