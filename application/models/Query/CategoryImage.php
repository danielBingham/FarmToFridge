<?php

class Application_Model_Query_CategoryImage extends Application_Model_Query_Abstract {
    protected $_model = 'CategoryImage';
    protected static $_instance;

    public static function getInstance() {
         return parent::getInstanceForModel('CategoryImage');
    }

}

?>
