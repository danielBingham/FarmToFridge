<?php
/**
*
*/
abstract class Application_Model_Persistor_Abstract {

    protected abstract function getMapper();

    // {{{ insertRaw(array $data):                                                   protected int

    protected function insertRaw(array $data) {
        return $this->getMapper()->getDbTable()->insert($data);
    }

    // }}}
    // {{{ updateRaw(array $data, $id):                                        protected void

    protected function updateRaw(array $data, $id) {
        $this->getMapper()->getDbTable()->update($data, $this->getMapper()->getDbTable()->getAdapter()->quoteInto('id=?', $id));
    }
    
    // }}}
    // {{{ deleteRaw($id):                                                     protected void

    protected function deleteRaw($id) {
        $this->getMapper()->getDbTable()->delete($this->getMapper()->getDbTable()->getAdapter()->quoteInto('id=?', $id));
    }

    // }}}
}

?>
