<?PHP

class Application_Service_Paginator_Adapter_Category_Abstract 
    	extends Zend_Paginator_Adapter_DbSelect {
	
	protected function mapItem(Application_Model_Category $category, array $row) {
		$mapper = new Application_Model_Mapper_Category();
		$mapper->fromDbArray($category, $row);
	}
	
	public function getItems($offset, $itemCountPerPage) {
		$rows = parent::getItems($offset, $itemCountPerPage);
		
		$categories = array();
		foreach($rows as $row) {
			$category = new Application_Model_Category();
			$this->mapItem($category, $row);
			$categories[] = $category;
		}
		return $categories;
		
	}


}

?>
