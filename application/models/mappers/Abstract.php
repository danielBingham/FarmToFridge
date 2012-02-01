<?php

abstract class Application_Model_Mapper_Abstract {


    // {{{ getDbTable():                                                    public Application_Model_DbTable
	
	public abstract function getDbTable(); 

    // }}}
    // {{{ fromDbObject($model, $data):                                    public void
	
	public function fromDbObject($model, $data) {
		$this->fromDbArray($model, $data->toArray());
	}

    // }}}
    // {{{ fromDbArray($model, array $data):          public void
	
	public function fromDbArray($model, array $data) {
        $data = array_map('stripslashes', $data);
        $model->setAll($data);
    }

    // }}}
    // {{{ public array toDbArray($model)
	
	public function toDbArray($model) {
	    $data = $model->getAll();	
        return $data;
	}
    
    // }}}



}

?>
