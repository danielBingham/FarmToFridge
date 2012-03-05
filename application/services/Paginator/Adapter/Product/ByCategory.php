<?php

class Application_Service_Paginator_Adapter_Product_ByCategory 
    extends Application_Service_Paginator_Adapter_Product_Abstract {

	public function __construct($category, $order='name') {
		$select = Zend_Db_Table::getDefaultAdapter()->select()->from(
			array('products'),
			array(
				'*',
			)
		)->where('categoryID = ?', $category);
		
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

