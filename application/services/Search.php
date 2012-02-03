<?php

class Application_Service_Search {

    private function clearCollision(array $products) {

    }

    public function performSearch($q, $category='all') {
        $db = Zend_Db_Table::getDefaultAdapter();
        
        if($category !== 'all' && !empty($q)) {
            $strSql = 'SELECT * FROM products WHERE '
                    . $db->quoteInto('(MATCH(name) AGAINST (? IN BOOLEAN MODE)', $q)
                    . $db->quoteInto(' OR MATCH(name) AGAINST (? IN BOOLEAN MODE))', '*'.$q.'*')
                    . $db->quoteInto(' AND categoryID=?', $category);
             
            $sql = $db->quoteInto($strSql, array($q, '*'.$q.'*', $category));
            $results = $db->fetchAll($sql); 
        } else if(!empty($q)) {
            $sql = 'SELECT * FROM products WHERE '
                    . $db->quoteInto('MATCH(name) AGAINST (? IN BOOLEAN MODE)', $q)
                    . $db->quoteInto(' OR MATCH(name) AGAINST (? IN BOOLEAN MODE)', '*'.$q.'*');
            $results = $db->fetchAll($sql); 
        } else if($category != 'all') {
            $strSql = 'SELECT * FROM products WHERE categoryID=?';
        
            $sql = $db->quoteInto($strSql, array($category));
            $results = $db->fetchAll($sql);
        } else {
            return Application_Model_Query_Product::getInstance()->fetchAll();
        }


        $mapper = new Application_Model_Mapper_Product();
        
        $products = array();
        foreach($results as $row) {
            $product = new Application_Model_Product();
            $mapper->fromDbArray($product, $row);
            $products[] = $product; 
        }

        return $products;
    }

}

?>
