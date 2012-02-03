<?php

class FarmController extends Zend_Controller_Action {

    public function browseAction() {
        $this->view->farms = Application_Model_Query_Farm::getInstance()->fetchAll();
    }

    public function viewAction() {
        $id = $this->getRequest()->getParam('id', null);
        if($id === null) {
            throw new RuntimeException('Attempt to view a farm with out an id.');
        }

        $this->view->farm = Application_Model_Query_Farm::getInstance()->get($id);
    }

}

?>
