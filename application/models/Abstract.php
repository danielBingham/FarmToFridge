<?php
abstract class Application_Model_Abstract {
    protected $_fields;
    protected $_data;	
	private $_builder;
	private $_lazy;

	public function ensureSafeLoad() {
        if(!$this->loadLazy() || $this->id === false) {
            throw new RuntimeException('Attempt to lazy load when lazy loading is off, or else absent an id!');
        }
    }
	
	protected function loadLazy() {
		return ($this->_lazy && $this->id !== false);
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
