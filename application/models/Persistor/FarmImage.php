<?php


class Application_Model_Persistor_FarmImage extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_FarmImage
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_FarmImage(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_FarmImage $farmImage):                            protected void

    protected function clear(Application_Model_FarmImage $farmImage) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_FarmImage $farmImage):                          public void
    
    public function save(Application_Model_FarmImage $farmImage) {
        if($farmImage->id !== false) {
            $this->update($farmImage);
        } else {
            $this->insert($farmImage);
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_FarmImage $farmImage):                        public void

    public function delete(Application_Model_FarmImage $farmImage) {
        parent::deleteRaw($farmImage->id);
    }

    // }}}
    // {{{ insert(Application_Model_FarmImage $farmImage):                        protected void
    
    protected function insert(Application_Model_FarmImage $farmImage) {
        $data = $this->getMapper()->toDbArray($farmImage);
        $farmImage->id = parent::insertRaw($data);
    }

    // }}}
    // {{{ update(Application_Model_FarmImage $farmImage):                        protected void

    protected function update(Application_Model_FarmImage $farmImage) {
        $data = $this->getMapper()->toDbArray($farmImage);
        parent::updateRaw($data, $farmImage->id);
    }

    // }}}


}

?>
