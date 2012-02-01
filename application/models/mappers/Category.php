<?php

class Application_Model_Mapper_Category extends Application_Model_Mapper_Abstract {

    // {{{ getDbTable():                                                    public Application_Model_DbTable_Category
	
	public function getDbTable() {
		if(empty($this->_dbTable)) {
			$this->_dbTable = new Application_Model_DbTable_Category();
		}
		return $this->_dbTable;
	}

    // }}}


}
?>
