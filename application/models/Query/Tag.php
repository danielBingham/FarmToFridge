<?php

class Application_Model_Query_Tag extends Application_Model_Query_Abstract {

    protected $_model='Tag';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstanceForModel('Tag');
    }


}

?>
