<?php
abstract class Application_Model_Abstract {
    private $_fields;
    private $_data;	
	private $_builder;
	private $_lazy = false;

    public function __construct($modelName, array $fields, $lazy=true) {
        $this->_data = array();
        $this->_fields = $fields; 
        foreach($this->_fields as $field) {
            $this->_data[$field] = false;
        }
        $builderClass = 'Application_Model_Builder_' . $modelName;
        $this->setBuilder(new $builderClass()); 
        if($lazy)
            $this->allowLazyLoad();
    }

	public function ensureSafeLoad() {
        if(!$this->loadLazy()) {
            throw new RuntimeException('Attempt to lazy load when lazy loading is off, or else absent an id!');
        }
    }
	
	protected function loadLazy() {
		return $this->_lazy;
	}
	
	protected function allowLazyLoad() {
		$this->_lazy = true;
	}
	
	protected function getBuilder() {
		return $this->_builder;
	}
	
	protected function setBuilder(Application_Model_Builder_Abstract $builder) {
		$this->_builder = $builder;
		return $this;
	}

		
    public function __get($name) {
        if(in_array($name, $this->_fields)) {
            return $this->_data[$name];
        } else {
            throw new RuntimeException('Attempt to get non-existent member!');
        }
    }

    public function __set($name, $value) {
        if(in_array($name, $this->_fields)) {
            $this->_data[$name] = $value;
        } else {
            throw new RuntimeException('Attempt to set a non-existent member!');
        } 
    }		

    public function getAll() {
        return $this->_data;
    }

    public function setAll(array $data) {
        foreach($this->_fields as $field) {
            $this->_data[$field] = $data[$field]; 
        } 
    }	
	
}

?>
