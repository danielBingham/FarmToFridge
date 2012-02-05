<?php
class FarmController extends Zend_Controller_Action {

    // {{{ browseAction()

    public function browseAction() {
        $this->view->farms = Application_Model_Query_Farm::getInstance()->fetchAll();
    }

    // }}}
    // {{{ viewAction()

    public function viewAction() {
        $id = $this->getRequest()->getParam('id', null);
        if($id === null) {
            throw new RuntimeException('Attempt to view a farm with out an id.');
        }

        $this->view->farm = Application_Model_Query_Farm::getInstance()->get($id);
    }

    // }}}
    // {{{ editAction()

    public function editAction() {
        if(!Zend_Auth::getInstance()->hasIdentity() || Zend_Auth::getInstance()->getIdentity()->isGrower == false) {
            throw new RuntimeException('You must be logged in as a Grower in order to add a farm.');
        }

        $id = $this->getRequest()->getParam('id', null);
        if($id !== null) {
            $farm = Application_Model_Query_Farm::getInstance()->get($id);
        } else {
            $farm = new Application_Model_Farm();
        }

        if($this->getRequest()->isPost()) {
            $translator = new Application_Service_Translator_Farm();
            if(!$translator->translate($farm, $this->getRequest()->getPost())) {
                $this->view->errors = $translator->getErrors();
            } else {
                $persistor = new Application_Model_Persistor_Farm();
                $persistor->save($farm);
                
                Zend_Auth::getInstance()->getIdentity()->addFarm($farm);
                return $this->_helper->redirector('view', 'farm', null, array('id'=>$farm->id));
            }
        }
        $this->view->farm = $farm;
    }

    // }}}

}
?>
