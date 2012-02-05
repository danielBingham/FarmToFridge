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

    // {{{ fromDbArray($model, $data)                                       public void
    
    public function fromDbArray($model, array $data) {
        parent::fromDbArray($model, $data);
        $model->isGrower = ($model->isGrower == 1 ? true : false); 
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
