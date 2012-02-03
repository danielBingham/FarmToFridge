<?php


class Application_Model_Persistor_Image extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_Image
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_Image(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_Image $image):                            protected void

    protected function clear(Application_Model_Image $image) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_Image $image):                          public void
    
    public function save(Application_Model_Image $image) {
        if($image->id !== false) {
            $this->update($image);
        } else {
            $this->insert($image);
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_Image $image):                        public void

    public function delete(Application_Model_Image $image) {
        parent::delete($image->id);
    }

    // }}}
    // {{{ insert(Application_Model_Image $image):                        protected void
    
    protected function insert(Application_Model_Image $image) {
        $data = $this->getMapper()->toDbArray($image);
        $image->id = parent::insert($data);
    }

    // }}}
    // {{{ update(Application_Model_Image $image):                        protected void

    protected function update(Application_Model_Image $image) {
        $data = $this->getMapper()->toDbArray($image);
        parent::update($data, $image->id);
    }

    // }}}


}

?>
