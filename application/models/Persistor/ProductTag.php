<?php


class Application_Model_Persistor_ProductTag extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_ProductTag
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_ProductTag(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_ProductTag $productTag):                            protected void

    protected function clear(Application_Model_ProductTag $productTag) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_ProductTag $productTag):                          public void
    
    public function save(Application_Model_ProductTag $productTag) {
        if($productTag->id !== false) {
            $this->update($productTag);
        } else {
            $this->insert($productTag);
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_ProductTag $productTag):                        public void

    public function delete(Application_Model_ProductTag $productTag) {
        parent::deleteRaw($productTag->id);
    }

    // }}}
    // {{{ insert(Application_Model_ProductTag $productTag):                        protected void
    
    protected function insert(Application_Model_ProductTag $productTag) {
        $data = $this->getMapper()->toDbArray($productTag);
        $productTag->id = parent::insertRaw($data);
    }

    // }}}
    // {{{ update(Application_Model_ProductTag $productTag):                        protected void

    protected function update(Application_Model_ProductTag $productTag) {
        $data = $this->getMapper()->toDbArray($productTag);
        parent::updateRaw($data, $productTag->id);
    }

    // }}}


}

?>
