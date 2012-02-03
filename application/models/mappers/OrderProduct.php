<?php

class Application_Model_Mapper_OrderProduct extends Application_Model_Mapper_Abstract {

    // {{{ getDbTable():                                                    public Application_Model_DbTable_OrderProduct
	
	public function getDbTable() {
		if(empty($this->_dbTable)) {
			$this->_dbTable = new Application_Model_DbTable_OrderProduct();
		}
		return $this->_dbTable;
	}

    // }}}


}

?>
