<?php

class Application_Service_Paginator_Adapter_Order_All 
    extends Application_Service_Paginator_Adapter_Order_Abstract {

	public function __construct($order='state') {
		$select = Zend_Db_Table::getDefaultAdapter()->select()->from(
			array('orders'),
			array(
				'*',
			)
		);
		
		switch($order) {
			default:
				$select->order('state asc');
				break;
		}
		
		parent::__construct($select);
	}



}

?>

