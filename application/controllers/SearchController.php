<?php

class SearchController extends Zend_Controller_Action {
    
    public function indexAction() {
        $q = $this->getRequest()->getParam('q', null);
        $category = $this->getRequest()->getParam('cat', 'all'); 

        $searchService = new Application_Service_Search();
        $this->view->results = $searchService->performSearch($q, $category);

    }


}

?>
