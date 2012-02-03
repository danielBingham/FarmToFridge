<?php

class Application_Model_Mapper_Order extends Application_Model_Mapper_Abstract {

    // {{{ getDbTable():                                                    public Application_Model_DbTable_Order
	
	public function getDbTable() {
		if(empty($this->_dbTable)) {
			$this->_dbTable = new Application_Model_DbTable_Order();
		}
		return $this->_dbTable;
	}

    // }}}
    // {{{ fromDbArray($model, $data):                                      public void

    public function fromDbArray($model, $data) {
        $model->setAll($data);
        $model->orderedOn = new Zend_Date($data['orderedOn'], Zend_Date::ISO_8601);
        $model->confirmed = ($data['confirmed'] == 1 ? true : false);
        $model->filled = ($data['filled'] == 1 ? true : false);
    }

    // }}}
    // {{{ toDbArray($model):                                               public array

    public function toDbArray($model) {
        $data = $model->getAll();
        if(!empty($data['orderedOn']) && $data['orderedOn'] instanceof Zend_Date) {
            $data['orderedOn'] = $data['orderedOn']->toString('yyyy-MM-dd HH:mm:ss');
        }
        return $data; 
    }
    
    // }}}

}

?>
