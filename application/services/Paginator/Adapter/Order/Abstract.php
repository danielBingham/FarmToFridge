<?php

class Application_Service_Paginator_Adapter_Order_Abstract 
	extends Zend_Paginator_Adapter_DbSelect {
	
	protected function mapItem(Application_Model_Order $order, array $row) {
		$mapper = new Application_Model_Mapper_Order();
		$mapper->fromDbArray($order, $row);
	}
	
	public function getItems($offset, $itemCountPerPage) {
		$rows = parent::getItems($offset, $itemCountPerPage);
		
		$orders = array();
		foreach($rows as $row) {
			$order = new Application_Model_Order();
			$this->mapItem($order, $row);
			$orders[] = $order;
		}
		return $orders;
		
	}
}

?>

