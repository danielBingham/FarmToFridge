<?php

class Application_Model_Mapper_Buyer extends Application_Model_Mapper_Abstract {

    // {{{ getDbTable():                                                    public Application_Model_DbTable_Buyer
	
	public function getDbTable() {
		if(empty($this->_dbTable)) {
			$this->_dbTable = new Application_Model_DbTable_Buyer();
		}
		return $this->_dbTable;
	}

    // }}}
    // {{{ toDbArray($model):                                               public array

    /**
    * Override for the basic build data array to remove the user's
    * password from the data array.  The password is not loaded and
    * should not be saved.
    */
    public function toDbArray($model) {
        $data = $model->getAll();
        unset($data['password']);
        return $data;    
    }

    // }}}

}

?>

