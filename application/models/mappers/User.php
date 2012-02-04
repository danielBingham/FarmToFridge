<?php

class Application_Model_Mapper_User extends Application_Model_Mapper_Abstract {

    // {{{ getDbTable():                                                    public Application_Model_DbTable_User
	
	public function getDbTable() {
		if(empty($this->_dbTable)) {
			$this->_dbTable = new Application_Model_DbTable_User();
		}
		return $this->_dbTable;
	}

    // }}}
    // {{{ toDbArray($model):                                               public array

    public function toDbArray($model) {
        $data = $model->getAll();
        unset($data['password']);
        return $data;
    }

    // }}}


}

?>
