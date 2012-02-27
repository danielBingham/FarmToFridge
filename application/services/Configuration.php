<?php

/**
*  Service to handle configuration options so that we can simply call "get"
* and "set" on the service and not worry to much about what's happening in the
* model underneath.
*
*/
class Application_Service_Configuration {

    // {{{ get($name):                                                      public string

    public function get($name) {
        $config = Application_Model_Query_Configuration::getInstance()->findOne(array('name'=>$name));
        if($config !== null) {
            return $config->value;
        } else {
            throw new RuntimeException('Invalid configuration.');
        }
    }

    // }}}
    // {{{ set($name, $value):                                              public $this

    public function set($name, $value) {
        $config = Application_Model_Query_Configuration::getInstance()->findOne(array('name'=>$name));

        if($config === null) {
            throw new RuntimeException('Invalid configuration.');
        }

        $config->value = $value;
        
        $persistor = new Application_Model_Persistor_Configuration();
        $persistor->save($config);
        return $this;
    }

    // }}}  
    // {{{ getConfigurationList():                                          public array(Application_Model_Configuration)

    public function getConfigurationList() {
        return Application_Model_Query_Configuration::getInstance()->fetchAll();
    }
    
    // }}}
}

?>
