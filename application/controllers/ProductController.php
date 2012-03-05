<?php


class ProductController extends Zend_Controller_Action {

    // {{{ browseAction()

    public function browseAction() {
        $category = $this->getRequest()->getParam('category', null);
        $page = $this->getRequest()->getParam('page', 1);
        $order = $this->getRequest()->getParam('order', 'name');
       
        if($category === null) { 
            $paginator = new Zend_Paginator(new Application_Service_Paginator_Adapter_Product_All($order));
        } else {
            $paginator = new Zend_Paginator(new Application_Service_Paginator_Adapter_Product_ByCategory($category, $order));
        }
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(8); 

        $this->view->paginator = $paginator;
    }

    // }}}
    // {{{ viewAction()

    public function viewAction() {
        $id = $this->getRequest()->getParam('id');

        $this->view->product = Application_Model_Query_Product::getInstance()->get($id);

    }

    // }}}
    // {{{ editAction()

    public function editAction() {
        if(!Zend_Auth::getInstance()->hasIdentity() || false == Zend_Auth::getInstance()->getIdentity()->isGrower) {
            throw new RuntimeException('Only logged in growers may edit products.');
        }

        // First determine if we're editing a product or creating
        // a new one.
        $id = $this->getRequest()->getParam('id', null);
        if($id !== null) {
            // We're editing a product.  The product will have everthing
            // we need. 
            $product = Application_Model_Query_Product::getInstance()->get($id); 

            if($product->getFarm()->userID != Zend_Auth::getInstance()->getIdentity()->id) {
                throw new RuntimeException('You may only edit products for farms that you own!');
            }
        } else {
            // New product, we need to assign it to a farm. 
            $product = new Application_Model_Product(false);
            $farmID = $this->getRequest()->getParam('farmID', null);
            if($farmID === null) {
                throw new RuntimeException('No farm given, no farm to add this product to.');
            }
            
            $farm = Application_Model_Query_Farm::getInstance()->get($farmID);
            if($farm->userID != Zend_Auth::getInstance()->getIdentity()->id) {
                throw new RuntimeException('You may only add products to farms you own!');
            }

            $product->farmID = $farmID;    
        }

        
        // Now process the input from the form.
        if($this->getRequest()->isPost()) {
            $translator = new Application_Service_Translator_Product();
            if(!$translator->translate($product, $this->getRequest()->getPost())) {
                $this->view->errors = $translator->getErrors();
            } else {
                // TODO Gracefully handle image upload fail, especially as
                // caused by images that are too large. 
                $imageUploader = new Application_Service_ImageUploader();
                if($imageUploader->haveUpload() && !$imageUploader->upload()) {
                    $this->errors = $imageUploader->getErrors();
                    return;
                } else {
                    $persistor = new Application_Model_Persistor_Product();
                    $persistor->save($product);
                   
                    if($imageUploader->haveUpload()) { 
                        return $this->_helper->redirector('crop', 'product', null, 
                            array('image'=>$imageUploader->getImage()->id, 'product'=>$product->id));
                    } else {
                        return $this->_helper->redirector('view', 'product', null, array('id'=>$product->id));
                    }
                }
            }
        }

        $this->view->product = $product;
        
    }

    // }}}
    // {{{ cropAction()

    public function cropAction() {
        $this->view->js = array('crop');

        $imageID = $this->getRequest()->getParam('image', null);
        if($imageID === null) {
            throw new RuntimeException('We need an image to crop!');
        }

        $productID = $this->getRequest()->getParam('product', null);
        if($productID === null) {
            throw new RuntimeException('We need a product to attach that image to.');
        }

        $image = Application_Model_Query_Image::getInstance()->get($imageID);
        $product = Application_Model_Query_Product::getInstance()->get($productID);

        if($this->getRequest()->isPost()) {
            $imageUploader = new Application_Service_ImageUploader();
            $imageUploader->crop($image, $this->getRequest()->getPost());
            
            $persistor = new Application_Model_Persistor_ProductImage();
            
            $main = Application_Model_Query_ProductImage::getInstance()->findOne(array('productID'=>$product->id, 'main'=>1));
            if(!empty($main)) {
                $main->main = 0;
                $persistor->save($main);
            }   

 
            $productImage = new Application_Model_ProductImage();
            $productImage->imageID = $image->id;
            $productImage->productID = $product->id;
            $productImage->main= 1;
            
            $persistor->save($productImage);
 
            return $this->_helper->redirector('browse', 'product');
        }

        $this->view->image = $image;
        $this->view->product = $product; 
 
         
   
    }

    // }}}
    // {{{ deleteAction()
    
    public function deleteAction() {
        if(!Zend_Auth::getInstance()->hasIdentity()) {
            throw new RuntimeException('You cannot delete a product with out being logged in.');
        }

        $id = $this->getRequest()->getParam('id', null);
        if($id === null) {
            throw new RuntimeException('You cannot delete a product with out providing the id of the product to be deleted.');
        }

        $product = Application_Model_Query_Product::getInstance()->get($id);
        if(Zend_Auth::getInstance()->getIdentity()->id !== $product->getFarm()->getUser()->id) {
           throw new RuntimeException('You may only delete a product that you own!'); 
        } 

        $persistor = new Application_Model_Persistor_Product();
        $persistor->delete($product);

        $this->_helper->redirector('dashboard', 'grower');
    }

    // }}}

}


?>
