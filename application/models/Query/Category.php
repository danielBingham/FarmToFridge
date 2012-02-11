<?php

class Application_Model_Query_Category extends Application_Model_Query_Abstract {
    protected $_model = 'Category';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstanceForModel('Category');
    }
}

?>
