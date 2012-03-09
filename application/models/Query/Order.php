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

    // {{{ getOrdersForGrowerInState(Application_Model_User $grower, $state=null):            array(Application_Model_Order)

    /**
    * Get an array of orders that contain a product of the grower.  An optional state
    * may be passed (as either a single state or an array) to limit the orders to 
    * only those in a certain state.
    *
    * @param Application_Model_Grower $grower The grower who's orders we want to find.
    * @param string|array $state The state, or states, of the orders you wish returned.
    * @return array(Application_Model_Order) The orders that contain $grower's products.
    */
    public function getOrdersForGrower(Application_Model_User $grower, $state=null) {
        $db = Zend_Db_Table::getDefaultAdapter();
        
        $sql = 'SELECT DISTINCT orders.*
                    FROM orders
                        JOIN (order_products, products, farms)
                            ON (orders.id = order_products.orderID 
                                AND order_products.productID = products.id
                                AND products.farmID = farms.id) '
                    . $db->quoteInto('WHERE farms.userID = ?', $grower->id);
        if(!is_array($state)) { 
            $sql .= ' AND ' . $db->quoteInto('orders.state = ?', $state);
        } else {
            $stateConditions = '(';
            foreach($state as $s) {
                 $stateConditions .= ($stateConditions == '(' ? '' : ' OR ') . $db->quoteInto('orders.state=?', $s);
            }  
            $stateConditions .= ')';
            $sql .= ' AND ' . $stateConditions;
        }

        $results = $db->fetchAll($sql);
        
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
