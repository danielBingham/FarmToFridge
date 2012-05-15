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

        $this->view->page = $this->getRequest()->getParam('page', 1);
        $this->view->farm = Application_Model_Query_Farm::getInstance()->get($id);
    }

    // }}}
    // {{{ editAction()

    public function editAction() {
        if(!Zend_Auth::getInstance()->hasIdentity() || !Zend_Auth::getInstance()->getIdentity()->isGrower()) {
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
                // TODO Gracefully handle image upload fail, especially as
                // caused by images that are too large. 
                $imageUploader = new Application_Service_ImageUploader();
                if($imageUploader->haveUpload() && !$imageUploader->upload()) {
                    $this->errors = $imageUploader->getErrors();
                    return;
                } else {
                    $persistor = new Application_Model_Persistor_Farm();
                    $persistor->save($farm);
                    
                    Zend_Auth::getInstance()->getIdentity()->addFarm($farm);
                    if($imageUploader->haveUpload()) { 
                        return $this->_helper->redirector('crop', 'farm', null, 
                            array('image'=>$imageUploader->getImage()->id, 'farm'=>$farm->id));
                    } else {
                        return $this->_helper->redirector('view', 'farm', null, array('id'=>$farm->id));
                    }
                }
            }
        }
        $this->view->farm = $farm;
    }

    // }}}
    // {{{ cropAction()
    // Duplicate twice, let it go.  Third time, refactor and abstract.
    public function cropAction() {
        $this->view->js = array('crop');

        $imageID = $this->getRequest()->getParam('image', null);
        if($imageID === null) {
            throw new RuntimeException('We need an image to crop!');
        }

        $farmID = $this->getRequest()->getParam('farm', null);
        if($farmID === null) {
            throw new RuntimeException('We need a farm to attach that image to.');
        }

        $image = Application_Model_Query_Image::getInstance()->get($imageID);
        $farm = Application_Model_Query_Farm::getInstance()->get($farmID);

        if($this->getRequest()->isPost()) {
            $imageUploader = new Application_Service_ImageUploader();
            $imageUploader->crop($image, $this->getRequest()->getPost());
            
            $persistor = new Application_Model_Persistor_FarmImage();
            
            $main = Application_Model_Query_FarmImage::getInstance()->findOne(array('farmID'=>$farm->id, 'main'=>1));
            if(!empty($main)) {
                $main->main = 0;
                $persistor->save($main);
            }   

 
            $farmImage = new Application_Model_FarmImage();
            $farmImage->imageID = $image->id;
            $farmImage->farmID = $farm->id;
            $farmImage->main= 1;
            
            $persistor->save($farmImage);
 
            return $this->_helper->redirector('browse', 'farm');
        }

        $this->view->image = $image;
        $this->view->farm = $farm; 
 
         
   
    }

}
?>
