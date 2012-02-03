<?php


class ProductController extends Zend_Controller_Action {

    public function browseAction() {
        $this->view->products = Application_Model_Query_Product::getInstance()->fetchAll();
    }

    public function viewAction() {
        $id = $this->getRequest()->getParam('id');

        $this->view->product = Application_Model_Query_Product::getInstance()->get($id);

    }

}


?>
