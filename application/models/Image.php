<?php

class Application_Model_Image extends Application_Model_Abstract {

    // {{{ __construct()

    public function __construct($lazy=true) {
        $this->_fields = array('id', 'width', 'height', 'growerID');
        $this->id = false;
        if($lazy) {
			$this->setBuilder(new Application_Model_Builder_Image())
				->allowLazyLoad();
		}
    }

    // }}}


}
?>
