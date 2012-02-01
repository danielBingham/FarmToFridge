<?php

class Application_Model_Query_Buyer extends Application_Model_Query_Abstract {
    protected $_model = 'Buyer';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstance('Buyer');
    }

}

?>
