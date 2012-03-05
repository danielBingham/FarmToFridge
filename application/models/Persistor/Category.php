<?php


class Application_Model_Persistor_Category extends Application_Model_Persistor_Abstract {
    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_Category
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_Category(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_Category $category):                            protected void

    protected function clear(Application_Model_Category $category) {
        $persistor = new Application_Model_Persistor_CategoryImage(); 

        foreach($category->getCategoryImages() as $categoryImage) {
            $persistor->delete($categoryImage); 
        } 
    }

    // }}}

    // {{{ save(Application_Model_Category $category):                          public void
    
    public function save(Application_Model_Category $category) {
        if($category->id !== false) {
            $this->update($category);
        } else {
            $this->insert($category);
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_Category $category):                        public void

    public function delete(Application_Model_Category $category) {
        $this->clear($category); 

        parent::deleteRaw($category->id);
    }

    // }}}
    // {{{ insert(Application_Model_Category $category):                        protected void
    
    protected function insert(Application_Model_Category $category) {
        $data = $this->getMapper()->toDbArray($category);
        $category->id = parent::insertRaw($data);
    }

    // }}}
    // {{{ update(Application_Model_Category $category):                        protected void

    protected function update(Application_Model_Category $category) {
        $data = $this->getMapper()->toDbArray($category);
        parent::updateRaw($data, $category->id);
    }

    // }}}


}

?>
