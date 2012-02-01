<?php
/**
*
*/
abstract class Application_Model_Persistor_Abstract {

    protected abstract function getMapper();

    // {{{ insert(array $data):                                                   protected int

    protected function insert(array $data) {
        return $this->getMapper()->getDbTable()->insert($data);
    }

    // }}}
    // {{{ update(array $data, $id):                                        protected void

    protected function update(array $data, $id) {
        $this->getMapper()->getDbTable()->update($data, $this->getMapper()->getDbTable()->getAdapter()->quoteInto('id=?', $id));
    }
    
    // }}}
    // {{{ delete($id):                                                     protected void

    protected function delete($id) {
        $this->getMapper()->getDbTable()->delete($this->getMapper()->getDbTable()->getAdapter()->quoteInto('id=?', $id));
    }

    // }}}
}

?>
