<?php

class Application_Model_Mapper_Product extends Application_Model_Mapper_Abstract {

    // {{{ getDbTable():                                                    public Application_Model_DbTable_Product
	
	public function getDbTable() {
		if(empty($this->_dbTable)) {
			$this->_dbTable = new Application_Model_DbTable_Product();
		}
		return $this->_dbTable;
	}

    // }}}

}

?>
