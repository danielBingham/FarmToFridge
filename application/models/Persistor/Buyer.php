<?php


class Application_Model_Persistor_Buyer extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_Buyer
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_Buyer(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_Buyer $buyer):                            protected void

    protected function clear(Application_Model_Buyer $buyer) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_Buyer $buyer):                          public void
    
    public function save(Application_Model_Buyer $buyer) {
        if($buyer->id !== false) {
            $this->update($buyer);
        } else {
            $this->insert($buyer);
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_Buyer $buyer):                        public void

    public function delete(Application_Model_Buyer $buyer) {
        parent::delete($buyer->id);
    }

    // }}}
    // {{{ insert(Application_Model_Buyer $buyer):                        protected void
    
    protected function insert(Application_Model_Buyer $buyer) {
        $data = $this->getMapper()->toDbArray($buyer);
        $buyer->id = parent::insert($data);
    }

    // }}}
    // {{{ update(Application_Model_Buyer $buyer):                        protected void

    protected function update(Application_Model_Buyer $buyer) {
        $data = $this->getMapper()->toDbArray($buyer);
        parent::update($data, $buyer->id);
    }

    // }}}


}

?>
