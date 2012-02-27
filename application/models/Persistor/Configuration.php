<?php

class Application_Model_Persistor_Configuration extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_Configuration
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_Configuration(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_Configuration $configuration):                            protected void

    protected function clear(Application_Model_Configuration $configuration) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_Configuration $configuration):                          public void
    
    public function save(Application_Model_Configuration $configuration) {
        if($configuration->id !== false) {
            $this->update($configuration);
        } else {
            $this->insert($configuration);
        }
   }

    // }}}

    // {{{ delete(Application_Model_Configuration $configuration):                        public void

    public function delete(Application_Model_Configuration $configuration) {
        parent::deleteRaw($configuration->id);
    }

    // }}}
    // {{{ insert(Application_Model_Configuration $configuration):                        protected void
    
    protected function insert(Application_Model_Configuration $configuration) {
        $data = $this->getMapper()->toDbArray($configuration);
        $configuration->id = parent::insertRaw($data);
    }

    // }}}
    // {{{ update(Application_Model_Configuration $configuration):                        protected void

    protected function update(Application_Model_Configuration $configuration) {
        $data = $this->getMapper()->toDbArray($configuration);
        parent::updateRaw($data, $configuration->id);
    }

    // }}}



}

?>
