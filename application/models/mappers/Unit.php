<?php

class Application_Model_Mapper_Unit extends Application_Model_Mapper_Abstract {
    // Standard Mapper API
    // {{{ getDbTable():                                                    public Application_Model_DbTable_Unit
	
	public function getDbTable() {
		if(empty($this->_dbTable)) {
			$this->_dbTable = new Application_Model_DbTable_Unit();
		}
		return $this->_dbTable;
	}

    // }}}


}

?>
