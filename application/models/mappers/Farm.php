<?php

class Application_Model_Mapper_Farm extends Application_Model_Mapper_Abstract {

    // Standard Mapper API
    // {{{ getDbTable():                                                    public Application_Model_DbTable_Farm
	
	public function getDbTable() {
		if(empty($this->_dbTable)) {
			$this->_dbTable = new Application_Model_DbTable_Farm();
		}
		return $this->_dbTable;
	}

    // }}}



}


?>
