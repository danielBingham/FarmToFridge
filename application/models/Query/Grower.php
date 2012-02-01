<?php


class Application_Model_Query_Grower extends Application_Model_Query_Abstract {
    protected $_model='Grower';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstance('Grower');
    }

}

?>
