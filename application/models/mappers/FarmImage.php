<?php

class Application_Model_Mapper_FarmImage extends Application_Model_Mapper_Abstract {

    // Standard Mapper API
    // {{{ getDbTable():                                                    public Application_Model_DbTable_FarmImage
	
	public function getDbTable() {
		if(empty($this->_dbTable)) {
			$this->_dbTable = new Application_Model_DbTable_FarmImage();
		}
		return $this->_dbTable;
	}

    // }}}


}

?>
