<?php

class Application_Service_Paginator_Adapter_Product_All 
    extends Application_Service_Paginator_Adapter_Product_Abstract {

	public function __construct($order='name') {
		$select = Zend_Db_Table::getDefaultAdapter()->select()->from(
			array('products'),
			array(
				'*',
			)
		);
		
		switch($order) {
            case 'name':
                $select->order('name asc');
                break;
            case 'price':
                $select->order('price desc');
                break;
			default:
				$select->order('name asc');
				break;
		}
		
		parent::__construct($select);
	}



}

?>
