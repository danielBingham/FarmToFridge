<?php


class Application_Model_Query_Product extends Application_Model_Query_Abstract {
    protected $_model='Product';
    protected static $_instance;

    // {{{ calculateAmountCurrentlyAvailableForProduct(Application_Model_Product $product):         public int

    public function calculateAmountCurrentlyAvailableForProduct(Application_Model_Product $product) {
        $db = Zend_Db_Table::getDefaultAdapter();

        $sql = 'SELECT SUM(order_products.amount) AS amountOrdered
                    FROM order_products
                        JOIN orders
                            ON order_products.orderID = orders.id
                    WHERE orders.filled = 0 AND orders.confirmed = 1 AND order_products.productID = ?';

        $amountOrdered = $db->fetchOne($db->quoteInto($sql, $product->id));
        return $product->amount - $amountOrdered;
    }

    // }}}


    // {{{ getInstance()

    public static function getInstance() {
        return parent::getInstanceForModel('Product');
    }

    // }}}
}

?>
