<?php

class Application_Model_Persistor_CategoryImage extends Application_Model_Persistor_Abstract {
        private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_CategoryImage
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_CategoryImage(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_CategoryImage $imageCategory):                            protected void

    protected function clear(Application_Model_CategoryImage $imageCategory) {
    
    }

    // }}}

    // {{{ save(Application_Model_CategoryImage $imageCategory):                          public void
    
    public function save(Application_Model_CategoryImage $imageCategory) {
        if($imageCategory->id !== false) {
            $this->update($imageCategory);
        } else {
            $this->insert($imageCategory);
        }
   }

    // }}}

    // {{{ delete(Application_Model_CategoryImage $imageCategory):                        public void

    public function delete(Application_Model_CategoryImage $imageCategory) {
        parent::deleteRaw($imageCategory->id);
    }

    // }}}
    // {{{ insert(Application_Model_CategoryImage $imageCategory):                        protected void
    
    protected function insert(Application_Model_CategoryImage $imageCategory) {
        $data = $this->getMapper()->toDbArray($imageCategory);
        $imageCategory->id = parent::insertRaw($data);
    }

    // }}}
    // {{{ update(Application_Model_CategoryImage $imageCategory):                        protected void

    protected function update(Application_Model_CategoryImage $imageCategory) {
        $data = $this->getMapper()->toDbArray($imageCategory);
        parent::updateRaw($data, $imageCategory->id);
    }

    // }}}

}

?>
