<?php


class Application_Model_Query_Farm extends Application_Model_Query_Abstract {
    protected $_model='Farm';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstanceForModel('Farm');
    }

}

?>
