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

    // {{{ setPassword($model):                                             public void
        
    public function setPassword(Application_Model_User $model) {
        $db = Zend_Db_Table::getDefaultAdapter();
    
        $sql = $db->quoteInto('UPDATE users SET password=MD5(?)', $model->password) . $db->quoteInto(' WHERE id=?', $model->id);
        $db->query($sql);
    }

    // }}}

    // {{{ fromDbArray($model, $data)                                       public void
    
    public function fromDbArray($model, array $data) {
        parent::fromDbArray($model, $data);
        $model->isGrower = ($model->isGrower == 1 ? true : false); 
        if($model->password !== false) {
            $model->password = false;
        }
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
