<?php
/********************************************************************************
 * Purpose: Handle quering of the database and mapping of database queries to
 * 	object models in the Zend Framework in a generic fashion.
 * 
 * 			Copyright (c) 2011 Daniel Bingham
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy 
 * of this software and associated documentation files (the "Software"), to deal 
 * in the Software without restriction, including without limitation the rights 
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell 
 * copies of the Software, and to permit persons to whom the Software is 
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in 
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR 
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE 
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE 
 * SOFTWARE.
 * 
 * ******************************************************************************/
abstract class Application_Model_Query_Abstract {
    protected $_model;
    protected $_mapper;
    protected $_builder;

    // Instantiation methods to instantiate the various model related
    // classes we'll need.
    // {{{ getInstance():                                                   public Application_Model_Query_{$model}

    /**
    * We need to be able to call this statically, but that means it could 
    * be potentially called from the base class and before $this->_model has
    * been set.  To get around this, we're going to make it protected and
    * then override it in the child.
    */
    protected static function getInstanceForModel($model) {
        if($model === null) {
            throw new RuntimeException('You must pass a model to query.');
        }
        $class = 'Application_Model_Query_' . $model;
        if(empty($class::$_instance)) {
            $class::$_instance = new $class();
        }
        return $class::$_instance;
    }

    // }}}
    // {{{ getMapper():                                                     public Application_Model_Mapper_{$model}

    public function getMapper() {
        $class = 'Application_Model_Mapper_' . $this->_model;
        if(empty($this->_mapper)) {
            $this->_mapper = new $class();
        }
        return $this->_mapper; 
    }

    // }}}   
    // {{{ getBuilder():                                                    public Application_Model_Builder_{$model}

    public function getBuilder() {
        $class = 'Application_Model_Builder_' . $this->_model;
        if(empty($this->_builder)) {
            $this->_builder = new $class();
        }
        return $this->_builder;
    }

    // }}}
    // {{{ getModel():                                                      public Application_Model_{$model}

    public function getModel() {
        $class = 'Application_Model_' . $this->_model;
        return new $class();
    }

    // }}}


    // Base API -- to be used as is by decendents
    // Object will be overridden by the decendent's type
    // {{{ public array fetchAll(array $conditions=NULL)
	
	/**
	 * 
	 */
	public function fetchAll(array $conditions=NULL) {
		
		if(!empty($conditions)) {
			$select = $this->getMapper()->getDbTable()->select();
			
			foreach($conditions as $field=>$value) {
				$select->where("$field=?", $value);	
			}

			$rows = $this->getMapper()->getDbTable()->fetchAll($select);
		} else {
			$rows = $this->getMapper()->getDbTable()->fetchAll();
		}
		
		if(count($rows) == 0) {
			return array();
		}
		
		$items = array();
		foreach($rows as $row) {
			$item = $this->getModel();
			$this->getMapper()->fromDbObject($item, $row);
			$items[] = $item;
		}
		return $items;		
	}

    // }}}	
    // {{{ public array fetchAllBuildAll(array $conditions=NULL)
	
    /**
	 * 
	 */
	public function fetchAllBuildAll(array $conditions=NULL) {
		if(!empty($conditions)) {
			$select = $this->getMapper()->getDbTable()->select();

			foreach($conditions as $field=>$value) {
				$select->where("$field=?", $value);	
			}

			$rows = $this->getMapper()->getDbTable()->fetchAll($select);
		} else {
			$rows = $this->getMapper()->getDbTable()->fetchAll();
		}
		
		if(count($rows) == 0) {
			return array();
		}
		
		$items = array();
		foreach($rows as $row) {
			$item = $this->getModel();
			$this->getMapper()->fromDbObject($item, $row);
			$this->getBuilder()->buildAll($item);
			$items[] = $item;
		}
		return $items;
	}
    
    // }}}
    // {{{ public Object findOne(array $conditions)
	
	/**
	 * Find a single model that matches the given
 	 * conditions.  If more than one model is matched or no models are
 	 * matched, return an empty array.  Do not load associations.
 	 * 
 	 *  @return A populated model with out associations or NULL.
	 */
	public function findOne(array $conditions) {
		$select = $this->getMapper()->getDbTable()->select();

		foreach($conditions as $field=>$value) {
			$select->where("$field=?", $value);	
		}

		$result = $this->getMapper()->getDbTable()->fetchAll($select);
		
		if(count($result) != 1) {
			return NULL;
		}
		
		$item = $this->getModel();
		$this->getMapper()->fromDbObject($item, $result->current());
		return $item;
	}

    // }}}
    // {{{ public Object findOneBuildAll(array $conditions)
	
	/**
	 * Find a single model that matches the given
	 * conditions.  If more than one model is matched or no models
	 * are matched, return an empty array.
	 * 
	 * @return A populated model with associations or empty array.
	 */
	public function findOneBuildAll(array $conditions) {
		$select = $this->getMapper()->getDbTable()->select();

		foreach($conditions as $field=>$value) {
			$select->where("$field=?", $value);	
		}

		$result = $this->getMapper()->getDbTable()->fetchAll($select);
		
		if(count($result) != 1) {
			return NULL;
		}
		
		$item = $this->getModel();
		$this->getMapper()->fromDbObject($item, $result->current());
		$this->getBuilder()->buildAll($item);
		return $item;
	}

    // }}}
    // {{{ public Object get($itemID)
	
	/**
	 * Get a the item model for a given id from the database.
	 * Populate the model, but do not retrieve associations.  Return
	 * NULL if no model is found.
	 * 
	 * @return Populated model with out associations or NULL.
	 */
	public function get($itemID) {
		$result = $this->getMapper()->getDbTable()->find($itemID);
		if(count($result) == 0) {
			return NULL;
		}
		
		$item = $this->getModel();
		$this->getMapper()->fromDbObject($item, $result->current());
		return $item;
		
	}

    // }}}
    // {{{ public Object getBuildAll($itemID)
	
	/**
	 * Get the model for a given id from the database.
	 * Populate the model and all it's associations.  If no model
	 * is found, return NULL.
	 * 
	 * @return Populated model with associations or NULL.
	 */
	public function getBuildAll($itemID) {
		$item = $this->get($itemID);
		if($item === NULL) {
			return NULL;
		}
		$this->getBuilder()->buildAll($item);
		return $item;
	}

    // }}}
    // {{{ public boolean exists($itemID)
	
	/**
	 * Determine whether a model exists for a given
	 * id.  Return true if one exists, false otherwise.
	 * 
	 * @return True if a item corresponding to itemID is found, false otherwise.
	 */
	public function exists($itemID) {
		$result = $this->getMapper()->getDbTable()->find($itemID);
		if(count($result) == 0) {
			return false;
		} else {
			return true;
		}
	}

    // }}}
	
	
}

?>
