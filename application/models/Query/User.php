<?php

class Application_Model_Query_User extends Application_Model_Query_Abstract {
    protected $_model='User';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstanceForModel('User');
    }


}

?>
