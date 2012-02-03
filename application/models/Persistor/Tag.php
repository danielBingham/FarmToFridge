<?php


class Application_Model_Persistor_Tag extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_Tag
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_Tag(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_Tag $tag):                            protected void

    protected function clear(Application_Model_Tag $tag) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_Tag $tag):                          public void
    
    public function save(Application_Model_Tag $tag) {
        if(!empty($tag->id)) {
            $this->update($tag);
        } else {
            $this->insert($tag);
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_Tag $tag):                        public void

    public function delete(Application_Model_Tag $tag) {
        parent::delete($tag->id);
    }

    // }}}
    // {{{ insert(Application_Model_Tag $tag):                        protected void
    
    protected function insert(Application_Model_Tag $tag) {
        $data = $this->getMapper()->toDbArray($tag);
        $tag->id = parent::insert($data);
    }

    // }}}
    // {{{ update(Application_Model_Tag $tag):                        protected void

    protected function update(Application_Model_Tag $tag) {
        $data = $this->getMapper()->toDbArray($tag);
        parent::update($data, $tag->id);
    }

    // }}}


}

?>
