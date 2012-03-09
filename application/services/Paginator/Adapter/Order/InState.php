<?php

class Application_Service_Paginator_Adapter_Order_InState
    extends Application_Service_Paginator_Adapter_Order_Abstract {

	public function __construct($state, $order='size') {
        // TODO This select statement is mother fucking ugly.  3 joins
        // just to make sure we get the order size right for the current
        // grower (as opposed to the total order size).  I'm not really
        // sure how we could optimize this, but it probably could use
        // some serious optimization.  
		$select = Zend_Db_Table::getDefaultAdapter()->select()->from(
			array('orders'),
			array(
				'*'
			)
		)
        ->join(array('order_products'), 'orders.id = order_products.orderID',
                array(
                    new Zend_Db_Expr('sum(order_products.amount) as size')
                )
        )
        ->join(array('products'), 'order_products.productID = products.id', array())
        ->join(array('farms'), 'products.farmID = farms.id', array())
        ->group('orders.id')
        ->where('orders.state=?', $state)
        ->where('farms.userID=?', Zend_Auth::getInstance()->getIdentity()->id);	
	
		switch($order) {
            case 'size':
                $select->order('size desc');
                break;
			default:
				$select->order('size asc');
				break;
		}

		
		parent::__construct($select);
	}



}

?>


