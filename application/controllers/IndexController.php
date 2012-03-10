<?php

class IndexController extends Zend_Controller_Action
{

    // {{{ indexAction()

    public function indexAction()  {
        $this->view->categories = new Zend_Paginator(new Application_Service_Paginator_Adapter_Category_All());
        $this->view->categories->setCurrentPageNumber($this->getRequest()->getParam('page', 1));
        $this->view->categories->setItemCountPerPage(8); 
    }

    // }}}

}

