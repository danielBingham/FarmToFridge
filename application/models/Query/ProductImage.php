<?php

class Application_Model_Query_ProductImage extends Application_Model_Query_Abstract {
    protected $_model='ProductImage';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstance('ProductImage');
    }


}
?>
