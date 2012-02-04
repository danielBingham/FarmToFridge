<?php

class Application_Model_Persistor_User extends Application_Model_Persistor_Abstract {

    private $_mapper;

    // {{{ getMapper():                                                     protected Application_Model_Mapper_User
    
    protected function getMapper() {
        if(empty($this->_mapper)) {
            $this->_mapper = new Application_Model_Mapper_User(); 
        }
        return $this->_mapper;
    }

    // }}} 
    // {{{ clear(Application_Model_User $user):                            protected void

    protected function clear(Application_Model_User $user) {
       // TODO: write me? 
    }

    // }}}

    // {{{ save(Application_Model_User $user):                          public void
    
    public function save(Application_Model_User $user) {
        if($user->id !== false) {
            $this->update($user);
        } else {
            $this->insert($user);
        }
   }

    // }}}

    // TODO: Delete needs to be rewritten to delete associations.
    // {{{ delete(Application_Model_User $user):                        public void

    public function delete(Application_Model_User $user) {
        parent::delete($user->id);
    }

    // }}}
    // {{{ insert(Application_Model_User $user):                        protected void
    
    protected function insert(Application_Model_User $user) {
        $data = $this->getMapper()->toDbArray($user);
        $user->id = parent::insert($data);
    }

    // }}}
    // {{{ update(Application_Model_User $user):                        protected void

    protected function update(Application_Model_User $user) {
        $data = $this->getMapper()->toDbArray($user);
        parent::update($data, $user->id);
    }

    // }}}


}

?>
