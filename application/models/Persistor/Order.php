<?php


class Application_Model_Persistor_Order extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_Order
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_Order(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_Order $order):                            protected void

    protected function clear(Application_Model_Order $order) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_Order $order):                          public void
    
    public function save(Application_Model_Order $order) {
        if($order->id !== false) {
            $this->update($order);
        } else {
            $this->insert($order);
        }
        
        $persistor = new Application_Model_Persistor_OrderProduct();
        foreach($order->getOrderProducts() as $orderProduct) {
            $orderProduct->orderID = $order->id;
            $persistor->save($orderProduct); 
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_Order $order):                        public void

    public function delete(Application_Model_Order $order) {
        parent::delete($order->id);
    }

    // }}}
    // {{{ insert(Application_Model_Order $order):                        protected void
    
    protected function insert(Application_Model_Order $order) {
        $data = $this->getMapper()->toDbArray($order);
        $order->id = parent::insert($data);
    }

    // }}}
    // {{{ update(Application_Model_Order $order):                        protected void

    protected function update(Application_Model_Order $order) {
        $data = $this->getMapper()->toDbArray($order);
        parent::update($data, $order->id);
    }

    // }}}


}

?>
