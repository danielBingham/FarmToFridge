<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        $this->view->products = Application_Model_Query_Product::getInstance()->fetchAll();
    }


}

