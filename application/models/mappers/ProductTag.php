<?php


class Application_Model_Mapper_ProductTag extends Application_Model_Mapper_Abstract {

    // Standard Mapper API
    // {{{ getDbTable():                                                    public Application_Model_DbTable_ProductTag
	
	public function getDbTable() {
		if(empty($this->_dbTable)) {
			$this->_dbTable = new Application_Model_DbTable_ProductTag();
		}
		return $this->_dbTable;
	}

    // }}}


}

?>
