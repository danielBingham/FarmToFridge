<?php 

class Application_Model_Query_Image extends Application_Model_Query_Abstract {

    protected $_model='Image';
    protected static $_instance;

    public static function getInstance() {
        return parent::getInstance('Image');
    }


}

?>
