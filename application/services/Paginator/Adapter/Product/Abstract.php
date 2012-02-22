<?php

class Application_Service_Paginator_Adapter_Product_Abstract 
	extends Zend_Paginator_Adapter_DbSelect {
	
	protected function mapItem(Application_Model_Product $product, array $row) {
		$mapper = new Application_Model_Mapper_Product();
		$mapper->fromDbArray($product, $row);
	}
	
	public function getItems($offset, $itemCountPerPage) {
		$rows = parent::getItems($offset, $itemCountPerPage);
		
		$products = array();
		foreach($rows as $row) {
			$product = new Application_Model_Product();
			$this->mapItem($product, $row);
			$products[] = $product;
		}
		return $products;
		
	}
}

?>
