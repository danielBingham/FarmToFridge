<?php

class Application_Model_Mapper_Tag extends Application_Model_Mapper_Abstract {

    // Standard Mapper API
    // {{{ getDbTable():                                                    public Application_Model_DbTable_Tag
	
	public function getDbTable() {
		if(empty($this->_dbTable)) {
			$this->_dbTable = new Application_Model_DbTable_Tag();
		}
		return $this->_dbTable;
	}

    // }}}


}

?>
