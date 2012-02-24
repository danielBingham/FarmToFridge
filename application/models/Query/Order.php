<?php

/**
* This is the query class for Application_Model_Order.  It should be used
* to retrieve Orders from the database.  It inherts numerous retrieval functions
* from Application_Model_Query_Abstract.  Any other retrieval functions should
* be placed here.  
* 
* Any retrieval methods placed in Application_Model_Query_Order should return either
* a single Application_Model_Order, an array of Application_Model_Orders or
* a count of rows in the orders table.  
*/
class Application_Model_Query_Order extends Application_Model_Query_Abstract {
    protected $_model='Order';
    protected static $_instance;

    // {{{ getPendingOrdersForGrower(Application_Model_User $grower):            array(Application_Model_Order)

    /**
    * Get orders that contain products that are offered by the grower
    * passed as a parameter.  Returns a list of orders.
    *
    * @param Application_Model_Grower $grower The grower who's orders we want to find.
    * @return array(Application_Model_Order) The orders that contain $grower's products.
    */
    public function getPendingOrdersForGrower(Application_Model_User $grower) {
        $db = Zend_Db_Table::getDefaultAdapter();
        
        $sql = 'SELECT DISTINCT orders.*
                    FROM orders
                        JOIN (order_products, products, farms)
                            ON (orders.id = order_products.orderID 
                                AND order_products.productID = products.id
                                AND products.farmID = farms.id)
                    WHERE farms.userID = ? AND orders.confirmed=1 AND orders.filled=0';
        $results = $db->fetchAll($db->quoteInto($sql, $grower->id));
        
        $orders = array();
        foreach($results as $orderRow) {
            $order = new Application_Model_Order();
            $this->getMapper()->fromDbArray($order, $orderRow);
            $orders[] = $order;
        } 
        return $orders;           
    }

    // }}}

    // {{{ getInstance()

    public static function getInstance() {
        return parent::getInstanceForModel('Order');
    }

    // }}}

}

?>
