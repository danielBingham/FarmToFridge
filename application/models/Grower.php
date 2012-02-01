<?php

class Application_Model_Grower extends Application_Model_Abstract {

    // Associations
    private $_farms;

    // {{{ __construct($lazy=true)

    public function __construct($lazy=true) {
	    $this->_fields = array('id', 'email', 'password');	
        $this->id = false;
        if($lazy) {
			$this->setBuilder(new Application_Model_Builder_Grower())
				->allowLazyLoad();
		}
    }

    // }}}

    // Association Methods
    // {{{ getFarms():                                                      public array(Application_Model_Farm)
    
    public function getFarms() {
        if(empty($this->_farms) && $this->loadLazy()) {
            $this->getBuilder()->build('farms', $this);
        }
        return $this->_farms;
    }

    // }}}
    // {{{ setFarms(array $farms):                                          public void

    public function setFarms(array $farms) {
        $this->_farms = $farms;
        return $this;
    }

    // }}}
}


?>
