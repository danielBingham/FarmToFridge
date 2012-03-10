<?php

class AdminController extends Zend_Controller_Action {

    // {{{  indexAction()

    public function indexAction() {
        if(!Zend_Auth::getInstance()->hasIdentity()) {
            return $this->_helper->redirector('login', 'user');
        }

        if(Zend_Auth::getInstance()->getIdentity()->isAdmin == false) {
            throw new RuntimeException('Only admin may view this page.');
        }
   
         
        $config = new Application_Service_Configuration();
      
        if($this->getRequest()->isPost()) {
            foreach($this->getRequest()->getPost() as $name=>$value) {
                $config->set($name, $value);
            }
        } 
         
        $this->view->configurations =  $config->getConfigurationList();
    }

    // }}}
    // {{{ dashboardAction() 
    
    public function dashboardAction() {

    }

    // }}}

    // {{{ categoriesAction() 

    /**
    * Admin action to view and edit the categories
    * provided to farmers when entering products.
    */
    public function categoriesAction() {
        $this->view->categories = Application_Model_Query_Category::getInstance()->fetchAll();
        
    }

    // }}}

    // {{{ editCategoryAction()

    public function editCategoryAction() {
        $id = $this->getRequest()->getParam('id', null);
        if($id === null) {
            $category = new Application_Model_Category();
        } else {
            $category = Application_Model_Query_Category::getInstance()->get($id);
            if($category === null) {
                throw new RuntimeException('That is not a valid category to edit!');
            }
        }       

 
        if($this->getRequest()->isPost()) {
            $translator = new Application_Service_Translator_Category();
            if(!$translator->translate($category, $this->getRequest()->getPost())) {
                $this->view->errors = $translator->getErrors(); 
                return;
            }
        
            // TODO Gracefully handle image upload fail, especially as
            // caused by images that are too large. 
            $imageUploader = new Application_Service_ImageUploader();
            if($imageUploader->haveUpload() && !$imageUploader->upload()) {
                $this->errors = $imageUploader->getErrors();
                return;
            } else {
                $persistor = new Application_Model_Persistor_Category();
                $persistor->save($category);
               
                if($imageUploader->haveUpload()) { 
                    return $this->_helper->redirector('crop-category', 'admin', null, 
                        array('image'=>$imageUploader->getImage()->id, 'category'=>$category->id));
                } else {
                    return $this->_helper->redirector('categories');
                }
            }
        } 
        

        $this->view->category = $category;

    }

    // }}}
    // {{{ cropCategoryAction()
    
    public function cropCategoryAction() {
        $this->view->js = array('crop');

        $imageID = $this->getRequest()->getParam('image', null);
        if($imageID === null) {
            throw new RuntimeException('We need an image to crop!');
        }

        $categoryID = $this->getRequest()->getParam('category', null);
        if($categoryID === null) {
            throw new RuntimeException('We need a category to attach that image to.');
        }

        $image = Application_Model_Query_Image::getInstance()->get($imageID);
        $category = Application_Model_Query_Category::getInstance()->get($categoryID);

        if($this->getRequest()->isPost()) {
            $imageUploader = new Application_Service_ImageUploader();
            $imageUploader->crop($image, $this->getRequest()->getPost());
            
            $persistor = new Application_Model_Persistor_CategoryImage();
            
            $main = Application_Model_Query_CategoryImage::getInstance()->findOne(array('categoryID'=>$category->id, 'main'=>1));
            if(!empty($main)) {
                $main->main = 0;
                $persistor->save($main);
            }   
 
            $categoryImage = new Application_Model_CategoryImage();
            $categoryImage->imageID = $image->id;
            $categoryImage->categoryID = $category->id;
            $categoryImage->main= 1;
            
            $persistor->save($categoryImage);
 
            return $this->_helper->redirector('categories', 'admin');
        }

        $this->view->image = $image;
        $this->view->category = $category; 
    }

    // }}}
    // {{{ deleteCategoryAction()

    public function deleteCategoryAction() {
        $id = $this->getRequest()->getParam('id', null);
        if(empty($id)) {
            throw new RuntimeException('You must provide the id of the category you wish to delete.');
        }
        
        $category = Application_Model_Query_Category::getInstance()->get($id);
        if($category === null) {
            throw new RuntimeException('You must provide the id of a valid category to delete.');
        } 

        if($this->getRequest()->isPost()) { 
            // FIXME This is going to be a ton of DB hits, but we
            // could easily do this with a single DB hit and a single
            // 'update' statement.
            // TODO Wrap this in a service that calls SQL to update
            // this more directly.  Where should the SQL be?  Persistor?
            // Mapper?
            $post = $this->getRequest()->getPost();
            $persistor = new Application_Model_Persistor_Product(); 
            foreach($category->getProducts() as $product) {
                $product->categoryID = $post['category']; 
                $persistor->save($product);
            }
            unset($persistor);

            $persistor = new Application_Model_Persistor_Category();
            $persistor->delete($category);

            $this->_helper->redirector('categories');
        }
        
        $this->view->category = $category;
        $this->view->categories = Application_Model_Query_Category::getInstance()->fetchAll();
     }

    // }}}
}

?>
