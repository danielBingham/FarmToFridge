<?php


class Application_Model_Persistor_OrderProduct extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_OrderProduct
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_OrderProduct(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_OrderProduct $orderProduct):                            protected void

    protected function clear(Application_Model_OrderProduct $orderProduct) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_OrderProduct $orderProduct):                          public void
    
    public function save(Application_Model_OrderProduct $orderProduct) {
        if($orderProduct->id !== false) {
            $this->update($orderProduct);
        } else {
            $this->insert($orderProduct);
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_OrderProduct $orderProduct):                        public void

    public function delete(Application_Model_OrderProduct $orderProduct) {
        parent::delete($orderProduct->id);
    }

    // }}}
    // {{{ insert(Application_Model_OrderProduct $orderProduct):                        protected void
    
    protected function insert(Application_Model_OrderProduct $orderProduct) {
        $data = $this->getMapper()->toDbArray($orderProduct);
        $orderProduct->id = parent::insert($data);
    }

    // }}}
    // {{{ update(Application_Model_OrderProduct $orderProduct):                        protected void

    protected function update(Application_Model_OrderProduct $orderProduct) {
        $data = $this->getMapper()->toDbArray($orderProduct);
        parent::update($data, $orderProduct->id);
    }

    // }}}


}

?>
