<?php


class Application_Model_Persistor_Grower extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_Grower
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_Grower(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_Grower $grower):                            protected void

    protected function clear(Application_Model_Grower $grower) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_Grower $grower):                          public void
    
    public function save(Application_Model_Grower $grower) {
        if($grower->id !== false) {
            $this->update($grower);
        } else {
            $this->insert($grower);
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_Grower $grower):                        public void

    public function delete(Application_Model_Grower $grower) {
        parent::delete($grower->id);
    }

    // }}}
    // {{{ insert(Application_Model_Grower $grower):                        protected void
    
    protected function insert(Application_Model_Grower $grower) {
        $data = $this->getMapper()->toDbArray($grower);
        $grower->id = parent::insert($data);
    }

    // }}}
    // {{{ update(Application_Model_Grower $grower):                        protected void

    protected function update(Application_Model_Grower $grower) {
        $data = $this->getMapper()->toDbArray($grower);
        parent::update($data, $grower->id);
    }

    // }}}


}

?>
