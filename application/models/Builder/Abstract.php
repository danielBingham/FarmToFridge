<?php
class Application_Model_Builder_Abstract {
    // An array that provides protection against
    // loading on the same object multiple times.	
	protected $_haveBuilt;
	
	public function build($association, $model) {
		if(array_key_exists($association, $this->_haveBuilt) && $this->_haveBuilt[$association] === true) {
	        return;	
        }

        // This will throw an exception if we shouldn't be 
        // trying to build on this model.		
		$model->ensureSafeLoad();

		$this->_haveBuilt[$association] = true;
		
		$method = 'build' . ucfirst($association);
        $this->$method($model);
	}
}
?>
