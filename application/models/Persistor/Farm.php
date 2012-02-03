<?php


class Application_Model_Persistor_Farm extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_Farm
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_Farm(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_Farm $farm):                            protected void

    protected function clear(Application_Model_Farm $farm) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_Farm $farm):                          public void
    
    public function save(Application_Model_Farm $farm) {
        if(!empty($farm->id)) {
            $this->update($farm);
        } else {
            $this->insert($farm);
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_Farm $farm):                        public void

    public function delete(Application_Model_Farm $farm) {
        parent::delete($farm->id);
    }

    // }}}
    // {{{ insert(Application_Model_Farm $farm):                        protected void
    
    protected function insert(Application_Model_Farm $farm) {
        $data = $this->getMapper()->toDbArray($farm);
        $farm->id = parent::insert($data);
    }

    // }}}
    // {{{ update(Application_Model_Farm $farm):                        protected void

    protected function update(Application_Model_Farm $farm) {
        $data = $this->getMapper()->toDbArray($farm);
        parent::update($data, $farm->id);
    }

    // }}}


}

?>
