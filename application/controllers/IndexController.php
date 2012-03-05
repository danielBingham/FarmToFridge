<?php

class IndexController extends Zend_Controller_Action
{

    // {{{ indexAction()

    public function indexAction()  {
        $this->view->categories = Application_Model_Query_Category::getInstance()->fetchAll(); 

    }

    // }}}

}

