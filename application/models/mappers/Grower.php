<?php

class Application_Model_Mapper_Grower extends Application_Model_Mapper_Abstract {

    // {{{ getDbTable():                                                    public Application_Model_DbTable_Grower
	
	public function getDbTable() {
		if(empty($this->_dbTable)) {
			$this->_dbTable = new Application_Model_DbTable_Grower();
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
